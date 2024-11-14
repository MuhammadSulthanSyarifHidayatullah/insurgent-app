<x-admin-layout>
    <x-slot name="title">Product | Admin Partisan</x-slot>
    <div class="overflow-x-auto rounded-md">
        <div class="flex p-4 justify-end">
            <a href="{{ route('products.create') }}">
                <x-primary-button class="bg-blue-700 hover:bg-white hover:text-blue-500 border hover:border-blue-500 focus:bg-blue-500 active:bg-blue-500">
                    Create
                </x-primary-button>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm table-auto">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Gambar Product</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Harga</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 hidden md:table-cell">Deskripsi</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 hidden sm:table-cell">Stok</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr class="text-center">
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                <img src="{{ asset('images/' . $product->image) }}" alt="Product Image"
                                    class="w-16 h-16 object-cover rounded-md mx-auto">
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 hidden md:table-cell">
                                {{ Str::limit($product->description, 50) }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 hidden sm:table-cell">
                                {{ $product->stock }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2">
                                <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2 justify-center">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <x-primary-button class="bg-yellow-500 hover:bg-white hover:text-yellow-500 border hover:border-yellow-500 focus:bg-yellow-500 w-full sm:w-auto">
                                            View
                                        </x-primary-button>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}">
                                        <x-primary-button class="bg-green-500 hover:bg-white hover:text-green-500 border hover:border-green-500 focus:bg-green-500 w-full sm:w-auto">
                                            Edit
                                        </x-primary-button>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button type="submit" class="bg-red-500 hover:bg-white hover:text-red-500 border hover:border-red-500 focus:bg-red-500 w-full sm:w-auto">
                                            Delete
                                        </x-primary-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>