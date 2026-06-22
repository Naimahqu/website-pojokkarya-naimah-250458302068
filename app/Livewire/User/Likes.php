<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Likes extends Component
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

        // Ambil semua kreasi user yang punya likes
        $kreasi = $user->kreasi()
            ->with(['likes.user']) // Include user yang like
            ->withCount('likes')
            ->having('likes_count', '>', 0)
            ->latest()
            ->paginate(12);

        return view('livewire.user.likes', [
            'kreasi' => $kreasi
        ]);
    }
}