<div class="p-6">
    <h2 class="text-3xl font-extrabold mb-8 text-gray-900 border-b pb-4"> <strong>💕Kreasi Tersimpan</strong></h2>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 border-l-4 border-green-500 rounded-lg shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif


    @if($bookmarks->count() > 0)
        {{-- Grid Display (Menggunakan style grid Landing Page) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach($bookmarks as $bookmark)
                @php
                    $kreasi = $bookmark->kreasi; 
                    // Pastikan kreasi ada
                    if (!$kreasi) continue; 
                @endphp

                {{-- START: CARD DENGAN STYLE YANG DIINGINKAN --}}
                <div wire:key="bookmark-{{ $bookmark->id }}" 
                     class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer">
                    
                    <a href="{{ route('kreasi.detail', $kreasi->id) }}" class="block">
                        <div class="relative">
                            <div class="w-full h-48 rounded-t-xl overflow-hidden">
                                <img src="{{ Storage::url($kreasi->foto) }}" 
                                     alt="{{ $kreasi->judul }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            
                            {{-- Badge Tag --}}
                            {{-- Menggunakan class text-primary (asumsi sudah didefinisikan) --}}
                            <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary shadow-md">
                                {{ $kreasi->tag->nama_tag ?? 'Uncategorized' }}
                            </span>
                        </div>
                    </a>

                    <div class="p-4">
                        <a href="{{ route('kreasi.detail', $kreasi->id) }}" class="block mb-2">
                            <h3 class="font-semibold text-gray-800 truncate">{{ $kreasi->judul }}</h3>
                            <p class="text-sm text-gray-500 truncate">{{ Str::limit($kreasi->deskripsi, 50) }}</p>
                        </a>
                        
                        <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                            
                            {{-- Informasi User Kreator --}}
                            <div class="flex items-center space-x-2">
                                {{-- Menggunakan gradient primary-secondary (asumsi sudah didefinisikan) --}}
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr($kreasi->user->name ?? 'U', 0, 2)) }}
                                </div>
                                <span class="text-xs text-gray-500">{{ $kreasi->user->name ?? 'Unknown' }}</span>
                            </div>

                            {{-- Aksi Interaksi (Like, Comment, Bookmark) --}}
                            <div class="flex space-x-2">
                                
                                {{-- Tombol Like --}}
                                <button wire:click.stop="toggleLike({{ $kreasi->id }})"
                                    class="text-gray-400 hover:text-red-500 transition 
                                            {{ Auth::check() && $kreasi->isLikedBy(Auth::id()) ? 'text-red-500' : '' }}">
                                    <i class="{{ Auth::check() && $kreasi->isLikedBy(Auth::id()) ? 'fas' : 'far' }} fa-heart"></i>
                                    <span class="text-xs ml-1">{{ $kreasi->likes_count ?? 0 }}</span>
                                </button>

                                {{-- Link Komentar --}}
                                <a href="{{ route('kreasi.detail', $kreasi->id) }}" class="text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">{{ $kreasi->comments_count ?? 0 }}</span>
                                </a>

                                {{-- TOMBOL UNBOOKMARK (Selalu SOLID dan diubah menjadi TOMBOL HAPUS) --}}
                                <button wire:click.stop="toggleBookmark({{ $kreasi->id }})"
                                    wire:loading.attr="disabled"
                                    class="text-yellow-500 hover:text-red-600 transition"
                                    title="Hapus dari Bookmark">
                                    {{-- Ikon selalu SOLID karena berada di halaman Bookmark --}}
                                    <i class="fas fa-bookmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END: CARD DENGAN STYLE YANG DIINGINKAN --}}
            @endforeach

        </div>

        <div class="mt-10 flex justify-center">
            {{ $bookmarks->links() }}
        </div>

    @else
        <div class="text-center py-20 bg-gray-50 border border-dashed border-gray-300 rounded-xl mx-auto max-w-lg shadow-inner">
            <i class="far fa-bookmark text-6xl text-gray-300 mb-4"></i>
            <p class="mb-2 text-xl font-semibold text-gray-600">Daftar Bookmark Kosong</p>
            <p class="text-sm text-gray-500">Saatnya jelajahi dan simpan kreasi favorit Anda!</p>
        </div>
    @endif
</div>