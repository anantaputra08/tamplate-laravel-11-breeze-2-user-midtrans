<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Users -->
                <div class="bg-blue-500 dark:bg-blue-700 p-6 shadow-md rounded-lg text-white flex items-center space-x-4">
                    <div class="p-3 bg-white bg-opacity-20 rounded-full">
                        {{ svg('heroicon-o-user-group', 'w-10 h-10') }}
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Users</h3>
                        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                    </div>
                </div>

                <!-- Total Products -->
                <div class="bg-green-500 dark:bg-green-700 p-6 shadow-md rounded-lg text-white flex items-center space-x-4">
                    <div class="p-3 bg-white bg-opacity-20 rounded-full">
                        {{ svg('heroicon-o-archive-box', 'w-10 h-10') }}
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Products</h3>
                        <p class="text-3xl font-bold">{{ $totalProducts }}</p>
                    </div>
                </div>

                <!-- Pending Orders -->
                <div class="bg-yellow-500 dark:bg-yellow-700 p-6 shadow-md rounded-lg text-white flex items-center space-x-4">
                    <div class="p-3 bg-white bg-opacity-20 rounded-full">
                        {{ svg('heroicon-o-clock', 'w-10 h-10') }}
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Pending Orders</h3>
                        <p class="text-3xl font-bold">{{ $pendingOrders }}</p>
                    </div>
                </div>

                <!-- Processing Orders -->
                <div class="bg-orange-500 dark:bg-orange-700 p-6 shadow-md rounded-lg text-white flex items-center space-x-4">
                    <div class="p-3 bg-white bg-opacity-20 rounded-full">
                        {{ svg('heroicon-o-adjustments-horizontal', 'w-10 h-10') }}
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Processing Orders</h3>
                        <p class="text-3xl font-bold">{{ $processOrders }}</p>
                    </div>
                </div>

                <!-- Completed Orders -->
                <div class="bg-teal-500 dark:bg-teal-700 p-6 shadow-md rounded-lg text-white flex items-center space-x-4">
                    <div class="p-3 bg-white bg-opacity-20 rounded-full">
                        {{ svg('heroicon-o-check-circle', 'w-10 h-10') }}
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Completed Orders</h3>
                        <p class="text-3xl font-bold">{{ $completedOrders }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
