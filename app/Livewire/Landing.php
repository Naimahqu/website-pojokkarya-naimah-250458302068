<?php

namespace App\Livewire;

use App\Models\Kreasi;
use App\Models\Tag;
use App\Models\Like;
use App\Models\Bookmark;
use Livewire\Component;
use Livewire\WithPagination;

class Landing extends Component
{
    use WithPagination;

    public string $search = '';
    public string $tagFilter = '';
    public string $sortBy = 'terbaru'; // terbaru, populer

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingTagFilter(): void
    {
        $this->resetPage();
    }

    public function setSort(string $sort): void
    {
        $this->sortBy = $sort;
        $this->resetPage();
    }

    public function setTag(string $tagId): void
    {
        $this->tagFilter = $tagId === $this->tagFilter ? '' : $tagId;
        $this->resetPage();
    }

    public function toggleLike(int $kreasiId): void
    {
        if (!auth()->check()) {
            $this->dispatch('openLoginModal');
            return;
        }

        $like = Like::where('user_id', auth()->id())
            ->where('kreasi_id', $kreasiId)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'kreasi_id' => $kreasiId,
            ]);
        }
    }

    public function toggleBookmark(int $kreasiId): void
    {
        if (!auth()->check()) {
            $this->dispatch('openLoginModal');
            return;
        }

        $bookmark = Bookmark::where('user_id', auth()->id())
            ->where('kreasi_id', $kreasiId)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
        } else {
            Bookmark::create([
                'user_id' => auth()->id(),
                'kreasi_id' => $kreasiId,
            ]);
        }
    }

    public function render()
    {
        $query = Kreasi::with(['user', 'tag', 'likes', 'comments'])
            ->withCount('likes', 'comments');

        if ($this->search) {
            $query->where('judul', 'like', "%{$this->search}%");
        }

        if ($this->tagFilter) {
            $query->where('tag_id', $this->tagFilter);
        }

        if ($this->sortBy === 'populer') {
            $query->orderByDesc('likes_count');
        } else {
            $query->orderByDesc('created_at');
        }

        return view('livewire.landing', [
            'kreasis' => $query->paginate(12),
            'tags' => Tag::all(),
        ])->layout('components.layouts.landing');
    }
}

