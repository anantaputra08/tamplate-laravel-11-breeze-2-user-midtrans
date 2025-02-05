<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out">
                        </div>

                        <div class="mb-4">
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out">
                        </div>

                        <div class="mb-4">
                            <label for="role"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Role') }}</label>
                            <select name="role" id="role"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 sm:text-sm transition duration-300 ease-in-out">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                    {{ __('User') }}</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                    {{ __('Admin') }}</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('admin.users.index') }}"
                                class="inline-flex items-center bg-gray-200 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg dark:text-gray-900 tracking-widest dark:hover:bg-gray-600 focus:outline-none focus:border-gray-700 dark:focus:border-gray-500 focus:ring focus:ring-gray-200 dark:focus:ring-gray-400 disabled:opacity-25 transition duration-300 ease-in-out transform hover:scale-105">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit"
                                class="ml-3 inline-flex items-center bg-blue-200 hover:bg-blue-400 text-blue-800 font-bold py-2 px-4 rounded-lg dark:text-gray-900 tracking-widest dark:hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-400 disabled:opacity-25 transition duration-300 ease-in-out transform hover:scale-105">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
