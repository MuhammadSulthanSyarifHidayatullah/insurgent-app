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

class CartController extends Controller
{
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

    public function checkout()
    {
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

            return redirect()->route('invoice.show', $invoice)->with('success', 'Checkout successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'An error occurred during checkout. Please try again.');
        }
    }
}

