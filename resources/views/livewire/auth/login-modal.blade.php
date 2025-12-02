<div>
    @if($showModal)
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
         x-data
         @keydown.escape.window="$wire.close()">
        <!-- Backdrop -->
        <div class="absolute inset-0" wire:click="close"></div>

        <!-- Modal Content -->
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden relative z-10">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-primary to-secondary p-6 text-white">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Masuk</h2>
                    <button wire:click="close" class="text-white/80 hover:text-white text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <p class="text-white/80 mt-2">Selamat datang kembali di PojokKaarya!</p>
            </div>

            <!-- Modal Body -->
            <form wire:submit="login" class="p-6 space-y-4">
                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" wire:model="form.email" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent outline-none transition"
                            placeholder="nama@email.com">
                    </div>
                    @error('form.email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" wire:model="form.password" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-transparent outline-none transition"
                            placeholder="Masukkan password">
                    </div>
                    @error('form.password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" wire:model="form.remember" class="w-4 h-4 text-accent border-gray-300 rounded focus:ring-accent">
                        <span class="ml-2 text-gray-600 text-sm">Ingat saya</span>
                    </label>
                    <!-- <a href="{{ route('password.request') }}" class="text-accent text-sm hover:underline">Lupa password?</a> -->
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-primary to-secondary text-white py-3 rounded-lg font-semibold hover:opacity-90 transition transform hover:-translate-y-0.5 flex items-center justify-center">
                    <span wire:loading.remove wire:target="login">Masuk</span>
                    <span wire:loading wire:target="login">
                        <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
                    </span>
                </button>

                <!-- Switch to Register -->
                <p class="text-center text-gray-600 mt-4">
                    Belum punya akun?
                    <button type="button" wire:click="switchToRegister" class="text-accent font-semibold hover:underline">
                        Daftar sekarang
                    </button>
                </p>
            </form>
        </div>
    </div>
    @endif
</div>

