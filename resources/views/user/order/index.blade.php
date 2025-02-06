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
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Transaction List</h3>
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <svg class="inline-block w-5 h-5 mr-2 text-yellow-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1 4h1m-.25 6a9.003 9.003 0 01-8.75-7.75m17.5 0A9.003 9.003 0 0112.75 22h-.5a9.003 9.003 0 01-8.75-7.75m17.5 0A9.003 9.003 0 0112.75 22h-.5a9.003 9.003 0 01-8.75-7.75m17.5 0A9.003 9.003 0 0112.75 22h-.5a9.003 9.003 0 01-8.75-7.75" />
                                </svg>
                                Please complete the payment within 23 hours.
                            </p>
                        </div>
                    </div>

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

                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full bg-white dark:bg-gray-900  rounded-lg shadow-md">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr
                                    class="px-6 py-4 bg-gray-50 dark:bg-gray-700 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <th class="px-6 py-4 text-left">Product Name</th>
                                    <th class="px-6 py-4 text-left">Amount</th>
                                    <th class="px-6 py-4 text-left">Status</th>
                                    <th class="px-6 py-4 text-left">Date</th>
                                    <th class="px-6 py-4 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($transactions as $transaction)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $transaction->product->name }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            Rp. {{ number_format($transaction->amount, 2) }}</td>
                                        <td class="px-6 py-4">
                                            @if ($transaction->status == 'pending')
                                                <span
                                                    class="px-3 py-1 rounded-full text-sm font-medium bg-yellow-200 text-yellow-800">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            @elseif($transaction->status == 'process')
                                                <span
                                                    class="px-3 py-1 rounded-full text-sm font-medium bg-blue-200 text-blue-800">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            @elseif($transaction->status == 'completed')
                                                <span
                                                    class="px-3 py-1 rounded-full text-sm font-medium bg-green-200 text-green-800">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            @elseif ($transaction->status == 'canceled')
                                                <span
                                                    class="px-3 py-1 rounded-full text-sm font-medium bg-red-200 text-red-800">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $transaction->created_at->format('d M Y H:i:s') }}</td>
                                        <td class="px-6 py-4 text-center">
                                            @if ($transaction->status == 'pending')
                                                <button type="button"
                                                    class="pay-button w-full bg-blue-200 hover:bg-blue-300 text-blue-800 font-semibold py-2 px-4 rounded-lg shadow-sm transition-all flex items-center justify-center"
                                                    data-snaptoken="{{ $transaction->snapToken }}"
                                                    data-transaction-id="{{ $transaction->id }}">
                                                    Proceed to Payment
                                                </button>
                                            @elseif($transaction->status == 'process')
                                                <span
                                                    class="complete-button w-full bg-yellow-200 hover:bg-yellow-300 text-yellow-800 font-semibold py-2 px-4 rounded-lg shadow-sm transition-all flex items-center justify-center">
                                                    Paid
                                                </span>
                                            @elseif($transaction->status == 'completed')
                                                <span
                                                    class="complete-button w-full bg-green-200 hover:bg-green-300 text-green-800 font-semibold py-2 px-4 rounded-lg shadow-sm transition-all flex items-center justify-center">
                                                    Completed
                                                </span>
                                            @elseif ($transaction->status == 'canceled')
                                                <span
                                                    class="complete-button w-full bg-red-200 hover:bg-red-300 text-red-800 font-semibold py-2 px-4 rounded-lg shadow-sm transition-all flex items-center justify-center">
                                                    Canceled
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="mt-8">
                            {{ $transactions->links('pagination::tailwind') }}
                        </div>
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
                        window.location.href =
                            '{{ route('user.payment.success', ['transaction_id' => '']) }}' +
                            transactionId;
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
