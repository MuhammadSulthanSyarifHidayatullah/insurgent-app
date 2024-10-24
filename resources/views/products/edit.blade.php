<x-app-layout>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ $product->description }}</textarea>
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="{{ $product->price }}" step="0.01" required>
        </div>
        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ $product->stock }}" required>
        </div>
        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit">Update Product</button>
    </form>
    
</x-app-layout>