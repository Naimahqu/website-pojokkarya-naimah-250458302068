<div>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Likes yang Saya Terima</h1>

        @if($kreasi->count() > 0)
            <div class="space-y-6">
                @foreach($kreasi as $item)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-start space-x-4">
                            <!-- Thumbnail Kreasi -->
                            <img src="{{ Storage::url($item->gambar) }}" 
                                 alt="{{ $item->judul }}"
                                 class="w-24 h-24 object-cover rounded-lg">
                            
                            <div class="flex-1">
                                <a href="{{ route('kreasi.detail', $item->id) }}" 
                                   class="font-semibold text-lg text-gray-800 hover:text-blue-600 mb-2 block">
                                    {{ $item->judul }}
                                </a>
                                <p class="text-sm text-gray-600 mb-3">
                                    <i class="fas fa-heart text-red-500 mr-1"></i>
                                    {{ $item->likes_count }} orang menyukai kreasi ini
                                </p>

                                <!-- List User yang Like -->
                                <div class="flex flex-wrap gap-2">
                                    @foreach($item->likes->take(10) as $like)
                                        <div class="flex items-center space-x-2 bg-gray-100 rounded-full px-3 py-1">
                                            <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-xs font-semibold">
                                                {{ strtoupper(substr($like->user->name, 0, 1)) }}
                                            </div>
                                            <span class="text-sm text-gray-700">{{ $like->user->name }}</span>
                                        </div>
                                    @endforeach

                                    @if($item->likes_count > 10)
                                        <span class="text-sm text-gray-500 px-3 py-1">
                                            +{{ $item->likes_count - 10 }} lainnya
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $kreasi->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <i class="fas fa-heart text-gray-400 text-6xl mb-4"></i>
                <p class="text-gray-600 text-lg font-semibold">Belum ada yang like kreasi kamu</p>
                <p class="text-sm text-gray-500 mt-2">Upload kreasi menarik untuk mendapatkan likes!</p>
                <a href="" 
                   class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Upload Kreasi Baru
                </a>
            </div>
        @endif
    </div>
</div>