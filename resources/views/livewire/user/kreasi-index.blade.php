<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Kelola Kreasi</h1>
            <p class="text-gray-600 mt-1">Lihat dan kelola semua kreasi Anda</p>
        </div>
        
        <a href="{{ route('kreasi.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
            <i class="fas fa-plus mr-2"></i>
            Buat Kreasi Baru
        </a>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg flex items-center">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <span class="text-green-700 font-medium">{{ session('message') }}</span>
        </div>
    @endif

    <div class="mb-8">
        <div class="relative max-w-md">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="Cari kreasi berdasarkan judul..."
                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
        </div>
    </div>

    @if($kreasis->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach($kreasis as $kreasi)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group">
                    <div class="relative overflow-hidden">
                        <img src="{{ Storage::url($kreasi->foto) }}" 
                             alt="{{ $kreasi->judul }}"
                             class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-300">
                        
                        <span class="absolute top-3 left-3 px-3 py-1 bg-blue-600 text-white rounded-full text-xs font-semibold shadow-md">
                            {{ $kreasi->tag->nama_tag }}
                        </span>
                    </div>

                    <div class="p-5">
                        <h3 class="font-bold text-gray-800 text-lg mb-2 line-clamp-1">
                            {{ $kreasi->judul }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            {{ $kreasi->deskripsi }}
                        </p>
                        
                        <div class="flex items-center text-xs text-gray-500 mb-4">
                            <i class="far fa-calendar mr-2"></i>
                            {{ $kreasi->created_at->format('d M Y') }}
                        </div>

                        <div class="flex gap-2">
                            <button wire:click="edit({{ $kreasi->id }})"
                                    class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-blue-50 text-blue-600 rounded-lg text-sm font-semibold hover:bg-blue-100 transition">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </button>
                            <button wire:click="delete({{ $kreasi->id }})"
                                    wire:confirm="Yakin ingin menghapus kreasi ini?"
                                    class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-red-50 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-100 transition">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $kreasis->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="fas fa-images text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Kreasi</h3>
            <p class="text-gray-600 mb-6">Mulai unggah kreasi pertamamu dan bagikan karya terbaikmu!</p>
            <a href="{{ route('kreasi.create') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                <i class="fas fa-plus mr-2"></i>
                Buat Kreasi Pertama
            </a>
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

