<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gradient-to-r from-gray-100 via-white to-gray-100">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 shadow text-white">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold">
                {{ config('app.name', 'Laravel') }}
            </a>
            <div>
                @auth
                    {{-- <a href="{{ route('products.index') }}" class="text-white hover:underline">
                        Products
                    </a> --}}
                    <a href="{{ url('/dashboard') }}" class="text-white hover:underline">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:underline mr-4">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="text-white hover:underline">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-700 text-white">
        <div class="container mx-auto px-4 py-20 text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to {{ config('app.name', 'Laravel') }}</h1>
            <p class="text-lg mb-6">A modern Laravel application with Breeze authentication.</p>
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="px-6 py-3 bg-white text-indigo-600 rounded-full shadow hover:bg-gray-200">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="px-6 py-3 bg-white text-indigo-600 rounded-full shadow hover:bg-gray-200 mr-4">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="px-6 py-3 bg-white text-indigo-600 rounded-full shadow hover:bg-gray-200">
                    Get Started
                </a>
            @endauth
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-16 bg-gradient-to-r from-gray-100 via-white to-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-r from-white to-gray-100 p-6 rounded-lg shadow hover:shadow-lg">
                    <h3 class="text-xl font-bold text-indigo-600 mb-4">User Authentication</h3>
                    <p class="text-gray-600">Secure authentication system with login and registration.</p>
                </div>
                <div class="bg-gradient-to-r from-white to-gray-100 p-6 rounded-lg shadow hover:shadow-lg">
                    <h3 class="text-xl font-bold text-indigo-600 mb-4">Role Management</h3>
                    <p class="text-gray-600">Separate dashboards for users and admins.</p>
                </div>
                <div class="bg-gradient-to-r from-white to-gray-100 p-6 rounded-lg shadow hover:shadow-lg">
                    <h3 class="text-xl font-bold text-indigo-600 mb-4">Modern Design</h3>
                    <p class="text-gray-600">Built with Tailwind CSS for a clean and responsive UI.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-800 via-gray-700 to-black text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                @putraananta08templates</p>
        </div>
    </footer>
</body>

</html>
