<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LoginModal extends Component
{
    public LoginForm $form;
    public bool $showModal = false;

    protected $listeners = ['openLoginModal' => 'open', 'closeLoginModal' => 'close'];

    public function open(): void
    {
        $this->showModal = true;
        $this->dispatch('closeRegisterModal');
    }

    public function close(): void
    {
        $this->showModal = false;
        $this->resetValidation();
        $this->form->reset();
    }

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->close();

        if (auth()->user()->role === 'admin') {
            $this->redirect(route('admin.dashboard', absolute: false), navigate: true);
        } else {
            $this->redirect(route('landing', absolute: false), navigate: true);
        }
    }

    public function switchToRegister(): void
    {
        $this->close();
        $this->dispatch('openRegisterModal');
    }

    public function render()
    {
        return view('livewire.auth.login-modal');
    }
}

