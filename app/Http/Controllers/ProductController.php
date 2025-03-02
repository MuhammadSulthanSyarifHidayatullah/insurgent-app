<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use App\Services\NotificationService;

class ProductController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $products = Product::where('is_active', true)->get();
        return view('products.index', compact('products'));
    }

    public function adminIndex()
    {
        $products = Product::withTrashed()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'send_notification' => 'boolean',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        $sizes = ['S', 'M', 'L', 'XL'];
        foreach ($sizes as $size) {
            ProductSize::create([
                'product_id' => $product->id,
                'size' => $size,
            ]);
        }

        if ($request->input('send_notification', false)) {
            $this->notificationService->sendNewProductNotification($product);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function show($id)
    {
        $product = Product::with('sizes')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if ($product->trashed()) {
            if ($product->invoiceItems()->exists()) {
                return redirect()->route('admin.products.index')->with('error', 'Cannot permanently delete a product with associated orders.');
            }
            $product->forceDelete();
            return redirect()->route('admin.products.index')->with('success', 'Product permanently deleted.');
        }

        if ($product->invoiceItems()->exists()) {
            $product->update(['is_active' => false]);
            $product->delete();
            return redirect()->route('admin.products.index')->with('warning', 'Product has been deactivated and soft deleted because it has associated orders.');
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        $product->update(['is_active' => true]);
        return redirect()->route('admin.products.index')->with('success', 'Product restored successfully!');
    }

    public function toggleActive($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();

        $status = $product->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.products.index')->with('success', "Product {$status} successfully!");
    }
}
