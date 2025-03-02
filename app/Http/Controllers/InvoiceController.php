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
    public function checkout(Request $request)
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

    public function pay(Request $request, Invoice $invoice)
    {
        if ($invoice->payment_method == 'bank_transfer') {
            $request->validate([
                'bank_transfer_receipt' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $path = $request->file('bank_transfer_receipt')->store('bank_transfer_receipts', 'public');

            $invoice->update([
                'status' => 'paid',
                'bank_transfer_receipt' => $path,
            ]);
        } else {
            $invoice->update(['status' => 'paid']);
        }

        return redirect()->route('invoice.show', $invoice)->with('success', 'Payment successful!');
    }

    public function index()
    {
        $invoices = Invoice::with('user')->latest()->paginate(10);
        return view('admin.invoices.index', compact('invoices'));
    }
    public function userInvoices()
    {
        $user = Auth::user();
        $invoices = Invoice::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('invoice.user-invoices', compact('invoices'));
    }
    public function cancel(Invoice $invoice)
    {
        if ($invoice->status !== 'pending') {
            return redirect()->route('invoice.show', $invoice)->with('error', 'Only pending invoices can be cancelled.');
        }

        $invoice->update(['status' => 'cancelled']);

        // Restore product stock
        foreach ($invoice->items as $item) {
            $product = Product::find($item->product_id);
            $product->stock += $item->quantity;
            $product->save();
        }

        return redirect()->route('invoice.show', $invoice)->with('success', 'Invoice cancelled successfully.');
    }
    public function confirmPayment(Invoice $invoice)
    {
        return view('invoice.confirm', compact('invoice'));
    }
}
