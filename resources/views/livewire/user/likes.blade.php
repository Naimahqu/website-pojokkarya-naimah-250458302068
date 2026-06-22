<div class="space-y-6">
    <div class="mb-4">
        <h3 class="text-lg font-bold text-gray-800">
            {{ auth()->check() && auth()->id() === $userId ? 'Likes yang Saya Terima' : 'Likes yang Diterima' }}
        </h3>
        <p class="text-sm text-gray-500">
            {{ auth()->check() && auth()->id() === $userId ? 'Lihat siapa saja yang mengapresiasi karya-karya Anda' : 'Karya-karya yang diapresiasi oleh komunitas' }}
        </p>
    </div>

    @if($kreasi->count() > 0)
        <div class="space-y-4">
            @foreach($kreasi as $item)
                <div class="bg-white rounded-xl border border-gray-200 p-4 sm:p-5 flex items-start space-x-4 shadow-sm">
                    <!-- Thumbnail Kreasi -->
                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                        <img src="{{ Storage::url($item->foto) }}" 
                             alt="{{ $item->judul }}"
                             class="w-full h-full object-cover">
                    </div>
                    
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('kreasi.detail', $item->id) }}" 
                           class="font-semibold text-base sm:text-lg text-gray-800 hover:text-blue-600 truncate block transition mb-1">
                            {{ $item->judul }}
                        </a>
                        <p class="text-xs sm:text-sm text-gray-500 mb-3 flex items-center">
                            <i class="fas fa-heart text-red-500 mr-1.5 animate-pulse"></i>
                            <span class="font-semibold text-gray-800 mr-1">{{ $item->likes_count }}</span> orang menyukai kreasi ini
                        </p>

                        <!-- List User yang Like (Avatars) -->
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($item->likes->take(10) as $like)
                                <a href="{{ route('profile', $like->user->id) }}" class="flex items-center space-x-1.5 bg-gray-50 border border-gray-200 rounded-full pl-1.5 pr-3 py-1 shadow-sm hover:bg-gray-100 transition duration-150" title="{{ $like->user->name }}">
                                    <div class="w-5 h-5 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-[10px] font-extrabold shadow-sm">
                                        {{ strtoupper(substr($like->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-xs text-gray-700 font-medium truncate max-w-[100px]">{{ $like->user->name }}</span>
                                </a>
                            @endforeach

                            @if($item->likes_count > 10)
                                <span class="text-xs text-gray-400 self-center pl-1 font-semibold">
                                    +{{ $item->likes_count - 10 }} lainnya
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pt-4">
            {{ $kreasi->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center max-w-md mx-auto shadow-sm">
            <div class="w-16 h-16 mx-auto mb-4 bg-gray-50 rounded-full flex items-center justify-center">
                <i class="far fa-heart text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Belum Ada Likes</h3>
            <p class="text-gray-500 text-sm">
                {{ auth()->check() && auth()->id() === $userId ? 'Unggah karya terbaik Anda untuk mulai mengumpulkan apresiasi dari komunitas!' : 'Kreator belum menerima apresiasi untuk karya-karyanya.' }}
            </p>
        </div>
    @endif
</div>