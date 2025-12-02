<?php

namespace App\Livewire;

use App\Models\Kreasi;
use App\Models\Like;
use App\Models\Bookmark;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class KreasiDetail extends Component
{
    public Kreasi $kreasi;
    public string $komentar = '';
    public int $userRating = 0;

    public function mount(Kreasi $kreasi): void
    {
        $this->kreasi = $kreasi->load(['user', 'tag', 'comments.user', 'likes', 'ratings']);

        if (Auth::check()) {
            $existingRating = Rating::where('user_id', Auth::id())
                ->where('kreasi_id', $kreasi->id)
                ->first();
            $this->userRating = $existingRating ? $existingRating->rating : 0;
        }
    }


    //dia tuh buat tombol follow
    public function toggleFollow(): void
    {
        if (!auth()->check()) {
            $this->dispatch('openLoginModal');
            return;
        }

        $creatorId = $this->kreasi->user_id;

        // g bisa follow
        if (Auth::id() === $creatorId) {
            return;
        }

        $follow = Follow::where('follower_id', Auth::id())
            ->where('followed_id', $creatorId)
            ->first();

        if ($follow) {
            $follow->delete();
        } else {
            Follow::create([
                'follower_id' => Auth::id(),
                'followed_id' => $creatorId,
            ]);
        }
    }

    public function isFollowing(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        return Follow::where('follower_id', auth()->id())
            ->where('followed_id', $this->kreasi->user_id)
            ->exists();
    }

    //whastappnya bisa langusng menuju wa yg tadi didaftarkan (kontak)
    public function getWhatsappUrl(): string
    {
        $kontak = $this->kreasi->user->kontak ?? '';

       
        if (str_starts_with($kontak, '0')) {
            $kontak = '62' . substr($kontak, 1);
        }

        $text = urlencode("Halo, saya tertarik dengan karya \"{$this->kreasi->judul}\" di PojokKaarya.");

        return "https://api.whatsapp.com/send?phone={$kontak}&text={$text}";
    }

    public function toggleLike(): void
    {
        if (!auth()->check()) {
            $this->dispatch('openLoginModal');
            return;
        }

        $like = Like::where('user_id', auth()->id())
            ->where('kreasi_id', $this->kreasi->id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'kreasi_id' => $this->kreasi->id,
            ]);
        }

        $this->kreasi->refresh();
    }

    public function toggleBookmark(): void
    {
        if (!auth()->check()) {
            $this->dispatch('openLoginModal');
            return;
        }

        $bookmark = Bookmark::where('user_id', auth()->id())
            ->where('kreasi_id', $this->kreasi->id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
        } else {
            Bookmark::create([
                'user_id' => auth()->id(),
                'kreasi_id' => $this->kreasi->id,
            ]);
        }

        $this->kreasi->refresh();
    }

    public function setRating(int $rating): void
    {
        if (!auth()->check()) {
            $this->dispatch('openLoginModal');
            return;
        }

        Rating::updateOrCreate(
            ['user_id' => auth()->id(), 'kreasi_id' => $this->kreasi->id],
            ['rating' => $rating]
        );

        $this->userRating = $rating;
        $this->kreasi->refresh();
    }

    public function addComment(): void
    {
        if (!auth()->check()) {
            $this->dispatch('openLoginModal');
            return;
        }

        $this->validate(['komentar' => 'required|min:2|max:500']);

        Comment::create([
            'user_id' => auth()->id(),
            'kreasi_id' => $this->kreasi->id,
            'komentar' => $this->komentar,
        ]);

        $this->komentar = '';
        $this->kreasi->load('comments.user');
    }

    public function deleteComment(int $commentId): void
    {
        $comment = Comment::find($commentId);
        if ($comment && $comment->user_id === auth()->id()) {
            $comment->delete();
            $this->kreasi->load('comments.user');
        }
    }

    public function render()
    {
        return view('livewire.kreasi-detail')
            ->layout('components.layouts.landing', ['title' => $this->kreasi->judul]);
    }
}

