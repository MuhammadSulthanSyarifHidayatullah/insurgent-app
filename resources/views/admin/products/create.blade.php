<x-admin-layout>
    <x-slot name="title">Create Product | Admin Partisan</x-slot>
    <div class="flex justify-center">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex justify-center flex-col gap-4 mt-5">
                <div class="flex flex-col">
                    <label for="name" class="block font-medium text-sm text-gray-700">Product Name</label>
                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        type="text" name="name" id="name" required>
                </div>
                <div class="flex flex-col">
                    <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                    <textarea class="mt-2 w-full rounded-lg border-gray-200 align-top shadow-sm sm:text-sm" name="description"
                        id="description" class=""></textarea>
                </div>
                <div class="flex flex-col">
                    <label for="price" class="block font-medium text-sm text-gray-700">Price</label>
                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        type="number" name="price" id="price" step="0.01" required>
                </div>
                <div class="flex flex-col">
                    <label for="stock" class="block font-medium text-sm text-gray-700">Stock</label>
                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        type="number" name="stock" id="stock" required>
                </div>
                <div class="flex flex-col">
                    <label for="image" class="block font-medium text-sm text-gray-700">Image</label>
                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        type="file" name="image" id="image">
                </div>
                <div class="flex items-center mt-4">
                    <input id="send_notification" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="send_notification" value="1">
                    <label for="send_notification" class="ml-2 block text-sm text-gray-700">
                        Send notification to all users about this new product
                    </label>
                </div>
                <div class="flex justify-center mt-2">
                    <x-primary-button type="submit">Create Product</x-primary-button>
                </div>
            </div>
        </form>
    </div>
    @section('footer')
    @endsection
</x-admin-layout>
