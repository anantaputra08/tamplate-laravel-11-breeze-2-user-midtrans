<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Transaction List</h3>
                    <!-- Display error message -->
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Product Name</th>
                                <th class="border border-gray-300 px-4 py-2">Amount</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                                <th class="border border-gray-300 px-4 py-2">Date</th>
                                <th class="border border-gray-300 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $transaction->product->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">Rp. {{ number_format($transaction->amount, 2) }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ ucfirst($transaction->status) }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $transaction->created_at->format('d M Y H:i:s') }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if ($transaction->status == 'pending')
                                            <button type="button"
                                                class="pay-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                                data-snaptoken="{{ $transaction->snapToken }}"
                                                data-transaction-id="{{ $transaction->id }}">
                                                Proceed to Payment
                                            </button>
                                        @elseif($transaction->status == 'process')
                                            <span class="bg-green-500 text-white font-bold py-2 px-4 rounded">
                                                PAID
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<Set your ClientKey here>"></script>
    <script type="text/javascript">
        document.querySelectorAll('.pay-button').forEach(button => {
            button.addEventListener('click', function() {
                let snapToken = this.getAttribute('data-snaptoken');
                let transactionId = this.getAttribute('data-transaction-id');
                
                if (!snapToken) {
                    console.error("snapToken is required");
                    return;
                }

                snap.pay(snapToken, {
                    // Optional
                    onSuccess: function(result) {
                        window.location.href = '{{ route('user.payment.success', ['transaction_id' => '']) }}' + transactionId;
                    },
                    // Optional
                    onPending: function(result) {
                        // Handle pending
                    },
                    // Optional
                    onError: function(result) {
                        // Handle error
                    }
                });
            });
        });
    </script>
    <pre id="result-json"></pre>
</x-app-layout>