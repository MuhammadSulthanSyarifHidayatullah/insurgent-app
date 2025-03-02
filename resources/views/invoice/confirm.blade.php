<!-- resources/views/invoice/confirm.blade.php -->

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-8">Payment Confirmation</h1>

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-2">Invoice #{{ $invoice->id }}</h3>
                        <p><strong>Total Amount:</strong> Rp {{ number_format($invoice->total_amount, 2, ',', '.') }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-2">Payment Method:
                            {{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}</h3>
                        @if ($invoice->payment_method == 'credit_card')
                            <form action="{{ route('invoice.pay', $invoice) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="card_number" class="block text-sm font-medium text-gray-700">Card
                                        Number</label>
                                    <input type="number" name="card_number" id="card_number"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry
                                        Date</label>
                                    <input type="date" name="expiry_date" id="expiry_date"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                                    <input type="number" name="cvv" id="cvv"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Confirm Payment
                                </button>
                            </form>
                        @elseif ($invoice->payment_method == 'paypal')
                            <form action="{{ route('invoice.pay', $invoice) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="paypal_email" class="block text-sm font-medium text-gray-700">PayPal
                                        Email</label>
                                    <input type="email" name="paypal_email" id="paypal_email"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Confirm Payment
                                </button>
                            </form>
                        @elseif ($invoice->payment_method == 'bank_transfer')
                            <p>Please transfer the total amount to the following bank account:</p>
                            <p><strong>Bank:</strong> XYZ Bank<br><strong>Account Number:</strong>
                                1234567890<br><strong>Account Name:</strong> Partisan</p>
                            <form action="{{ route('invoice.pay', $invoice) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="bank_transfer_receipt"
                                        class="block text-sm font-medium text-gray-700">Upload Transfer Receipt</label>
                                    <input type="file" name="bank_transfer_receipt" id="bank_transfer_receipt"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Confirm Payment
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
