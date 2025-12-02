<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} - PojokKaarya</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .sidebar { width: 256px; min-height: 100vh; background: #1f2937; }
        .main-wrapper { margin-left: 256px; min-height: 100vh; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
        }
        .overlay { display: none; }
        .overlay.open { display: block; }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Mobile Overlay -->
    <div id="overlay" onclick="closeSidebar()" class="overlay fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar fixed top-0 left-0 z-40 transition-transform duration-300">
        <div class="flex flex-col h-screen">
            <!-- Logo -->
            <div class="h-16 flex items-center justify-between px-4 bg-gray-900">
                <div class="flex items-center">
                    <i class="fas fa-palette text-blue-400 text-xl mr-2"></i>
                    <span class="text-white font-bold text-lg">PojokKaarya</span>
                </div>
                <!-- Close Button (Mobile) -->
                <button onclick="closeSidebar()" class="text-gray-400 hover:text-white md:hidden">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Menu -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                    <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.users') }}"
                   class="flex items-center px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.users') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                    <i class="fas fa-users w-5 mr-3"></i>
                    Pengguna
                </a>
                <a href="{{ route('admin.kreasi') }}"
                   class="flex items-center px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.kreasi') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                    <i class="fas fa-images w-5 mr-3"></i>
                    Kreasi
                </a>
                <a href="{{ route('admin.tags') }}"
                   class="flex items-center px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.tags') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                    <i class="fas fa-tags w-5 mr-3"></i>
                    Tags
                </a>
            </nav>

            <!-- Bottom -->
            <div class="px-3 py-4 border-t border-gray-700">
                <a href="{{ route('landing') }}" class="flex items-center px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-gray-700">
                    <i class="fas fa-arrow-left w-5 mr-3"></i>
                    Kembali ke Situs
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-gray-700">
                        <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-wrapper">
        <!-- Header -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 md:px-6">
            <div class="flex items-center">
                <!-- Hamburger Menu (Mobile) -->
                <button onclick="openSidebar()" class="mr-4 text-gray-600 hover:text-gray-800 md:hidden">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-xl font-semibold text-gray-800">{{ $title ?? 'Dashboard' }}</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-white text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="ml-2 text-sm text-gray-700">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="p-6">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="px-6 py-4 bg-white border-t border-gray-200 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} PojokKaarya. All rights reserved.
        </footer>
    </div>

    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.add('open');
            document.getElementById('overlay').classList.add('open');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('overlay').classList.remove('open');
        }
    </script>
</body>
</html>
