<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Order List</h3>
                    <a href="{{ route('admin.orders.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Create New Order
                    </a>
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Product Name</th>
                                <th class="border border-gray-300 px-4 py-2">User Name</th>
                                <th class="border border-gray-300 px-4 py-2">Amount</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                                <th class="border border-gray-300 px-4 py-2">Date</th>
                                <th class="border border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $transaction->product->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $transaction->user->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">Rp. {{ number_format($transaction->amount, 2) }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ ucfirst($transaction->status) }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $transaction->created_at->format('d M Y H:i:s') }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('admin.orders.show', $transaction->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">View</a>
                                        <a href="{{ route('admin.orders.edit', $transaction->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                        <form action="{{ route('admin.orders.destroy', $transaction->id) }}" method="POST" class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded delete-button">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function (event) {
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