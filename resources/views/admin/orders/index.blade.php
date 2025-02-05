<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">


                <a href="{{ route('admin.orders.create') }}"
                    class="bg-green-200 hover:bg-green-400 text-green-800 font-bold py-2 px-4 rounded mb-4 inline-block flex items-center gap-2">
                    {{ svg('heroicon-o-plus-circle', 'w-5 h-5') }} Create New Order
                </a>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-900  rounded-lg shadow-md">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr class="text-gray-700 dark:text-gray-300">
                                <th class="px-4 py-3 text-left">Product Name</th>
                                <th class="px-4 py-3 text-left">User Name</th>
                                <th class="px-4 py-3 text-left">Amount</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-4 py-3 text-left">Date</th>
                                <th class="px-4 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($transactions as $transaction)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-3">{{ $transaction->product->name }}</td>
                                    <td class="px-4 py-3">{{ $transaction->user->name }}</td>
                                    <td class="px-4 py-3">Rp. {{ number_format($transaction->amount, 2) }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $transaction->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : ($transaction->status == 'process' ? 'bg-blue-200 text-blue-800' : 'bg-green-200 text-green-800') }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">{{ $transaction->created_at->format('d M Y H:i:s') }}</td>
                                    <td class="px-4 py-3 flex justify-center space-x-2">
                                        <a href="{{ route('admin.orders.show', $transaction->id) }}"
                                            class="bg-blue-200 hover:bg-blue-300 text-blue-800 font-semibold py-2 px-4 rounded-lg shadow-sm transition-all duration-300 flex items-center gap-2">
                                            {{ svg('heroicon-o-eye', 'w-5 h-5') }}
                                            <span class="text-sm">View</span>
                                        </a>

                                        <a href="{{ route('admin.orders.edit', $transaction->id) }}"
                                            class="bg-yellow-200 hover:bg-yellow-300 text-yellow-800 font-semibold py-2 px-4 rounded-lg shadow-sm transition-all duration-300 flex items-center gap-2">
                                            {{ svg('heroicon-o-pencil-square', 'w-5 h-5') }}
                                            <span class="text-sm">Edit</span>
                                        </a>

                                        <form action="{{ route('admin.orders.destroy', $transaction->id) }}"
                                            method="POST" class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="bg-red-200 hover:bg-red-300 text-red-800 font-semibold py-2 px-4 rounded-lg shadow-sm transition-all duration-300 flex items-center gap-2 delete-button">
                                                {{ svg('heroicon-o-trash', 'w-5 h-5') }}
                                                <span class="text-sm">Delete</span>
                                            </button>
                                        </form>
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

    <!-- SweetAlert for Delete Confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
