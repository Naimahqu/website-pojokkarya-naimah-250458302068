<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Followers extends Component
{
    use WithPagination;

    public ?int $userId = null;

    public function mount(?int $userId = null): void
    {
        $this->userId = $userId ?? Auth::id();
    }

    public function render()
    {
        $user = User::findOrFail($this->userId);

        $followers = $user->followers()
            ->latest()
            ->paginate(20);

        return view('livewire.user.followers', [
            'followers' => $followers,
            'totalFollowers' => $user->followers()->count()
        ]);
    }
}