<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card: Pending Orders -->
                <div class="bg-yellow-500 text-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Pending Orders</h3>
                    <p class="text-4xl font-bold mt-2">{{ $pendingOrders }}</p>
                </div>

                <!-- Card: Process Orders -->
                <div class="bg-blue-500 text-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Processing Orders</h3>
                    <p class="text-4xl font-bold mt-2">{{ $processOrders }}</p>
                </div>

                <!-- Card: Completed Orders -->
                <div class="bg-green-500 text-white shadow-lg rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Completed Orders</h3>
                    <p class="text-4xl font-bold mt-2">{{ $completedOrders }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
