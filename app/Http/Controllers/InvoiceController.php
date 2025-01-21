<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            $subtotal = $cartItems->sum(function ($item) {
                return $item->quantity * $item->price;
            });
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

                // Reduce the product stock
                $product = Product::find($item->product_id);
                $product->stock -= $item->quantity;
                $product->save();
            }

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('invoice.show', $invoice);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'An error occurred during checkout. Please try again.');
        }
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('items.product');
        return view('invoice.show', compact('invoice'));
    }

    public function pay(Invoice $invoice)
    {
        // Implement your payment logic here
        // For this example, we'll just mark the invoice as paid
        $invoice->update(['status' => 'paid']);
        return redirect()->route('invoice.show', $invoice)->with('success', 'Payment successful!');
    }

    public function index()
    {
        $invoices = Invoice::with('user')->latest()->paginate(10);
        return view('admin.invoices.index', compact('invoices'));
    }
}
