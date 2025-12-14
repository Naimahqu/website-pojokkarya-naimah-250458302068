<?php

namespace App\Livewire\User;

use App\Models\Like;
use App\Models\Follow;
use App\Models\Kreasi;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();

        $totalKreasi = Kreasi::where('user_id', $user->id)->count();

        // Total likes dari semua kreasi user
        $kreasiIds = Kreasi::where('user_id', $user->id)->pluck('id');
        $totalLikes = Like::whereIn('kreasi_id', $kreasiIds)->count();

        // Total follower (orang yang follow user ini)
        $totalFollowers = Follow::where('followed_id', $user->id)->count();

        return view('livewire.user.dashboard', [
            'totalKreasi' => $totalKreasi,
            'totalLikes' => $totalLikes,
            'totalFollowers' => $totalFollowers,
        ])->layout('layouts.user', ['title' => 'Dashboard']);
    }
}

