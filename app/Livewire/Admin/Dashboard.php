<?php

namespace App\Livewire\Admin;

use App\Livewire\Actions\Logout;
use App\Models\Kreasi;
use App\Models\Tag;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public array $stats = [];

    public function mount(): void
    {
        $this->stats = [
            'total_users' => User::count(),
            'total_kreasi' => Kreasi::count(),
            'total_tags' => Tag::count(),
            'kreasi_today' => Kreasi::whereDate('created_at', today())->count(),
        ];
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('layouts.admin', ['title' => 'Dashboard']);
    }
}

