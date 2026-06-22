<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use App\Models\Like;
use App\Models\User;

class Profile extends Component
{
    #[Url(keep: true)]
    public string $tab = 'kreasi';

    public ?User $user = null;

    public string $name = '';
    public string $kontak = '';
    public string $deskripsi_profil = '';

    public function mount(?User $user = null)
    {
        // If no user is passed or it is empty, default to the authenticated user
        $this->user = $user && $user->exists ? $user : Auth::user();

        if (!$this->user) {
            return redirect()->route('login');
        }

        $this->name = $this->user->name;
        $this->kontak = $this->user->kontak ?? '';
        $this->deskripsi_profil = $this->user->deskripsi_profil ?? '';

        // Pre-select tab based on current route if not explicitly set in query parameters
        if (!request()->has('tab')) {
            $routeName = request()->route()->getName();
            if ($routeName === 'kreasi.index') {
                $this->tab = 'kreasi';
            } elseif ($routeName === 'bookmarks') {
                $this->tab = 'bookmark';
            } elseif ($routeName === 'likes') {
                $this->tab = 'like';
            } elseif ($routeName === 'followers') {
                $this->tab = 'followers';
            } elseif ($routeName === 'profile') {
                // If viewing someone else, default to 'kreasi', otherwise 'edit-profile'
                if ($this->user->id !== Auth::id()) {
                    $this->tab = 'kreasi';
                } else {
                    $this->tab = 'edit-profile';
                }
            }
        }
    }

    public function setTab(string $tabName): void
    {
        $this->tab = $tabName;
    }

    public function toggleFollow(): void
    {
        if (!Auth::check()) {
            $this->dispatch('openLoginModal');
            return;
        }

        if (Auth::id() === $this->user->id) {
            return;
        }

        $currentUser = Auth::user();
        if ($currentUser->isFollowing($this->user->id)) {
            $currentUser->following()->detach($this->user->id);
        } else {
            $currentUser->following()->attach($this->user->id);
        }
    }

    public function save(): void
    {
        // Only allow saving if editing own profile
        if (Auth::id() !== $this->user->id) {
            return;
        }

        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'deskripsi_profil' => 'required|string|max:1000',
        ]);

        Auth::user()->update($validated);

        session()->flash('message', 'Profil berhasil diperbarui!');
    }

    public function render()
    {
        $user = $this->user;
        
        // Calculate counts
        $creationsCount = $user->kreasi()->count();
        $followersCount = $user->followers()->count();
        $likesCount = Like::whereHas('kreasi', fn($q) => $q->where('user_id', $user->id))->count();

        return view('livewire.user.profile', [
            'creationsCount' => $creationsCount,
            'followersCount' => $followersCount,
            'likesCount' => $likesCount,
        ])->layout('components.layouts.landing', ['title' => 'Profil - ' . $user->name]);
    }
}