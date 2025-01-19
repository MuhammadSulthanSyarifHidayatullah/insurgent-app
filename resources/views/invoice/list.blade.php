<x-app-layout>
    <x-slot name="title">Invoices</x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Your Invoices</h2>

        @if ($invoices->isEmpty())
            <p class="text-gray-600">You have no invoices.</p>
        @else
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Invoice ID</th>
                        <th class="border border-gray-300 px-4 py-2">Total Amount</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $invoice->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                Rp {{ number_format($invoice->grand_total, 2, ',', '.') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $invoice->status }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('invoices.show', $invoice->id) }}"
                                    class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
