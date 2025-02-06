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
                            <tr
                                class="px-6 py-4 bg-gray-50 dark:bg-gray-700 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                <th>Product Name</th>
                                <th class="px-6 py-4 text-left">User Name</th>
                                <th class="px-6 py-4 text-left">Amount</th>
                                <th class="px-6 py-4 text-left">Status</th>
                                <th class="px-6 py-4 text-left">Date</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($transactions as $transaction)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $transaction->product->name }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $transaction->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        Rp. {{ number_format($transaction->amount, 2) }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $transaction->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : ($transaction->status == 'process' ? 'bg-blue-200 text-blue-800' : 'bg-green-200 text-green-800') }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $transaction->created_at->format('d M Y H:i:s') }}</td>
                                        <td class="px-4 py-3">
                                            <!-- Ubah max-width menjadi lebih besar dan tambahkan overflow-x-auto -->
                                            <div class="flex w-full space-x-2 overflow-x-auto pb-2">
                                                @if ($transaction->status !== 'completed' && $transaction->status !== 'pending')
                                                    <form action="{{ route('admin.orders.complete', $transaction->id) }}"
                                                        method="POST" class="flex-1 min-w-[130px]">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="button"
                                                            class="complete-button w-full bg-green-200 hover:bg-green-300 text-green-800 font-semibold py-2 px-4 rounded-lg shadow-sm transition-all flex items-center justify-center gap-2">
                                                            {{ svg('heroicon-o-check-circle', 'w-5 h-5') }}
                                                            <span class="text-sm">Mark as Completed</span>
                                                        </button>
                                                    </form>
                                                @endif
                                        
                                                <a href="{{ route('admin.orders.show', $transaction->id) }}"
                                                    class="flex-1 min-w-[100px] bg-blue-200 hover:bg-blue-300 text-blue-800 font-semibold py-2 px-4 rounded-lg shadow-sm transition-all flex items-center justify-center gap-2">
                                                    {{ svg('heroicon-o-eye', 'w-5 h-5') }}
                                                    <span class="text-sm">View</span>
                                                </a>
                                        
                                                <a href="{{ route('admin.orders.edit', $transaction->id) }}"
                                                    class="flex-1 min-w-[100px] bg-yellow-200 hover:bg-yellow-300 text-yellow-800 font-semibold py-2 px-4 rounded-lg shadow-sm transition-all flex items-center justify-center gap-2">
                                                    {{ svg('heroicon-o-pencil-square', 'w-5 h-5') }}
                                                    <span class="text-sm">Edit</span>
                                                </a>
                                        
                                                <form action="{{ route('admin.orders.destroy', $transaction->id) }}"
                                                    method="POST" class="flex-1 min-w-[100px]">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="delete-button w-full bg-red-200 hover:bg-red-300 text-red-800 font-semibold py-2 px-4 rounded-lg shadow-sm transition-all flex items-center justify-center gap-2">
                                                        {{ svg('heroicon-o-trash', 'w-5 h-5') }}
                                                        <span class="text-sm">Delete</span>
                                                    </button>
                                                </form>
                                            </div>
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
        document.querySelectorAll('.complete-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Mark this order as completed?',
                    text: "This action cannot be undone!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, complete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
