<!-- resources/views/user/payment/checkout.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Checkout</h3>
                    
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

                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="w-full"
                            src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}"
                            alt="{{ $product->name }}">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $product->name }}</div>
                            <p class="text-gray-700 text-base">
                                Price: Rp. {{ number_format($product->price, 2) }}
                            </p>
                            <p class="text-gray-700 text-base">
                                Stock: {{ $product->stock }}
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <button id="pay-button" type="button"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Proceed to Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<Set your ClientKey here>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    window.location = '{{ route('user.payment.success', ['transaction_id' => $transaction->id]) }}';
                },
                // Optional
                onPending: function(result) {
                    
                },
                // Optional
                onError: function(result) {
                    
                }
            });
        };
    </script>
    <pre id="result-json"></pre>
</x-app-layout>