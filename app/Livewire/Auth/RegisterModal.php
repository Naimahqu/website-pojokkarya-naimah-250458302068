<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegisterModal extends Component
{
    public bool $showModal = false;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string|lowercase|email|max:255|unique:users')]
    public string $email = '';

    #[Validate('required|string|max:255')]
    public string $kontak = '';

    #[Validate('required|string|max:1000')]
    public string $deskripsi_profil = '';

    #[Validate('required|string|min:8|confirmed')]
    public string $password = '';

    #[Validate('required|string|min:8')]
    public string $password_confirmation = '';

    protected $listeners = ['openRegisterModal' => 'open', 'closeRegisterModal' => 'close'];

    public function open(): void
    {
        $this->showModal = true;
        $this->dispatch('closeLoginModal');
    }

    public function close(): void
    {
        $this->showModal = false;
        $this->resetValidation();
        $this->reset(['name', 'email', 'kontak', 'deskripsi_profil', 'password', 'password_confirmation']);
    }

    public function register(): void
    {
        $validated = $this->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'kontak' => $validated['kontak'],
            'deskripsi_profil' => $validated['deskripsi_profil'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        event(new Registered($user));

        Auth::login($user);

        $this->close();

        $this->redirect(route('landing', absolute: false), navigate: true);
    }

    public function switchToLogin(): void
    {
        $this->close();
        $this->dispatch('openLoginModal');
    }

    public function render()
    {
        return view('livewire.auth.register-modal');
    }
}

