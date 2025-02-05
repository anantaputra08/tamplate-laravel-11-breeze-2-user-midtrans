<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment Successful') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center">
        <div class="max-w-lg w-full bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg p-8 text-center animate-fade-in">
            <!-- Icon Success -->
            <div class="flex justify-center">
                <svg class="w-20 h-20 text-green-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M5 13l4 4 8-8" />
                </svg>
            </div>

            <!-- Payment Success Message -->
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-3">Payment Successful!</h1>
            <p class="text-lg text-gray-700 dark:text-gray-300 mb-6">Your payment has been successfully processed.</p>

            <!-- Order Button -->
            <a href="{{ route('user.orders.index') }}"
                class="w-full block bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 text-lg rounded-lg transition duration-300">
                View Your Order
            </a>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</x-app-layout>
