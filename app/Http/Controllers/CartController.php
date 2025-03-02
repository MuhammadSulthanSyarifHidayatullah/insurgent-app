<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\NotificationService;

class CartController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    private function updateCartCount()
    {
        $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
        session(['cartItemCount' => $cartCount]);
    }

    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $this->updateCartCount();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'size' => 'required|string'
        ]);

        $userId = Auth::id();

        $cartItem = Cart::where('product_id', $product->id)
            ->where('user_id', $userId)
            ->where('size', $request->size)
            ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            Cart::create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'size' => $request->size,
                'user_id' => $userId,
            ]);
        }

        $this->updateCartCount();
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke cart');
    }

    public function update(Request $request, Cart $cart)
    {
        $cart->update(['quantity' => $request->quantity]);
        $this->updateCartCount();
        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diperbarui');
    }

    public function remove(Cart $cart)
    {
        $cart->delete();
        $this->updateCartCount();
        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari cart');
    }

    public function showCheckoutForm()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
        $tax = $subtotal * 0.12; // 12% tax
        $total = $subtotal + $tax;

        return view('cart.checkout_form', compact('cartItems', 'subtotal', 'tax', 'total', 'user'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string|in:credit_card,paypal,bank_transfer',
            'terms' => 'accepted',
        ]);

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            $subtotal = 0;
            $outOfStockItems = [];

            foreach ($cartItems as $item) {
                $product = $item->product;

                // Check if there's enough stock
                if ($product->stock < $item->quantity) {
                    $outOfStockItems[] = $product->name;
                    continue;
                }

                // Reduce stock
                $product->stock -= $item->quantity;
                $product->save();

                $subtotal += $item->quantity * $item->price;
            }

            // If any items are out of stock, rollback and return with error
            if (!empty($outOfStockItems)) {
                DB::rollBack();
                $message = 'The following items are out of stock: ' . implode(', ', $outOfStockItems);
                return redirect()->route('cart.index')->with('error', $message);
            }

            $tax = $subtotal * 0.12; // 12% tax
            $totalAmount = $subtotal + $tax;

            $invoice = Invoice::create([
                'user_id' => $user->id,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'name' => $user->name,
                'address' => $user->address,
                'city' => $user->city,
                'state' => $user->state,
                'postal_code' => $user->postal_code,
                'country' => $user->country,
                'payment_method' => $request->payment_method,
            ]);

            foreach ($cartItems as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'size' => $item->size,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            if ($request->input('send_notification', false)) {
                $this->notificationService->sendCheckoutNotification($user, $invoice);
            }

            return redirect()->route('invoice.show', $invoice)->with('success', 'Checkout successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'An error occurred during checkout. Please try again.');
        }
    }
}
