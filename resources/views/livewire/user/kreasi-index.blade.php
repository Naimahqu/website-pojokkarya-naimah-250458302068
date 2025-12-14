<div>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Kreasi</h1>
            <p class="text-gray-600">Lihat dan kelola semua kreasi Anda</p>
        </div>
       
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <!-- Search -->
    <div class="mb-6">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari kreasi..."
            class="w-full md:w-96 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>

    <!-- Kreasi Grid -->
    @if($kreasis->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach($kreasis as $kreasi)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <img src="{{ Storage::url($kreasi->foto) }}" alt="{{ $kreasi->judul }}"
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                            {{ $kreasi->tag->nama_tag }}
                        </span>
                        <h3 class="mt-2 font-semibold text-gray-800">{{ $kreasi->judul }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($kreasi->deskripsi, 60) }}</p>
                        <p class="text-xs text-gray-400 mt-2">{{ $kreasi->created_at->format('d M Y') }}</p>

                        <div class="flex space-x-2 mt-4">
                            <button wire:click="edit({{ $kreasi->id }})"
                                class="flex-1 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm font-medium hover:bg-blue-100 transition">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                            <button wire:click="delete({{ $kreasi->id }})"
                                    wire:confirm="Yakin ingin menghapus kreasi ini?"
                                class="flex-1 px-3 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-medium hover:bg-red-100 transition">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $kreasis->links() }}
    @else
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-600">Belum ada kreasi</h3>
            <p class="text-gray-500 mb-4">Mulai unggah kreasi pertamamu!</p>
            <a href="{{ route('kreasi.create') }}"
               class="inline-block px-4 py-2 bg-primary text-white rounded-lg font-medium hover:bg-primary/90 transition">
                <i class="fas fa-plus mr-2"></i>Unggah Kreasi
            </a>
        </div>
    @endif

    <!-- Edit kreasi -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">Edit Kreasi</h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form wire:submit="save">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                            <input type="text" wire:model="judul"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                            @error('judul') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea wire:model="deskripsi" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"></textarea>
                            @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                            @if($fotoPreview && !$foto)
                                <img src="{{ Storage::url($fotoPreview) }}" class="w-32 h-32 object-cover rounded-lg mb-2">
                            @endif
                            @if($foto)
                                <img src="{{ $foto->temporaryUrl() }}" class="w-32 h-32 object-cover rounded-lg mb-2">
                            @endif
                            <input type="file" wire:model="foto" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            @error('foto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tag</label>
                            <select wire:model="tagId"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                                <option value="">Pilih Tag</option>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->nama_tag }}</option>
                                @endforeach
                            </select>
                            @error('tagId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-white bg-primary rounded-lg hover:bg-primary/90">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
