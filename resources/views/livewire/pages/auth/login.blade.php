<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(route('landing', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary to-secondary p-6 text-white">
        <h2 class="text-2xl font-bold">Masuk</h2>
        <p class="text-white/80 mt-2">Selamat datang kembali di PojokKaarya!</p>
    </div>

    <!-- Form -->
    <form wire:submit="login" class="p-6 space-y-4">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Email -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Email</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <i class="fas fa-envelope"></i>
                </span>
                <input type="email" wire:model="form.email" required autofocus
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

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" wire:model="form.remember" class="w-4 h-4 text-accent border-gray-300 rounded focus:ring-accent">
                <span class="ml-2 text-gray-600 text-sm">Ingat saya</span>
            </label>
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
            <a href="{{ route('register') }}" wire:navigate class="text-accent font-semibold hover:underline">
                Daftar sekarang
            </a>
        </p>
    </form>
</div>
