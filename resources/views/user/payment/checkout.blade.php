<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-gray-900">

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

                    <div class="rounded-lg overflow-hidden shadow-md">
                        <img class="w-full h-64 object-cover rounded-t-lg"
                            src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x400' }}"
                            alt="{{ $product->name }}">

                        <div class="p-6">
                            <div class="font-bold text-2xl mb-3">{{ $product->name }}</div>
                            <p class="text-gray-700 text-lg">💰 Price: <span class="font-semibold">Rp. {{ number_format($product->price, 2) }}</span></p>
                            <p class="text-gray-700 text-lg">📦 Stock: <span class="font-semibold">{{ $product->stock }}</span></p>
                        </div>

                        <div class="p-6">
                            <button id="pay-button" type="button"
                                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 text-lg rounded-lg transition duration-300">
                                Proceed to Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Midtrans Payment Script -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<Set your ClientKey here>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location = '{{ route('user.payment.success', ['transaction_id' => $transaction->id]) }}';
                },
                onPending: function(result) {
                    // Handle pending
                },
                onError: function(result) {
                    // Handle error
                }
            });
        };
    </script>
</x-app-layout>
