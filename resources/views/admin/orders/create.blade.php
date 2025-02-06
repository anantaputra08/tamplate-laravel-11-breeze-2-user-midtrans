<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Create New Order</h3>
                    <form action="{{ route('admin.orders.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="user_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __(key: 'User') }}</label>
                            <select name="user_id" id="user_id"
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="product_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __(key: 'Product') }}</label>
                            <select name="product_id" id="product_id"
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <input type="text" name="amount" id="amount"
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out"
                                value="{{ old('amount') }}">
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <input type="text" name="status" id="status"
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out"
                                value="{{ old('status') }}">
                        </div>
                        <button type="submit"
                            class="bg-blue-200 hover:bg-blue-400 text-blue-800 font-bold py-2 px-4 rounded-lg">
                            Save Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
