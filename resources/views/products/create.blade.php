<x-app-layout>    
<div class="flex justify-center">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center flex-col gap-4 mt-5">
            <div class="flex flex-col">
                <label for="name" class="block font-medium text-sm text-gray-700">Product Name</label>
                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="name" id="name" required>
            </div>
            <div class="flex flex-col">
                <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                <textarea name="description" id="description" class=""></textarea>
            </div>
            <div class="flex flex-col">
                <label for="price" class="block font-medium text-sm text-gray-700">Price</label>
                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="number" name="price" id="price" step="0.01" required>
            </div>
            <div class="flex flex-col">
                <label for="stock" class="block font-medium text-sm text-gray-700">Stock</label>
                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="number" name="stock" id="stock" required>
            </div>
            <div class="flex flex-col">
                <label for="image" class="block font-medium text-sm text-gray-700">Image</label>
                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="file" name="image" id="image">
            </div>
            <div class="flex justify-center mt-2">
                <x-primary-button type="submit">Create Product</x-primary-button>
            </div>
        </div>
    </form>
</div>
</x-app-layout>