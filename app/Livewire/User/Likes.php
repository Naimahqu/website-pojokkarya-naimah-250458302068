<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Likes extends Component
{
    use WithPagination;

    public function render()
    {
        // Ambil semua kreasi user yang punya likes
        $kreasi = Auth::user()->kreasi()
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