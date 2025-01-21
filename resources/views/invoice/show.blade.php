<x-app-layout>
    <x-slot name="title">Invoice #{{ $invoice->id }} | Partisan</x-slot>
        <section class="py-12">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                            Invoice #{{ $invoice->id }}
                        </h2>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Created on {{ $invoice->created_at->format('F j, Y') }}
                        </p>
                    </div>
                    <div id="invoice" class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Status
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'paid' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusClass = $statusClasses[$invoice->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span
                                        class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Items
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                        @foreach ($invoice->items as $item)
                                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                <div class="w-0 flex-1 flex items-center">
                                                    <span class="ml-2 flex-1 w-0 truncate">
                                                        {{ $item->product->name }} ({{ $item->size }}) x
                                                        {{ $item->quantity }}
                                                    </span>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    Rp {{ number_format($item->price * $item->quantity, 2, ',', '.') }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Subtotal
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    Rp {{ number_format($invoice->subtotal, 2, ',', '.') }}
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Tax (12%)
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    Rp {{ number_format($invoice->tax, 2, ',', '.') }}
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Total
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    Rp {{ number_format($invoice->total_amount, 2, ',', '.') }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                    @if ($invoice->status === 'pending')
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <form action="{{ route('invoice.pay', $invoice) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Pay Now
                                </button>
                            </form>
                        </div>
                    @endif
                    @if ($invoice->status === 'paid')
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button onclick="printInvoice()"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Print Invoice
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @section('footer')
    @endsection
    <script>
        function printInvoice() {
            const invoiceSection = document.getElementById('invoice');
            const originalContent = document.body.innerHTML;

            // Set only the invoice section as the content to print
            document.body.innerHTML = invoiceSection.outerHTML;

            // Trigger print and restore original content
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
</x-app-layout>
