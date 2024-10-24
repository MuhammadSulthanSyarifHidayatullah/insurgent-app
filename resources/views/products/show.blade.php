<x-app-layout>
    <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
            <!-- Gambar Produk -->
            <div class="flex align-middle justify-center">
                <div class=" w-[425px] md:w-[600px] aspect-square overflow-hidden rounded-lg bg-gray-200">
                    <img src="{{ asset('images/'. $product->image) }}" alt="{{ $product->name }}" class="aspect-square w-full object-cover object-center">
                </div>
            </div>
            
            <!-- Detail Produk -->
            <div class="mt-10 lg:mt-0">
                <h1 class="text-5xl font-extrabold text-gray-900">{{ $product->name }}</h1>
                <p class="mt-3 text-2xl text-gray-900">Rp.{{ number_format($product->price, 2) }}</p>
    
                <div class="mt-6">
                    <h2 class="text-xl text-gray-700">Description</h2>
                    <p class="text-base text-gray-700">{{ $product->description }}</p>
                </div>
    
                <div class="mt-6">
                    <p class="text-sm text-gray-500">Stok: {{ $product->stock }} tersedia</p>
                </div>
    
                <div class="mt-10">
                    <button type="button" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>