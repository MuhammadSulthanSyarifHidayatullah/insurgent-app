<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden  sm:rounded-lg">
                <div class="p-6 bg-white border-gray-200">
                    <form method="POST" action="{{ route('checkout.process') }}">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-8">
                            <div class="p-8 rounded-lg bg-gray-100">
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        readonly>
                                </div>
                                <div class="flex gap-4">
                                    <div class="mb-4 flex-grow">
                                        <label for="address"
                                            class="block text-sm font-medium text-gray-700">Address</label>
                                        <input type="text" name="address" id="address"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            required>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="mb-4 flex-grow">
                                        <label for="city"
                                            class="block text-sm font-medium text-gray-700">City</label>
                                        <input type="text" name="city" id="city"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            required>
                                    </div>
                                    <div class="mb-4 flex-grow">
                                        <label for="state"
                                            class="block text-sm font-medium text-gray-700">State/Province</label>
                                        <input type="text" name="state" id="state"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            required>
                                    </div>
                                    <div class="mb-4 flex-grow">
                                        <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal
                                            Code</label>
                                        <input type="text" name="postal_code" id="postal_code"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            required>
                                    </div>
                                    <div class="mb-4 flex-grow">
                                        <label for="country"
                                            class="block text-sm font-medium text-gray-700">Country</label>
                                        <input type="text" name="country" id="country"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment
                                        Method</label>
                                    <select name="payment_method" id="payment_method"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required>
                                        <option value="">Select a payment method</option>
                                        <option value="credit_card"><i class="fa-solid fa-credit-card"></i>Credit Card</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="p-8 rounded-lg bg-gray-100  grid content-between">
                                <div class="mt-4">
                                    <h3 class="text-lg font-medium text-gray-900">Order Summary</h3>
                                    <dl class="mt-2 space-y-2">
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Subtotal</dt>
                                            <dd class="text-sm font-medium text-gray-900">Rp
                                                {{ number_format($subtotal, 2, ',', '.') }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Tax (12%)</dt>
                                            <dd class="text-sm font-medium text-gray-900">Rp
                                                {{ number_format($tax, 2, ',', '.') }}</dd>
                                        </div>
                                        <div class="flex justify-between border-t border-gray-200 pt-2">
                                            <dt class="text-base font-medium text-gray-900">Total</dt>
                                            <dd class="text-base font-medium text-gray-900">Rp
                                                {{ number_format($total, 2, ',', '.') }}</dd>
                                        </div>
                                    </dl>
                                </div>
                                <div class="mt-4">
                                    <label for="send_notification" class="inline-flex items-center">
                                        <input id="send_notification" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="send_notification" value="1">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Send order confirmation via WhatsApp') }}</span>
                                    </label>
                                </div>
                                <div class="mt-6">
                                    <button type="submit"
                                        class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Place Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#d1d5db" fill-opacity="1"
        d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
    </path>
</svg>
