<div>
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-primary to-secondary sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('landing') }}" class="text-2xl font-bold text-white">🎨 PojokKaarya</a>

                <div class="hidden md:flex items-center space-x-6">
                    <div class="relative">
                        <div class="flex items-center bg-white/20 backdrop-blur-sm rounded-full px-4 py-1">
                            <i class="fas fa-search text-white/80 mr-2"></i>
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari kreasi..."
                                class="bg-transparent text-white placeholder-white/80 outline-none border-none focus:ring-0 w-48">
                        </div>
                    </div>

                    <div class="flex items-center space-x-6">
                        <a href="#beranda" class="text-white hover:text-gray-300 transition">Beranda</a>
                        <a href="#jelajah" class="text-white hover:text-gray-300 transition">Jelajah</a>
                        @auth
                            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="text-white hover:text-gray-300 transition">Dashboard</a>
                        @else
                            <button onclick="Livewire.dispatch('openLoginModal')" class="text-white hover:text-gray-300 transition">Masuk</button>
                            <button onclick="Livewire.dispatch('openRegisterModal')" class="bg-accent text-white px-6 py-2 rounded-full hover:bg-blue-700 transition">Daftar</button>
                        @endauth
                    </div>
                </div>

                <button onclick="toggleMobileNav()" class="md:hidden text-white text-xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileNav" class="hidden md:hidden pb-4">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari kreasi..."
                    class="w-full px-4 py-2 rounded-lg mb-3 text-gray-800">
                <div class="flex flex-col space-y-2">
                    <a href="#beranda" class="text-white hover:text-gray-300">Beranda</a>
                    <a href="#jelajah" class="text-white hover:text-gray-300">Jelajah</a>
                    @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="text-white hover:text-gray-300">Dashboard</a>
                    @else
                        <button onclick="Livewire.dispatch('openLoginModal')" class="text-white text-left">Masuk</button>
                        <button onclick="Livewire.dispatch('openRegisterModal')" class="bg-accent text-white px-4 py-2 rounded-full text-center">Daftar</button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-secondary text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h1 class="text-4xl lg:text-5xl font-bold leading-tight">Wujudkan Kreativitas Tanpa Batas</h1>
                    <p class="text-xl text-gray-300">Platform untuk para kreator berbagi karya, mendapat apresiasi, dan membangun jaringan dengan komunitas kreatif Indonesia</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        @auth
      <a href="{{ route('kreasi.create') }}" class="bg-accent text-white px-8 py-3 rounded-full hover:bg-blue-700 transition transform hover:-translate-y-1 text-center">
                               🔎 Mulai Berkarya 
                            </a>
                        @else
                            <button onclick="Livewire.dispatch('openRegisterModal')" class="bg-accent text-white px-8 py-3 rounded-full hover:bg-blue-700 transition transform hover:-translate-y-1">
                                Mulai Berkarya🔎
                            </button>
                        @endauth
                        <a href="#jelajah" class="border-2 border-white text-white px-8 py-3 rounded-full hover:bg-white hover:text-primary transition text-center">
                            Jelajahi Karya
                        </a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="w-full max-w-md h-80 bg-white/10 backdrop-blur-sm rounded-2xl overflow-hidden">
                        <img src="https://i.pinimg.com/736x/58/58/dc/5858dc7045e206305cba80341ce0b00a.jpg" alt="Hero" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section id="jelajah" class="bg-gray-100 py-8 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                <h3 class="text-gray-600 font-medium">📑 Filter Berdasarkan Tag:</h3>
            </div>
            <div class="flex flex-wrap gap-3">
                <button wire:click="setTag('')"
                    class="px-4 py-2 rounded-full text-sm font-medium transition {{ $tagFilter === '' ? 'bg-accent text-white' : 'bg-white text-gray-700 border border-gray-300 hover:border-accent' }}">
                    Semua Karya
                </button>
                @foreach($tags as $tag)
                    <button wire:click="setTag('{{ $tag->id }}')"
                        class="px-4 py-2 rounded-full text-sm font-medium transition {{ $tagFilter == $tag->id ? 'bg-accent text-white' : 'bg-white text-gray-700 border border-gray-300 hover:border-accent' }}">
                        {{ $tag->nama_tag }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Kreasi Gallery -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 sm:mb-0">Karya Terbaru Komunitas</h2>
                <div class="flex space-x-2">
                    <button wire:click="setSort('terbaru')"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $sortBy === 'terbaru' ? 'bg-accent text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        🔥 Terbaru
                    </button>
                    <button wire:click="setSort('populer')"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $sortBy === 'populer' ? 'bg-accent text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        ⭐ Populer
                    </button>
                </div>
            </div>

            <!-- Kreasi Grid -->
            @if($kreasis->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($kreasis as $kreasi)
                @include('livewire.partials.kreasi-card', ['kreasi' => $kreasi])
                @endforeach
            </div>
            <div class="mt-8">{{ $kreasis->links() }}</div>
            @else
            <div class="text-center py-12">
                <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Belum ada kreasi</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Brand -->
                <div>
                    <h3 class="text-accent text-xl font-bold mb-4">🎨 PojokKaarya</h3>
                    <p class="text-gray-400">
                        Platform untuk para kreator berbagi karya, menemukan inspirasi, dan membangun komunitas kreatif Indonesia.
                    </p>
                </div>
                
                <!-- Navigation -->
                <div>
                    <h4 class="font-semibold mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#beranda" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="#jelajah" class="hover:text-white transition">Jelajah Karya</a></li>
                        <li><a href="#komunitas" class="hover:text-white transition">Komunitas</a></li>
                        <li><a href="#tentang" class="hover:text-white transition">Tentang Kami</a></li>
                    </ul>
                </div>
                
                <!-- Help -->
                <div>
                    <h4 class="font-semibold mb-4">Bantuan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#faq" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#panduan" class="hover:text-white transition">Panduan Pengguna</a></li>
                        <li><a href="#privasi" class="hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#syarat" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📧 info@pojokkaarya.id</li>
                        <li>📱 +62 812-3456-7890</li>
                        <li>📍 Bekasi, West Java, Indonesia</li>
                        <li class="flex space-x-4 mt-3 text-xl">
                            <a href="#" class="hover:text-white transition">📘</a>
                            <a href="#" class="hover:text-white transition">📷</a>
                            <a href="#" class="hover:text-white transition">🐦</a>
                            <a href="#" class="hover:text-white transition">💼</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 PojokKaarya. Dibuat dengan ❤️ oleh Naimah | TRPL B</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileNav() {
            document.getElementById('mobileNav').classList.toggle('hidden');
        }
    </script>
</div>

