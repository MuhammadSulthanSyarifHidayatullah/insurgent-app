<x-app-layout>
    <x-slot name="title">Invoice #{{ $invoice->id }} | Partisan</x-slot>

    <!-- Print Styles -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #invoice-container,
            #invoice-container * {
                visibility: visible;
            }

            #invoice-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none;
            }

            .print-break {
                page-break-inside: avoid;
            }
        }
    </style>

    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="invoice-container" class="bg-white shadow-lg overflow-hidden sm:rounded-lg">
                <!-- Invoice Header -->
                <div class="px-8 py-6 bg-gray-50 border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto mr-3">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">Partisan</h1>
                                    <p class="text-sm text-gray-600">hello@partisan.com</p>
                                    <p class="text-sm text-gray-600">+62 12345 67890</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <h2 class="text-4xl font-bold text-gray-400">INVOICE</h2>
                            <p class="text-gray-600 mt-1">#{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</p>
                            <p class="text-gray-600 mt-1">{{ $invoice->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Invoice Body -->
                <div class="px-8 py-6">
                    <!-- Customer Info -->
                    <div class="grid grid-cols-2 gap-8 mb-8">
                        <div>
                            <h3 class="text-gray-600 text-sm font-semibold uppercase">Billed To</h3>
                            <div class="mt-2">
                                <p class="font-semibold text-gray-800">{{ $invoice->name }}</p>
                                <p class="text-gray-600">{{ $invoice->address }}</p>
                                <p class="text-gray-600">{{ $invoice->city }}, {{ $invoice->state }}
                                    {{ $invoice->postal_code }}</p>
                                <p class="text-gray-600">{{ $invoice->country }}</p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-gray-600 text-sm font-semibold uppercase">Payment Details</h3>
                            <div class="mt-2">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-gray-600">Payment Method:</div>
                                    <div class="text-gray-800">
                                        {{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}</div>
                                    <div class="text-gray-600">Status:</div>
                                    <div>
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'paid' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                            ];
                                            $statusClass =
                                                $statusClasses[$invoice->status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="mt-8">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Item</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Size</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($invoice->items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $item->product->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $item->size }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-right">
                                            {{ $item->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-right">Rp
                                            {{ number_format($item->price, 2, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 text-right">Rp
                                            {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Totals -->
                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <div class="flex justify-end">
                            <div class="w-64">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-gray-600">Subtotal:</div>
                                    <div class="text-right text-gray-800">Rp
                                        {{ number_format($invoice->subtotal, 2, ',', '.') }}</div>
                                    <div class="text-gray-600">Tax (12%):</div>
                                    <div class="text-right text-gray-800">Rp
                                        {{ number_format($invoice->tax, 2, ',', '.') }}</div>
                                    <div class="text-gray-800 font-semibold pt-4 border-t">Total:</div>
                                    <div class="text-right text-gray-800 font-semibold pt-4 border-t">Rp
                                        {{ number_format($invoice->total_amount, 2, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thank You Note -->
                    <div class="mt-8 text-center text-gray-600">
                        <p>Thank you for your business!</p>
                    </div>
                </div>

                <!-- Invoice Actions -->
                <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 no-print">
                    <div class="flex justify-end space-x-4">
                        @if ($invoice->status === 'pending')
                            <form action="{{ route('invoice.pay', $invoice) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Pay Now
                                </button>
                            </form>
                            <form action="{{ route('invoice.cancel', $invoice) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    Cancel
                                </button>
                            </form>
                        @endif
                        @if ($invoice->status === 'paid')
                            <button onclick="window.print()"
                                class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                Print Invoice
                            </button>
                            <button onclick="downloadPDF()"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Download PDF
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function downloadPDF() {
            // You would implement PDF generation here
            alert('PDF download functionality will be implemented');
        }
    </script>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#d1d5db" fill-opacity="1"
            d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
        </path>
    </svg>
</x-app-layout>
