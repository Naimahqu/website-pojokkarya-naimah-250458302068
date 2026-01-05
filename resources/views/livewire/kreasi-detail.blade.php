<div class="bg-gray-900">
    <!-- Navbar -->
        <livewire:components.navbar/>
    <!-- endnavbar -->


    <div class="max-w-6xl mx-auto px-4 py-8">
        <a href="{{ route('landing') }}" class="inline-flex items-center text-gray-50 hover:text-gray-400 mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="{{ Storage::url($kreasi->foto) }}" alt="{{ $kreasi->judul }}" class="w-full max-h-[500px] object-contain bg-gray-100">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 bg-accent/10 text-accent rounded-full text-sm font-medium">
                                {{ $kreasi->tag->nama_tag ?? 'Uncategorized' }}
                            </span>
                            <span class="text-sm text-gray-500">{{ $kreasi->created_at->format('d M Y') }}</span>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $kreasi->judul }}</h1>
                        <p class="text-gray-600 leading-relaxed">{{ $kreasi->deskripsi }}</p>

                        <!-- like -->
                        <div class="flex items-center justify-between mt-6 pt-6 border-t">
                            <div class="flex items-center space-x-4">
                                <button wire:click="toggleLike"
                                    class="flex items-center space-x-2 px-4 py-2 rounded-lg transition {{ $kreasi->isLikedBy(auth()->id()) ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                    <i class="{{ $kreasi->isLikedBy(auth()->id()) ? 'fas' : 'far' }} fa-heart"></i>
                                    <span>{{ $kreasi->likes->count() }}</span>
                                </button>

                                <!-- ButtonBookmark -->
                                <button wire:click="toggleBookmark"
                                    class="flex items-center space-x-2 px-4 py-2 rounded-lg transition {{ $kreasi->isBookmarkedBy(auth()->id()) ? 'bg-yellow-100 text-yellow-600' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                    <i class="{{ $kreasi->isBookmarkedBy(auth()->id()) ? 'fas' : 'far' }} fa-bookmark"></i>
                                    <span>Simpan</span>
                                </button>

                                <!-- Download -->
                                <button onclick="downloadImage('{{ Storage::url($kreasi->foto) }}', '{{ $kreasi->judul }}')"
                                    class="flex items-center space-x-2 px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">
                                    <i class="fas fa-download"></i>
                                    <span>Download</span>
                                </button>
                            </div>
                            
                            <!-- ngeshare -->
                            <button onclick="navigator.share ? navigator.share({title: '{{ $kreasi->judul }}', url: window.location.href}) : navigator.clipboard.writeText(window.location.href).then(() => alert('Link disalin!'))"
                                class="flex items-center space-x-2 px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">
                                <i class="fas fa-share-alt"></i>
                                <span>Bagikan</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Comments -->
                <div class="bg-white rounded-xl shadow-lg mt-6 p-6">
                    <h3 class="text-lg font-semibold mb-4">Komentar ({{ $kreasi->comments->count() }})</h3>

                    @auth
                    <form wire:submit="addComment" class="mb-6">
                        <textarea wire:model="komentar" rows="3" placeholder="Tulis komentar..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent resize-none"></textarea>
                        @error('komentar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <div class="flex justify-end mt-2">
                            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90">
                                <i class="fas fa-paper-plane mr-2"></i>Kirim
                            </button>
                        </div>
                    </form>
                    @else
                    <div class="bg-gray-50 p-4 rounded-lg mb-6 text-center">
                        <p class="text-gray-600">
                            <button onclick="Livewire.dispatch('openLoginModal')" class="text-primary font-medium hover:underline">Masuk</button>
                            untuk memberikan komentar
                        </p>
                    </div>
                    @endauth

                    <div class="space-y-4">
                        @forelse($kreasi->comments as $comment)
                        <div class="flex space-x-3 p-4 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                {{ strtoupper(substr($comment->user->name, 0, 2)) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-800">{{ $comment->user->name }}</span>
                                    <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-600 mt-1">{{ $comment->komentar }}</p>
                                @if(auth()->id() === $comment->user_id)
                                <button wire:click="deleteComment({{ $comment->id }})" wire:confirm="Hapus komentar ini?"
                                    class="text-red-500 text-xs mt-2 hover:underline"><i class="fas fa-trash"></i></button>
                                @endif
                            </div>
                        </div>
                        @empty
                        <p class="text-center text-gray-500 py-4">Belum ada komentar</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Creator Info -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4">Kreator</h3>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($kreasi->user->name ?? 'U', 0, 2)) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $kreasi->user->name ?? 'Unknown' }}</p>
                            <p class="text-sm text-gray-500">{{ $kreasi->user->deskripsi_profil ?? '' }}</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t space-y-3">
                        <!-- Follow Button -->
                        @if(auth()->id() !== $kreasi->user_id)
                        <button wire:click="toggleFollow"
                            class="w-full flex items-center justify-center space-x-2 px-4 py-2 rounded-lg transition {{ $this->isFollowing() ? 'bg-gray-200 text-gray-700 hover:bg-gray-300' : 'bg-primary text-white hover:bg-primary/90' }}">
                            <i class="fas {{ $this->isFollowing() ? 'fa-user-check' : 'fa-user-plus' }}"></i>
                            <span>{{ $this->isFollowing() ? 'Mengikuti' : 'Ikuti' }}</span>
                        </button>
                        @endif

                        <!-- WhatsApp Button -->
                        @if($kreasi->user->kontak)
                        <a href="{{ $this->getWhatsappUrl() }}" target="_blank"
                            class="w-full flex items-center justify-center space-x-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            <i class="fab fa-whatsapp text-lg"></i>
                            <span>Hubungi via WhatsApp </span>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Rating -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Rating</h3>
                    <div class="text-center mb-4">
                        <span class="text-4xl font-bold text-yellow-500">{{ number_format($kreasi->averageRating(), 1) }}</span>
                        <span class="text-gray-500">/5</span>
                        <p class="text-sm text-gray-500 mt-1">{{ $kreasi->ratings->count() }} penilaian</p>
                    </div>
                    <div class="flex justify-center space-x-2">
                        @for($i = 1; $i <= 5; $i++)
                        <button wire:click="setRating({{ $i }})"
                            class="text-2xl transition hover:scale-110 {{ $i <= $userRating ? 'text-yellow-500' : 'text-gray-300' }}">
                            <i class="{{ $i <= $userRating ? 'fas' : 'far' }} fa-star"></i>
                        </button>
                        @endfor
                    </div>
                    @guest
                    <p class="text-center text-sm text-gray-500 mt-3">
                        <button onclick="Livewire.dispatch('openLoginModal')" class="text-primary hover:underline">Masuk</button> untuk memberi rating
                    </p>
                    @endguest
                </div>
            </div>
        </div>
    </div>

 <!-- Footer -->
         <livewire:components.footer/>
    <!-- endFooter -->

    <script>
        function downloadImage(url, title) {
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal mengambil gambar');
                    }
                    return response.blob();
                })
                .then(blob => {
                    const extension = url.split('.').pop().split('?')[0] || 'jpg';
                    const filename = title.replace(/[^a-zA-Z0-9]/g, '_') + '.' + extension;

                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = filename;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    URL.revokeObjectURL(link.href);

                    alert('Gambar berhasil didownload!');
                })
                .catch(error => {
                    console.error('Download error:', error);
                    alert('Gagal mendownload gambar. Silakan coba lagi.');
                });
        }
    </script>
</div>
