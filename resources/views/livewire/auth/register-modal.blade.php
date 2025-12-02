<div>
    @if($showModal)
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
         x-data
         @keydown.escape.window="$wire.close()">
        <!-- Backdrop -->
        <div class="absolute inset-0" wire:click="close"></div>

        <!-- Modal Content -->
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden relative z-10 max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-primary to-secondary p-6 text-white">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Daftar</h2>
                    <button wire:click="close" class="text-white/80 hover:text-white text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <p class="text-white/80 mt-2">Bergabung dengan komunitas kreator Indonesia!</p>
            </div>

            <!-- Modal Body -->
            <form wire:submit="register" class="p-6 space-y-4">
                <!-- Name -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" wire:model="name" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent outline-none transition"
                            placeholder="Nama lengkap kamu">
                    </div>
                    @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" wire:model="email" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent outline-none transition"
                            placeholder="nama@email.com">
                    </div>
                    @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Kontak -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Kontak</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-phone"></i>
                        </span>
                        <input type="text" wire:model="kontak"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent outline-none transition"
                            placeholder="No. HP atau media sosial">
                    </div>
                    @error('kontak') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Deskripsi Profil -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Deskripsi Profil</label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-400">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        <textarea wire:model="deskripsi_profil" rows="3"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent outline-none transition resize-none"
                            placeholder="Ceritakan sedikit tentang dirimu..."></textarea>
                    </div>
                    @error('deskripsi_profil') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" wire:model="password" required minlength="8"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent outline-none transition"
                            placeholder="Minimal 8 karakter">
                    </div>
                    @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" wire:model="password_confirmation" required minlength="8"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent outline-none transition"
                            placeholder="Ulangi password">
                    </div>
                    @error('password_confirmation') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-primary to-secondary text-white py-3 rounded-lg font-semibold hover:opacity-90 transition transform hover:-translate-y-0.5 flex items-center justify-center">
                    <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
                    <span wire:loading wire:target="register">
                        <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
                    </span>
                </button>

                <!-- Switch to Login -->
                <p class="text-center text-gray-600 mt-4">
                    Sudah punya akun?
                    <button type="button" wire:click="switchToLogin" class="text-accent font-semibold hover:underline">
                        Masuk disini
                    </button>
                </p>
            </form>
        </div>
    </div>
    @endif
</div>

