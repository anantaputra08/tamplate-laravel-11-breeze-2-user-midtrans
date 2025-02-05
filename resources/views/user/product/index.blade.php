<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- <h3 class="text-lg font-semibold mb-4">Product List</h3> --}}
                    
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

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($products as $product)
                            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                                <img class="w-full h-48 object-cover" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}">
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
                                    <a href="{{ route('user.checkout', ['product_id' => $product->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full text-center block">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
