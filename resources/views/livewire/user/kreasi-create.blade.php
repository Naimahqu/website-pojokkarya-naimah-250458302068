<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Unggah Kreasi Baru</h1>
        <p class="text-gray-600 mt-1">Bagikan karya terbaikmu dengan komunitas</p>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <form wire:submit="save" class="p-8 space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-heading text-gray-400 mr-2"></i>Judul Kreasi
                </label>
                <input type="text" wire:model="judul"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                    placeholder="Masukkan judul kreasi yang menarik">
                @error('judul') 
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p> 
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-align-left text-gray-400 mr-2"></i>Deskripsi
                </label>
                <textarea wire:model="deskripsi" rows="5"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-none"
                    placeholder="Ceritakan detail proses pembuatan atau makna dari kreasimu..."></textarea>
                @error('deskripsi') 
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p> 
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-image text-gray-400 mr-2"></i>Foto Kreasi
                </label>
                <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-400 transition-colors bg-gray-50">
                    <input type="file" wire:model="foto" accept="image/*" 
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    
                    <div wire:loading wire:target="foto" class="space-y-3">
                        <i class="fas fa-spinner fa-spin text-3xl text-blue-600"></i>
                        <p class="text-blue-600 font-medium">Sedang memproses gambar...</p>
                    </div>

                    <div wire:loading.remove wire:target="foto">
                        @if($foto)
                            <div class="relative inline-block">
                                <img src="{{ $foto->temporaryUrl() }}" class="mx-auto max-h-72 rounded-lg shadow-lg">
                                <p class="mt-3 text-sm text-blue-600 font-semibold">Klik atau seret untuk ganti foto</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto">
                                    <i class="fas fa-cloud-upload-alt text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-medium text-gray-700">Klik untuk unggah gambar</p>
                                    <p class="text-sm text-gray-500">PNG, JPG, JPEG (Maks. 2MB)</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @error('foto') 
                    <p class="text-red-500 text-xs mt-2 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p> 
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-tag text-gray-400 mr-2"></i>Kategori
                </label>
                <select wire:model="tagId"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition bg-white">
                    <option value="">Pilih Kategori Kreasi</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->nama_tag }}</option>
                    @endforeach
                </select>
                @error('tagId') 
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                    </p> 
                @enderror
            </div>

            <hr class="border-gray-100 my-8">

            <div class="flex flex-col sm:flex-row justify-end gap-3">
                <a href="{{ route('kreasi.index') }}"
                   class="px-8 py-3 bg-gray-100 text-gray-700 rounded-lg font-bold hover:bg-gray-200 transition text-center">
                    Batal
                </a>
                <button type="submit"
                    wire:loading.attr="disabled"
                    wire:target="foto,save"
                    class="px-8 py-3 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition flex items-center justify-center shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                    
                    <span wire:loading.remove wire:target="save">
                        <i class="fas fa-paper-plane mr-2"></i> Publikasikan Kreasi
                    </span>
                    
                    <span wire:loading wire:target="save">
                        <i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>