<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Notifikasi sukses --}}
                    @if (session('success'))
                        <div id="success-message"
                            class="fixed top-5 right-5 z-50 bg-green-500 text-white px-4 py-2 rounded shadow-lg transition-opacity duration-500">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Header Users List + Button Create --}}
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Users List') }}
                        </h3>
                        <a href="{{ route('admin.users.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Create User') }}
                        </a>
                    </div>

                    {{-- Table Users List --}}
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Name') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Email') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Role') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($users as $user)
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $user->role }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-500">{{ __('Edit') }}</a>

                                        {{-- Button Delete dengan SweetAlert --}}
                                        <button type="button"
                                            class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-500 ml-4 delete-btn"
                                            data-id="{{ $user->id }}">
                                            {{ __('Delete') }}
                                        </button>

                                        {{-- Form Delete (Tersembunyi) --}}
                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
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

    {{-- SweetAlert2 & Script Konfirmasi Delete --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Notifikasi sukses hilang dalam 3 detik
            setTimeout(function() {
                let successMessage = document.getElementById("success-message");
                if (successMessage) {
                    successMessage.style.transition = "opacity 0.5s";
                    successMessage.style.opacity = "0";
                    setTimeout(() => successMessage.remove(), 500);
                }
            }, 3000);

            // Tambahkan event listener untuk konfirmasi delete dengan SweetAlert2
            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let userId = this.getAttribute("data-id");

                    Swal.fire({
                        title: "Are you sure you want to delete?",
                        text: "This user's data will be permanently deleted!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById("delete-form-" + userId).submit();
                        }
                    });
                });
            });
        });
    </script>

</x-app-layout>
