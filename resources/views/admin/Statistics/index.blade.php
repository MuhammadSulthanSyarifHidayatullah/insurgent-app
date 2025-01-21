<x-admin-layout>
    <x-slot name="title">Statistics | Admin Partisan</x-slot>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Statistik Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Total Pengguna</h2>
                    <span class="text-blue-500">
                        <i class="fa-solid fa-users fa-xl"></i>
                    </span>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['users']) }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Total Pembelian</h2>
                    <span class="text-green-500">
                        <i class="fa-solid fa-cart-shopping fa-xl"></i>
                    </span>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['invoice']) }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Total Produk</h2>
                    <span class="text-orange-500">
                        <i class="fa-solid fa-bag-shopping fa-xl"></i>
                    </span>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['products']) }}</p>
            </div>
        </div>
    </div>
</x-admin-layout>
