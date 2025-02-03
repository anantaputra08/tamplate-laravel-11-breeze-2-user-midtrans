<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Edit Order</h3>
                    <form action="{{ route('admin.orders.update', $transaction->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                            <select name="user_id" id="user_id" class="block w-full mt-1">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $transaction->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
                            <select name="product_id" id="product_id" class="block w-full mt-1" onchange="updateAmount()">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <input type="text" name="amount" id="amount" class="block w-full mt-1" value="{{ $transaction->amount }}" readonly>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="block w-full mt-1">
                                <option value="process" {{ $transaction->status == 'process' ? 'selected' : '' }}>Process</option>
                                <option value="completed" {{ $transaction->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Update Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateAmount() {
            var productSelect = document.getElementById('product_id');
            var selectedOption = productSelect.options[productSelect.selectedIndex];
            var price = selectedOption.getAttribute('data-price');
            document.getElementById('amount').value = price;
        }

        // Update amount on page load if a product is already selected
        document.addEventListener('DOMContentLoaded', function() {
            updateAmount();
        });
    </script>
</x-app-layout>