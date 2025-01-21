<x-app-layout>
    <x-slot name="title">Cart | Partisan</x-slot>

    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <header class="text-center">
                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Your Cart</h1>
                </header>

                <div class="mt-8">
                    @if ($cartItems->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-xl font-semibold text-gray-700">Your cart is empty</p>
                            <a href="{{ route('products.index') }}"
                                class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
                                Continue Shopping
                            </a>
                        </div>
                    @else
                        <ul class="space-y-6">
                            @foreach ($cartItems as $item)
                                <li
                                    class="flex items-center gap-6 py-4 px-2 border-b border-gray-400 bg-gray-200 rounded-lg">
                                    <img src="{{ asset('images/' . $item->product->image) }}"
                                        alt="{{ $item->product->name }}" class="ml-3 w-20 h-20 rounded object-cover" />

                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $item->product->name }}</h3>

                                        <dl class="mt-2 text-sm text-gray-600">
                                            <div>
                                                <dt class="inline font-medium">Size:</dt>
                                                <dd class="inline">{{ $item->size }}</dd>
                                            </div>
                                            <div>
                                                <dt class="inline font-medium">Rp </dt>
                                                <dd class="inline">{{ number_format($item->price, 0, ',', '.') }}</dd>
                                            </div>
                                        </dl>
                                    </div>

                                    <div class="flex items-center justify-end gap-4">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <label for="quantity{{ $item->id }}" class="sr-only"> Quantity </label>
                                            <input type="number" name="quantity" min="1"
                                                value="{{ $item->quantity }}" id="quantity{{ $item->id }}"
                                                class="h-10 w-16 rounded border-gray-300 bg-gray-50 p-2 text-center text-base text-gray-600 focus:outline-none pl-5" />
                                        </form>

                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-gray-600 transition hover:text-red-600 mr-3">
                                                <span class="hover:text-red-500">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-8 flex justify-end border-t border-gray-100 pt-8">
                            <div class="w-screen max-w-lg space-y-4">
                                <dl class="space-y-1 text-base text-gray-700">
                                    @php
                                        $subtotal = $cartItems->sum(fn($item) => $item->price * $item->quantity);
                                        $tax = $subtotal * 0.12; // Pajak 12%
                                        $total = $subtotal + $tax;
                                    @endphp
                                    <div class="flex justify-between">
                                        <dt>Subtotal</dt>
                                        <dd>Rp {{ number_format($subtotal, 2, ',', '.') }}</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt>Tax (12%)</dt>
                                        <dd>Rp {{ number_format($tax, 2, ',', '.') }}</dd>
                                    </div>
                                    <div class="flex justify-between font-medium">
                                        <dt>Total</dt>
                                        <dd>Rp {{ number_format($total, 2, ',', '.') }}</dd>
                                    </div>
                                </dl>

                                @if (!$cartItems->isEmpty())
                                    <div class="flex justify-end">
                                        <form action="{{ route('checkout') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                                                Checkout
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @section('footer')
    @endsection
</x-app-layout>
