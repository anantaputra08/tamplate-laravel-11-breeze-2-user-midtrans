<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Notifikasi sukses --}}
                    @if (session('success'))
                        <div id="success-message"
                            class="fixed top-5 right-5 z-50 bg-green-500 text-white px-4 py-2 rounded-lg shadow-md transform transition-transform duration-300 hover:scale-105">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Notifikasi error --}}
                    @if ($errors->any())
                        <div id="error-message"
                            class="fixed top-5 right-5 z-50 bg-red-500 text-white px-4 py-2 rounded-lg shadow-md transform transition-transform duration-300 hover:scale-105">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="mb-4">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="password"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Password') }}
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out pr-10"
                                    required>
                                <button type="button" onclick="togglePassword('password', 'togglePasswordIcon')"
                                    class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 dark:text-gray-400">
                                    <svg id="togglePasswordIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Confirm Password') }}
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out pr-10"
                                    required>
                                <button type="button"
                                    onclick="togglePassword('password_confirmation', 'toggleConfirmPasswordIcon')"
                                    class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 dark:text-gray-400">
                                    <svg id="toggleConfirmPasswordIcon" xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="role"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Role') }}</label>
                            <select name="role" id="role"
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out"
                                required>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                                    {{ __('User') }}</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                    {{ __('Admin') }}</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="ml-3 inline-flex items-center bg-blue-200 hover:bg-blue-400 text-blue-800 py-2 px-4 rounded-lg dark:text-gray-900 uppercase tracking-widest dark:hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-400 disabled:opacity-25 transition duration-300 ease-in-out transform hover:scale-105">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk menghilangkan notifikasi dalam 3 detik --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                let successMessage = document.getElementById("success-message");
                let errorMessage = document.getElementById("error-message");

                if (successMessage) {
                    successMessage.style.transition = "opacity 0.5s";
                    successMessage.style.opacity = "0";
                    setTimeout(() => successMessage.remove(), 500);
                }

                if (errorMessage) {
                    errorMessage.style.transition = "opacity 0.5s";
                    errorMessage.style.opacity = "0";
                    setTimeout(() => errorMessage.remove(), 500);
                }
            }, 3000); // Hilang dalam 3 detik
        });

        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field.type === "password") {
                field.type = "text";
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825c-.375.1-.825.175-1.375.175-6 0-10-7-10-7s4-7 10-7 10 7 10 7-2.225 3.9-5.65 6.05"/>';
            } else {
                field.type = "password";
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7z" />';
            }
        }
    </script>
</x-app-layout>
