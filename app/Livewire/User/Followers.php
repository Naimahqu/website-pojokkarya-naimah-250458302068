<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Followers extends Component
{
    use WithPagination;

    public function render()
    {
        $followers = Auth::user()->followers()
            ->latest()
            ->paginate(20);

        return view('livewire.user.followers', [
            'followers' => $followers,
            'totalFollowers' => Auth::user()->followers()->count()
        ]);
    }
}