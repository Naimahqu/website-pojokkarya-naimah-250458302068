<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Unggah Kreasi Baru</h1>
        <p class="text-gray-600">Bagikan karya terbaikmu dengan dunia</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <form wire:submit="save" class="space-y-6">
            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Kreasi</label>
                <input type="text" wire:model="judul"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition"
                    placeholder="Masukkan judul kreasi">
                @error('judul') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea wire:model="deskripsi" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition resize-none"
                    placeholder="Ceritakan tentang kreasi ini..."></textarea>
                @error('deskripsi') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Foto -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kreasi</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <div wire:loading wire:target="foto" class="mb-4">
                        <i class="fas fa-spinner fa-spin text-3xl text-primary"></i>
                        <p class="text-gray-500 mt-2">Mengupload foto...</p>
                    </div>
                    <div wire:loading.remove wire:target="foto">
                        @if($foto)
                            <img src="{{ $foto->temporaryUrl() }}" class="mx-auto max-h-64 rounded-lg mb-4">
                        @endif
                    </div>
                    <input type="file" wire:model="foto" accept="image/*" class="w-full">
                </div>
                @error('foto') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Tag -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori/Tag</label>
                <select wire:model="tagId"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition">
                    <option value="">Pilih Kategori</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->nama_tag }}</option>
                    @endforeach
                </select>
                @error('tagId') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Submit -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('kreasi.index') }}"
                   class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Batal
                </a>
                <button type="submit"
                    wire:loading.attr="disabled"
                    wire:target="foto,save"
                    class="px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary/90 transition flex items-center disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="foto,save">
                        <i class="fas fa-upload mr-2"></i>Unggah Kreasi
                    </span>
                    <span wire:loading wire:target="foto">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Mengupload foto...
                    </span>
                    <span wire:loading wire:target="save">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

