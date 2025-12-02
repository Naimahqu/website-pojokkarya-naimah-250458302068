<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Profil Saya</h1>
        <p class="text-gray-600">Kelola informasi profil Anda</p>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm p-6">
        <form wire:submit="save" class="space-y-6">
            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" wire:model="name"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition"
                        placeholder="Nama lengkap">
                </div>
                @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Email (Read-only) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" value="{{ auth()->user()->email }}" readonly
                        class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed">
                </div>
                <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah</p>
            </div>

            <!-- Kontak -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kontak</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-phone"></i>
                    </span>
                    <input type="text" wire:model="kontak"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition"
                        placeholder="No. HP atau media sosial">
                </div>
                @error('kontak') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Deskripsi Profil -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Profil</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-400">
                        <i class="fas fa-info-circle"></i>
                    </span>
                    <textarea wire:model="deskripsi_profil" rows="4"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition resize-none"
                        placeholder="Ceritakan tentang dirimu..."></textarea>
                </div>
                @error('deskripsi_profil') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary/90 transition flex items-center">
                    <span wire:loading.remove wire:target="save">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </span>
                    <span wire:loading wire:target="save">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

