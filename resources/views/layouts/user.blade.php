<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} - {{ config('app.name', 'PojokKaarya') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo & Nav Links -->
                <div class="flex items-center">
                    <a href="{{ route('landing') }}" class="flex items-center mr-4">
                        <span class="text-xl font-bold text-primary">Pojok<span class="text-accent">Kaarya</span></span>
                    </a>

                    <!-- Desktop Nav Links -->
                    <div class="hidden md:flex items-center ml-10 space-x-4">
                        <a href="{{ route('dashboard') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fas fa-home mr-2"></i>Dashboard
                        </a>
                        <a href="{{ route('kreasi.create') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('kreasi.create') ? 'bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fas fa-plus mr-2"></i>Unggah Kreasi
                        </a>
                        <a href="{{ route('kreasi.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('kreasi.index') ? 'bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fas fa-images mr-2"></i>Kelola Kreasi
                        </a>
                        <a href="{{ route('profile') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('profile') ? 'bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fas fa-user mr-2"></i>Profil
                        </a>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center space-x-4">
                    <span class="hidden sm:block text-sm text-gray-600">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg">
                            <i class="fas fa-sign-out-alt mr-1"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>

                    <!-- Mobile Menu Button -->
                    <button onclick="toggleMobileMenu()" class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-gray-200 bg-white">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('dashboard') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="{{ route('kreasi.create') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('kreasi.create') ? 'bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-plus mr-2"></i>Unggah Kreasi
                </a>
                <a href="{{ route('kreasi.index') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('kreasi.index') ? 'bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-images mr-2"></i>Kelola Kreasi
                </a>
                <a href="{{ route('profile') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('profile') ? 'bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-user mr-2"></i>Profil
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>

