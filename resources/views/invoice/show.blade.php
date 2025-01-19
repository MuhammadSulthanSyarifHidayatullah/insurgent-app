<x-app-layout>
    <x-slot name="title">Invoice</x-slot>

    <div class="max-w-3xl mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-xl font-bold mb-4">Invoice #{{ $invoice->id }}</h1>

        <p><strong>Customer:</strong> {{ $invoice->user->name }}</p>
        <p><strong>Date:</strong> {{ $invoice->created_at->format('d M Y') }}</p>
        <p><strong>Status:</strong> {{ $invoice->status }}</p>

        <table class="w-full mt-4 border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Description</th>
                    <th class="border px-4 py-2">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2">Total</td>
                    <td class="border px-4 py-2">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">Tax (10%)</td>
                    <td class="border px-4 py-2">Rp {{ number_format($invoice->tax, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 font-bold">Grand Total</td>
                    <td class="border px-4 py-2 font-bold">Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        @if ($invoice->status == 'Unpaid')
            <form action="{{ route('invoice.pay', $invoice->id) }}" method="POST" class="mt-4">
                @csrf
                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" id="payment_method" class="border rounded p-2">
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="Credit Card">Credit Card</option>
                </select>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Pay Now
                </button>
            </form>
        @else
            <p class="text-green-500 mt-4">This invoice has been paid.</p>
        @endif
    </div>
</x-app-layout>
