<nav class="bg-gray-900 sticky top-0 z-50 shadow-lg shadow-current py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-2">
                <a href="{{ route('landing') }}" class="text-2xl font-bold text-white tracking-wide uppercase">
                    PojokKaarya
                </a>

                <div class="hidden md:flex items-center space-x-6">


                    <div class="flex items-center space-x-6">
                        <a href="{{ route('landing') }}#beranda" class="text-white hover:text-gray-300">Beranda</a>
                        <a href="{{ route('landing') }}#jelajah" class="text-white hover:text-gray-300">Jelajah</a>
                        <a href="{{ route('landing') }}#tentang" class="text-white hover:text-gray-300">Tentang</a>
                        <a href="{{ route('landing') }}#faq" class="text-white hover:text-gray-300">Faq</a>

                        @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                            class="text-white hover:text-gray-300">
                            Dashboard
                        </a>
                        @else
                        <button
                            onclick="Livewire.dispatch('openLoginModal')"
                            class="text-white hover:text-gray-300">
                            Masuk
                        </button>
                        <button
                            onclick="Livewire.dispatch('openRegisterModal')"
                            class="bg-accent text-white px-6 py-2 rounded-full hover:bg-blue-700">
                            Daftar
                        </button>
                        @endauth
                    </div>
                </div>

                <!-- hamburger buat kalo pake hp-->
                <button onclick="toggleMobileNav()" class="md:hidden text-white text-xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- search pas dihp -->
            <div id="mobileNav" class="hidden md:hidden pb-4">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari kreasi..."
                    class="w-full px-4 py-2 rounded-lg mb-3 text-gray-800">

                <div class="flex flex-col space-y-2">
                    <a href="{{ route('landing') }}#beranda" class="text-white hover:text-gray-300">Beranda</a>
                    <a href="{{ route('landing') }}#tentang" class="text-white hover:text-gray-300">Tentang</a>
                    <a href="{{ route('landing') }}#jelajah" class="text-white hover:text-gray-300">Jelajah</a>


                    @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                        class="text-white hover:text-gray-300">
                        Dashboard
                    </a>
                    @else
                    <button
                        onclick="Livewire.dispatch('openLoginModal')"
                        class="text-white text-left">
                        Masuk
                    </button>
                    <button
                        onclick="Livewire.dispatch('openRegisterModal')"
                        class="bg-accent text-white px-4 py-2 rounded-full">
                        Daftar
                    </button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>