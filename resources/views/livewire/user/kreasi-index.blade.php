<div class="space-y-6">
    <!-- Header Controls -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
        <!-- Search bar -->
        <div class="relative w-full sm:max-w-xs shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400 text-sm"></i>
            </div>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="Cari kreasi..."
                   class="block w-full pl-9 pr-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition duration-150">
        </div>

        <!-- Add Creation Button -->
        @if(auth()->check() && auth()->id() === $userId)
        <a href="{{ route('kreasi.create') }}" 
           class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold transition duration-150 shadow-sm">
            <i class="fas fa-plus mr-2 text-xs"></i>
            Buat Kreasi Baru
        </a>
        @endif
    </div>

    @if (session()->has('message'))
        <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded-lg flex items-center text-green-700 text-sm font-medium">
            <i class="fas fa-check-circle mr-2 text-green-500 text-base"></i>
            {{ session('message') }}
        </div>
    @endif

    <!-- Home-Page Aligned Card Grid -->
    @if($kreasis->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($kreasis as $kreasi)
                <div class="font-serif bg-gray-900 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer flex flex-col justify-between h-full overflow-hidden">
                    <div>
                        <!-- Thumbnail Image -->
                        <div class="relative">
                            <div class="w-full h-48 bg-gray-950 overflow-hidden">
                                <img src="{{ Storage::url($kreasi->foto) }}" alt="{{ $kreasi->judul }}" class="w-full h-full object-cover">
                            </div>
                            <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                                {{ $kreasi->tag->nama_tag ?? 'Uncategorized' }}
                            </span>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-4">
                            <div class="block mb-2">
                                <h3 class="font-semibold text-gray-200 truncate">{{ $kreasi->judul }}</h3>
                                <p class="text-sm text-gray-500 truncate">{{ Str::limit($kreasi->deskripsi, 50) }}</p>
                            </div>
                            
                            <div class="flex justify-between items-center text-gray-400 text-xs mt-3 pt-3 border-t border-gray-800">
                                <span class="flex items-center">
                                    <i class="far fa-heart mr-1.5 text-red-500"></i>
                                    {{ $kreasi->likes()->count() }} likes
                                </span>
                                <span class="flex items-center">
                                    <i class="far fa-calendar mr-1.5"></i>
                                    {{ $kreasi->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Owner Action buttons -->
                    @if(auth()->check() && auth()->id() === $userId)
                    <div class="p-4 pt-0 flex gap-2">
                        <button wire:click="edit({{ $kreasi->id }})"
                                class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-semibold transition duration-150 shadow-sm">
                            <i class="fas fa-edit mr-1.5 text-[10px]"></i>
                            Edit
                        </button>
                        <button wire:click="delete({{ $kreasi->id }})"
                                wire:confirm="Yakin ingin menghapus kreasi ini?"
                                class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-semibold transition duration-150 shadow-sm">
                            <i class="fas fa-trash mr-1.5 text-[10px]"></i>
                            Hapus
                        </button>
                    </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pt-6">
            {{ $kreasis->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center max-w-md mx-auto shadow-sm">
            <div class="w-16 h-16 mx-auto mb-4 bg-gray-50 rounded-full flex items-center justify-center">
                <i class="fas fa-images text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Belum Ada Kreasi</h3>
            <p class="text-gray-500 text-sm mb-6">
                {{ auth()->check() && auth()->id() === $userId ? 'Mulai unggah kreasi pertamamu dan bagikan karya terbaikmu!' : 'Kreator belum mengunggah karya apapun.' }}
            </p>
            @if(auth()->check() && auth()->id() === $userId)
            <a href="{{ route('kreasi.create') }}"
               class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold shadow transition-all">
                <i class="fas fa-plus mr-2 text-xs"></i>
                Buat Kreasi Pertama
            </a>
            @endif
        </div>
    @endif

    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center p-4 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden animate-slide-up">
                <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-blue-50 to-blue-100">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Edit Kreasi</h3>
                        <p class="text-sm text-gray-600 mt-0.5">Perbarui informasi kreasi Anda</p>
                    </div>
                    <button wire:click="closeModal" 
                            class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-200 transition">
                        <i class="fas fa-times text-gray-600 text-lg"></i>
                    </button>
                </div>

                <form wire:submit="save">
                    <div class="p-6 space-y-6 overflow-y-auto max-h-[calc(90vh-140px)]">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-heading text-gray-400 mr-2"></i>
                                Judul Kreasi
                            </label>
                            <input type="text" 
                                   wire:model="judul"
                                   placeholder="Masukkan judul kreasi"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            @error('judul') 
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-align-left text-gray-400 mr-2"></i>
                                Deskripsi
                            </label>
                            <textarea wire:model="deskripsi" 
                                      rows="4"
                                      placeholder="Ceritakan tentang kreasi Anda"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"></textarea>
                            @error('deskripsi') 
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-image text-gray-400 mr-2"></i>
                                Foto Kreasi
                            </label>
                            
                            @if($fotoPreview && !$foto)
                                <div class="mb-3">
                                    <img src="{{ Storage::url($fotoPreview) }}" 
                                         class="w-full h-48 object-cover rounded-lg shadow-sm">
                                </div>
                            @endif
                            
                            @if($foto)
                                <div class="mb-3">
                                    <img src="{{ $foto->temporaryUrl() }}" 
                                         class="w-full h-48 object-cover rounded-lg shadow-sm">
                                </div>
                            @endif

                            <div class="relative">
                                <input type="file" 
                                       wire:model="foto" 
                                       accept="image/*"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-600 file:font-semibold hover:file:bg-blue-100 transition">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, atau GIF (Max: 2MB)</p>
                            @error('foto') 
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tag text-gray-400 mr-2"></i>
                                Kategori
                            </label>
                            <select wire:model="tagId"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                <option value="">Pilih Kategori</option>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->nama_tag }}</option>
                                @endforeach
                            </select>
                            @error('tagId') 
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                        <button type="button" 
                                wire:click="closeModal"
                                class="px-6 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg font-semibold hover:bg-gray-50 transition">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-6 py-2.5 text-white bg-blue-600 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                            <span wire:loading.remove wire:target="save">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Perubahan
                            </span>
                            <span wire:loading wire:target="save">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <style>
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slide-up {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.2s ease-out;
        }

        .animate-slide-up {
            animation: slide-up 0.3s ease-out;
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div> ```

