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
                    {{-- <h3 class="text-lg font-semibold mb-4">Transaction List</h3> --}}

                    <!-- Display error message -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-600 rounded-lg">
                            <strong>{{ __('Whoops! Something went wrong.') }}</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 bg-white shadow-lg rounded-lg">
                            <thead class="bg-gray-200 text-gray-700 uppercase">
                                <tr>
                                    <th class="border border-gray-300 px-6 py-3 text-left">Product Name</th>
                                    <th class="border border-gray-300 px-6 py-3 text-left">Amount</th>
                                    <th class="border border-gray-300 px-6 py-3 text-left">Status</th>
                                    <th class="border border-gray-300 px-6 py-3 text-left">Date</th>
                                    <th class="border border-gray-300 px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @foreach ($transactions as $transaction)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="border border-gray-300 px-6 py-4">{{ $transaction->product->name }}</td>
                                        <td class="border border-gray-300 px-6 py-4">Rp. {{ number_format($transaction->amount, 2) }}</td>
                                        <td class="border border-gray-300 px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-sm font-medium 
                                                {{ $transaction->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </td>
                                        <td class="border border-gray-300 px-6 py-4">{{ $transaction->created_at->format('d M Y H:i:s') }}</td>
                                        <td class="border border-gray-300 px-6 py-4 text-center">
                                            @if ($transaction->status == 'pending')
                                                <button type="button"
                                                    class="pay-button w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300"
                                                    data-snaptoken="{{ $transaction->snapToken }}"
                                                    data-transaction-id="{{ $transaction->id }}">
                                                    Proceed to Payment
                                                </button>
                                            @elseif($transaction->status == 'process')
                                                <span class="bg-green-500 text-white font-bold py-2 px-4 rounded w-full inline-block">
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
    </div>

    <!-- Midtrans Script -->
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
                    onSuccess: function(result) {
                        window.location.href = '{{ route('user.payment.success', ['transaction_id' => '']) }}' + transactionId;
                    },
                    onPending: function(result) {
                        // Handle pending
                    },
                    onError: function(result) {
                        // Handle error
                    }
                });
            });
        });
    </script>

</x-app-layout>
