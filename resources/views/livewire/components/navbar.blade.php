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
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-gray-300">
                                Dashboard Admin
                            </a>
                        @else
                            <!-- Dropdown User dengan Avatar -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" 
                                        class="flex items-center space-x-2 text-white hover:text-gray-300 focus:outline-none">
                                    <!-- Avatar Inisial -->
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold text-sm border-2 border-white shadow-lg">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <span>{{ auth()->user()->name }}</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-95"
                                     class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 z-50">
                                    
                                    <!-- Header Dropdown dengan Avatar dan Info User -->
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow">
                                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Menu Items -->
                                   
                                    <a href="{{ route('kreasi.index') }}" 
                                       class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100">
                                        <i class="fas fa-images mr-3 text-gray-600"></i>
                                        Kreasi Saya
                                    </a>
                                    
                                    <a href="{{ route('bookmarks') }}" 
                                       class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100">
                                        <i class="fas fa-bookmark mr-3 text-gray-600"></i>
                                        Bookmark
                                    </a>

                                    <!-- ✨ MENU BARU: LIKES -->
                                    <a href="{{ route('likes') }}" 
                                       class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100">
                                        <i class="fas fa-heart mr-3 text-red-500"></i>
                                        Likes
                                    </a>

                                    <!-- ✨ MENU BARU: FOLLOWERS -->
                                    <a href="{{ route('followers') }}" 
                                       class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100">
                                        <i class="fas fa-users mr-3 text-purple-600"></i>
                                        Pengikut
                                    </a>
                                    
                                    <a href="{{ route('profile') }}" 
                                       class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100">
                                        <i class="fas fa-user-edit mr-3 text-gray-600"></i>
                                        Edit Profile
                                    </a>
                                    
                                    <hr class="my-2">
                                    
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" 
                                                class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-gray-100 text-left">
                                            <i class="fas fa-sign-out-alt mr-3"></i>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @else
                        <button onclick="Livewire.dispatch('openLoginModal')" class="text-white hover:text-gray-300">
                            Masuk
                        </button>
                        <button onclick="Livewire.dispatch('openRegisterModal')" 
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

        <!-- Mobile Nav -->
        <div id="mobileNav" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('landing') }}#beranda" class="text-white hover:text-gray-300">Beranda</a>
                <a href="{{ route('landing') }}#tentang" class="text-white hover:text-gray-300">Tentang</a>
                <a href="{{ route('landing') }}#jelajah" class="text-white hover:text-gray-300">Jelajah</a>
                <a href="{{ route('landing') }}#faq" class="text-white hover:text-gray-300">Faq</a>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-gray-300">
                            Dashboard Admin
                        </a>
                    @else
                        <div class="border-t border-gray-700 pt-2 mt-2">
                            <!-- User Info di Mobile -->
                            <div class="flex items-center space-x-3 px-2 mb-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold shadow">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-white text-sm font-semibold">{{ auth()->user()->name }}</p>
                                    <p class="text-gray-400 text-xs">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                            
                            <a href="{{ route('kreasi.index') }}" class="text-white hover:text-gray-300 block py-1">Kreasi Saya</a>
                            <a href="{{ route('bookmarks') }}" class="text-white hover:text-gray-300 block py-1">Bookmark</a>
                            
                            <!-- ✨ MENU MOBILE: LIKES & FOLLOWERS -->
                            <a href="{{ route('likes') }}" class="text-white hover:text-gray-300 block py-1">Likes</a>
                            <a href="{{ route('followers') }}" class="text-white hover:text-gray-300 block py-1">Pengikut</a>
                            
                            <a href="{{ route('profile') }}" class="text-white hover:text-gray-300 block py-1">Edit Profile</a>
                            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                @csrf
                                <button type="submit" class="text-red-400 hover:text-red-300 block py-1 w-full text-left">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    @endif
                @else
                    <button onclick="Livewire.dispatch('openLoginModal')" class="text-white text-left">
                        Masuk
                    </button>
                    <button onclick="Livewire.dispatch('openRegisterModal')" 
                            class="bg-accent text-white px-4 py-2 rounded-full">
                        Daftar
                    </button>
                @endauth
            </div>
        </div>
    </div>
    
    <script>
        function toggleMobileNav() {
            const nav = document.getElementById('mobileNav');
            nav.classList.toggle('hidden');
        }
    </script>
</nav>