<?php

namespace App\Livewire\User;

use Livewire\Component;

class Profile extends Component
{
    public string $name = '';
    public string $kontak = '';
    public string $deskripsi_profil = '';

    public function mount(): void
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->kontak = $user->kontak ?? '';
        $this->deskripsi_profil = $user->deskripsi_profil ?? '';
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'deskripsi_profil' => 'required|string|max:1000',
        ]);

        auth()->user()->update($validated);

        session()->flash('message', 'Profil berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.user.profile')
            ->layout('layouts.user', ['title' => 'Profil Saya']);
    }
}

