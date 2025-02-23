<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-8">Checkout</h1>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column - Shipping Information -->
                        <div class="lg:col-span-2">
                            <form id="checkout-form" method="POST" action="{{ route('checkout.process') }}" class="space-y-6">
                                @csrf
                                <div>
                                    <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>
                                    
                                    <!-- Full Name -->
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700">
                                            Full name <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            required>
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-4">
                                        <label for="address" class="block text-sm font-medium text-gray-700">
                                            Address <span class="text-red-500">*</span>
                                        </label>
                                        <textarea name="address" id="address" rows="3" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            required>{{ old('address') }}</textarea>
                                    </div>

                                    <!-- City, State, ZIP -->
                                    <div class="grid grid-cols-3 gap-4">
                                        <div>
                                            <label for="city" class="block text-sm font-medium text-gray-700">
                                                City <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="city" id="city" value="{{ old('city') }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label for="state" class="block text-sm font-medium text-gray-700">
                                                State <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="state" id="state" value="{{ old('state') }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label for="postal_code" class="block text-sm font-medium text-gray-700">
                                                ZIP Code <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Country -->
                                    <div class="mt-4">
                                        <label for="country" class="block text-sm font-medium text-gray-700">
                                            Country <span class="text-red-500">*</span>
                                        </label>
                                        <select name="country" id="country" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            required>
                                            <option value="">Select a country</option>
                                            <option value="ID" {{ old('country') == 'ID' ? 'selected' : '' }}>Indonesia</option>
                                            <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>United States</option>
                                        </select>
                                    </div>

                                    <!-- Payment Method -->
                                    <div class="mt-4">
                                        <label for="payment_method" class="block text-sm font-medium text-gray-700">
                                            Payment Method <span class="text-red-500">*</span>
                                        </label>
                                        <select name="payment_method" id="payment_method" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            required>
                                            <option value="">Select payment method</option>
                                            <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                            <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                        </select>
                                    </div>

                                    <!-- WhatsApp Notification -->
                                    <div class="mt-4">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="send_notification" value="1" 
                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                {{ old('send_notification') ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-600">
                                                Send order confirmation via WhatsApp
                                            </span>
                                        </label>
                                    </div>

                                    <!-- Terms and Conditions -->
                                    <div class="mt-6">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="terms" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                            <span class="ml-2 text-sm text-gray-600">
                                                I have read and agree to the 
                                                <a href="#" class="text-blue-600 hover:underline">Terms and Conditions</a>.
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Right Column - Cart Review -->
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h2 class="text-xl font-semibold mb-4">Review your cart</h2>
                                
                                <!-- Cart Items -->
                                <div class="space-y-4 mb-6">
                                    @foreach ($cartItems as $item)
                                        <div class="flex items-center space-x-4">
                                            <img src="{{ $item->product->image ? asset('images/' . $item->product->image) : asset('images/placeholder.jpg') }}" 
                                                alt="{{ $item->product->name }}" 
                                                class="w-16 h-16 object-cover rounded-lg">
                                            <div class="flex-1">
                                                <h3 class="font-medium">{{ $item->product->name }}</h3>
                                                <p class="text-sm text-gray-500">{{ $item->quantity }}x</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-medium">Rp {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Order Summary -->
                                <div class="border-t pt-4 space-y-2">
                                    <div class="flex justify-between font-semibold text-lg pt-2">
                                        <span>Total</span>
                                        <span>Rp {{ number_format($total, 2, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Pay Now Button -->
                                <button type="submit" form="checkout-form" 
                                    class="w-full mt-6 bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Pay Now
                                </button>

                                <!-- Security Notice -->
                                <div class="mt-6 text-center">
                                    <div class="flex items-center justify-center text-gray-600 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Secure Checkout - SSL Encrypted
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Ensuring your financial and personal details are secure during every transaction.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

