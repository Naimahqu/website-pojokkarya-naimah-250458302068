<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Bookmark;
use App\Models\Like;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class BookmarkIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $userId = null;

    public function mount(?int $userId = null): void
    {
        $this->userId = $userId ?? Auth::id();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function toggleBookmark(int $kreasiId): void
    {
        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('kreasi_id', $kreasiId)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            session()->flash('success', 'Kreasi berhasil dihapus dari bookmark Anda.');
        }
    }

    public function toggleLike(int $kreasiId): void
    {
        $userId = Auth::id();

        $existingLike = Like::where('user_id', $userId)
            ->where('kreasi_id', $kreasiId)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            session()->flash('info', 'Like dihapus.');
        } else {
            Like::create([
                'user_id' => $userId,
                'kreasi_id' => $kreasiId,
            ]);
            session()->flash('success', 'Kreasi berhasil di-like!');
        }
    }

    public function render()
    {
        $bookmarks = Bookmark::with([
                'kreasi.tag',
                'kreasi.user',
                'kreasi.likes',
                'kreasi.comments'
            ])
            ->where('user_id', $this->userId)
            ->whereHas('kreasi', function ($query) {
                if ($this->search) {
                    $query->where('judul', 'like', "%{$this->search}%");
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        if ($bookmarks->isEmpty() && $bookmarks->currentPage() > 1) {
            $this->resetPage();
        }

        $bookmarks->getCollection()->transform(function ($bookmark) {
            if ($bookmark->kreasi) {
                $bookmark->kreasi->likes_count = $bookmark->kreasi->likes->count();
                $bookmark->kreasi->comments_count = $bookmark->kreasi->comments->count();
                $bookmark->kreasi->is_liked = $bookmark->kreasi->likes
                    ->where('user_id', Auth::id())
                    ->isNotEmpty();
            }
            return $bookmark;
        });

        return view('livewire.user.bookmark-index', [
            'bookmarks' => $bookmarks,
        ]);
    }
}