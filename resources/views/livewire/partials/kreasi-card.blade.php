<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer">
    <a href="{{ route('kreasi.detail', $kreasi->id) }}" class="block">
        <div class="relative">
            <div class="w-full h-48 rounded-t-xl overflow-hidden">
                <img src="{{ Storage::url($kreasi->foto) }}" alt="{{ $kreasi->judul }}" class="w-full h-full object-cover">
            </div>
            <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                {{ $kreasi->tag->nama_tag ?? 'Uncategorized' }}
            </span>
        </div>
    </a>
    <div class="p-4">
        <a href="{{ route('kreasi.detail', $kreasi->id) }}" class="block mb-2">
            <h3 class="font-semibold text-gray-800 truncate">{{ $kreasi->judul }}</h3>
            <p class="text-sm text-gray-500 truncate">{{ Str::limit($kreasi->deskripsi, 50) }}</p>
        </a>
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                    {{ strtoupper(substr($kreasi->user->name ?? 'U', 0, 2)) }}
                </div>
                <span class="text-xs text-gray-500">{{ $kreasi->user->name ?? 'Unknown' }}</span>
            </div>
            <div class="flex space-x-2">
                <button wire:click.stop="toggleLike({{ $kreasi->id }})"
                    class="text-gray-400 hover:text-red-500 transition {{ auth()->check() && $kreasi->isLikedBy(auth()->id()) ? 'text-red-500' : '' }}">
                    <i class="{{ auth()->check() && $kreasi->isLikedBy(auth()->id()) ? 'fas' : 'far' }} fa-heart"></i>
                    <span class="text-xs ml-1">{{ $kreasi->likes_count }}</span>
                </button>
                <a href="{{ route('kreasi.detail', $kreasi->id) }}" class="text-gray-400 hover:text-blue-500 transition">
                    <i class="far fa-comment"></i>
                    <span class="text-xs ml-1">{{ $kreasi->comments_count }}</span>
                </a>
                <button wire:click.stop="toggleBookmark({{ $kreasi->id }})"
                    class="text-gray-400 hover:text-yellow-500 transition {{ auth()->check() && $kreasi->isBookmarkedBy(auth()->id()) ? 'text-yellow-500' : '' }}">
                    <i class="{{ auth()->check() && $kreasi->isBookmarkedBy(auth()->id()) ? 'fas' : 'far' }} fa-bookmark"></i>
                </button>
            </div>
        </div>
    </div>
</div>

