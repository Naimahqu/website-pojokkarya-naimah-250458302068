<div class="bg-gray-900 min-h-screen text-white">
    <!-- Navbar -->
    <livewire:components.navbar />
    <!-- endnavbar -->

    <div class="max-w-4xl mx-auto px-4 py-12">
        <!-- Profile Header (Instagram style) -->
        <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-12 border-b border-gray-800 pb-10">
            <!-- Avatar Section -->
            <div class="flex-shrink-0 mb-6 md:mb-0">
                <div class="w-28 h-28 sm:w-36 sm:h-36 rounded-full bg-gradient-to-tr from-yellow-500 via-pink-500 to-purple-600 p-[3px] shadow-lg">
                    <div class="w-full h-full rounded-full bg-gray-900 p-[3px]">
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-extrabold text-3xl sm:text-4xl shadow-inner border border-gray-800">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="flex-1 text-center md:text-left space-y-4">
                <!-- Username row -->
                <div class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <h2 class="text-2xl font-light text-white tracking-wide">{{ $user->name }}</h2>
                    @if(!auth()->check() || auth()->id() !== $user->id)
                        <button wire:click="toggleFollow" 
                                class="px-6 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition {{ auth()->check() && auth()->user()->isFollowing($user->id) ? 'bg-gray-800 text-white hover:bg-gray-700' : 'bg-accent text-white hover:bg-accent/90' }}">
                            {{ auth()->check() && auth()->user()->isFollowing($user->id) ? 'Mengikuti' : 'Ikuti' }}
                        </button>
                    @else
                        <button wire:click="setTab('edit-profile')" 
                                class="px-4 py-1.5 bg-gray-800 text-white text-xs font-semibold rounded-lg hover:bg-gray-700 transition border border-gray-750 shadow-sm">
                            Edit Profil
                        </button>
                    @endif
                </div>

                <!-- Stats row -->
                <div class="flex items-center justify-center md:justify-start space-x-8 text-gray-400 text-sm sm:text-base py-2">
                    <button wire:click="setTab('kreasi')" class="hover:text-white transition focus:outline-none">
                        <span class="font-semibold text-white">{{ $creationsCount }}</span> kreasi
                    </button>
                    <button wire:click="setTab('like')" class="hover:text-white transition focus:outline-none">
                        <span class="font-semibold text-white">{{ $likesCount }}</span> likes
                    </button>
                    <button wire:click="setTab('followers')" class="hover:text-white transition focus:outline-none">
                        <span class="font-semibold text-white">{{ $followersCount }}</span> pengikut
                    </button>
                </div>

                <!-- Bio row -->
                <div class="text-sm text-gray-300 space-y-1">
                    <p class="font-semibold text-white">{{ $user->name }}</p>
                    <p class="text-gray-400 whitespace-pre-line leading-relaxed max-w-lg mx-auto md:mx-0">
                        {{ $user->deskripsi_profil ?: 'Belum ada deskripsi profil.' }}
                    </p>
                    @if($user->kontak)
                        <div class="pt-2">
                            <span class="inline-flex items-center text-blue-400 font-semibold hover:underline">
                                <i class="fas fa-link mr-1.5 text-xs text-blue-400"></i>
                                {{ $user->kontak }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Navigation Tabs (Instagram style) -->
        <div class="border-t border-gray-850 -mt-[1px] mb-8">
            <div class="flex justify-center space-x-6 sm:space-x-12 overflow-x-auto">
                <!-- Tab Kreasi -->
                <button wire:click="setTab('kreasi')" 
                        class="flex items-center py-4 text-xs font-semibold uppercase tracking-wider border-t-2 transition focus:outline-none {{ $tab === 'kreasi' ? 'border-white text-white font-bold' : 'border-transparent text-gray-500 hover:text-gray-300' }}">
                    <i class="fas fa-th mr-2 text-sm"></i>
                    Kreasi
                </button>

                <!-- Tab Bookmark -->
                <button wire:click="setTab('bookmark')" 
                        class="flex items-center py-4 text-xs font-semibold uppercase tracking-wider border-t-2 transition focus:outline-none {{ $tab === 'bookmark' ? 'border-white text-white font-bold' : 'border-transparent text-gray-500 hover:text-gray-300' }}">
                    <i class="far fa-bookmark mr-2 text-sm"></i>
                    Disimpan
                </button>

                <!-- Tab Likes -->
                <button wire:click="setTab('like')" 
                        class="flex items-center py-4 text-xs font-semibold uppercase tracking-wider border-t-2 transition focus:outline-none {{ $tab === 'like' ? 'border-white text-white font-bold' : 'border-transparent text-gray-500 hover:text-gray-300' }}">
                    <i class="far fa-heart mr-2 text-sm"></i>
                    Likes
                </button>

                <!-- Tab Followers -->
                <button wire:click="setTab('followers')" 
                        class="flex items-center py-4 text-xs font-semibold uppercase tracking-wider border-t-2 transition focus:outline-none {{ $tab === 'followers' ? 'border-white text-white font-bold' : 'border-transparent text-gray-500 hover:text-gray-300' }}">
                    <i class="fas fa-users mr-2 text-sm"></i>
                    Pengikut
                </button>
            </div>
        </div>

        <!-- Tab Content Area -->
        <div class="mt-4">
            @if($tab === 'kreasi')
                <livewire:user.kreasi-index :user-id="$user->id" wire:key="tab-kreasi" />
            @elseif($tab === 'bookmark')
                <livewire:user.bookmark-index :user-id="$user->id" wire:key="tab-bookmark" />
            @elseif($tab === 'like')
                <livewire:user.likes :user-id="$user->id" wire:key="tab-likes" />
            @elseif($tab === 'followers')
                <livewire:user.followers :user-id="$user->id" wire:key="tab-followers" />
            @elseif($tab === 'edit-profile')
                <!-- Form Edit Profil (Original View content styled nicely in Dark mode) -->
                <div class="bg-gray-800 rounded-xl border border-gray-700 shadow-sm p-6 sm:p-8 max-w-xl mx-auto text-white">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-white">Profil Saya</h3>
                        <p class="text-gray-400 text-sm">Kelola informasi profil Anda</p>
                    </div>

                    @if (session()->has('message'))
                        <div class="mb-4 p-4 bg-green-950 border-l-4 border-green-500 rounded-lg flex items-center text-green-200 text-sm font-medium">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="save" class="space-y-5">
                        <!-- Nama -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500">
                                    <i class="fas fa-user text-sm"></i>
                                </span>
                                <input type="text" wire:model="name"
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-700 bg-gray-900 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition text-sm text-white"
                                    placeholder="Nama lengkap">
                            </div>
                            @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email (Read-only) -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Email</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500">
                                    <i class="fas fa-envelope text-sm"></i>
                                </span>
                                <input type="email" value="{{ auth()->user()->email ?? '' }}" readonly
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-800 bg-gray-950 text-gray-400 cursor-not-allowed rounded-lg text-sm">
                            </div>
                            <p class="text-[11px] text-gray-500 mt-1">Email tidak dapat diubah</p>
                        </div>

                        <!-- Kontak -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Kontak</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500">
                                    <i class="fas fa-phone text-sm"></i>
                                </span>
                                <input type="text" wire:model="kontak"
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-700 bg-gray-900 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition text-sm text-white"
                                    placeholder="No. HP atau media sosial">
                            </div>
                            @error('kontak') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Deskripsi Profil -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Deskripsi Profil</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-3 text-gray-500">
                                    <i class="fas fa-info-circle text-sm"></i>
                                </span>
                                <textarea wire:model="deskripsi_profil" rows="4"
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-700 bg-gray-900 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition resize-none text-sm text-white"
                                    placeholder="Ceritakan tentang dirimu..."></textarea>
                            </div>
                            @error('deskripsi_profil') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                class="px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition flex items-center shadow-md hover:shadow-lg">
                                <span wire:loading.remove wire:target="save">
                                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                </span>
                                <span wire:loading wire:target="save">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <livewire:components.footer />
    <!-- endFooter -->
</div>