<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan semua item di cart
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('cart.index', compact('cartItems'));
    }


    public function add(Request $request, Product $product)
    {
        // Validasi ukuran
        $request->validate([
            'size' => 'required|string'
        ]);

        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang login

        // Periksa apakah produk dengan ukuran yang sama sudah ada di keranjang pengguna ini
        $cartItem = Cart::where('product_id', $product->id)
            ->where('user_id', $userId)
            ->where('size', $request->size)
            ->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan jumlahnya
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // Jika belum ada, buat item baru di cart
            Cart::create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'size' => $request->size,
                'user_id' => $userId,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke cart');
    }


    // Update jumlah produk di cart
    public function update(Request $request, Cart $cart)
    {
        $cart->update(['quantity' => $request->quantity]);
        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diperbarui');
    }

    // Hapus produk dari cart
    public function remove(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari cart');
    }
}
