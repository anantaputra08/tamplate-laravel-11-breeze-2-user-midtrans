<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Order Details</h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">User</label>
                        <div>{{ $transaction->user->name }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Product</label>
                        <div>{{ $transaction->product->name }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Amount</label>
                        <div>Rp. {{ number_format($transaction->amount, 2) }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <div>{{ ucfirst($transaction->status) }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Date</label>
                        <div>{{ $transaction->created_at->format('d M Y H:i:s') }}</div>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="bg-blue-200 hover:bg-blue-400 text-blue-800 font-bold py-2 px-4 rounded-lg">
                        Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>