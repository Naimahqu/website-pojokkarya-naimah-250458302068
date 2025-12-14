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

    public function updatingSearch(): void
    {
        $this->resetPage();
    }


    public function toggleBookmark(int $kreasiId): void
    {
        // Cari dan hapus bookmark untuk pengguna saat ini dan ID kreasi yang diberikan
        $bookmark = Bookmark::where('user_id', Auth::id())
                            ->where('kreasi_id', $kreasiId)
                            ->first();

        if ($bookmark) {
            $bookmark->delete();
            session()->flash('success', 'Kreasi berhasil dihapus dari bookmark Anda.');
        }

        // Livewire secara otomatis akan me-render ulang dan menghilangkan kartu yang dihapus.
    }


    public function toggleLike(int $kreasiId): void
    {
        $userId = Auth::id();

        // Cari like yang sudah ada
        $existingLike = Like::where('user_id', $userId)
                            ->where('kreasi_id', $kreasiId)
                            ->first();

        if ($existingLike) {
            // Unlike: Hapus like yang sudah ada
            $existingLike->delete();
            session()->flash('info', 'Like dihapus.');
        } else {
            // Like: Buat like baru
            Like::create([
                'user_id' => $userId,
                'kreasi_id' => $kreasiId,
            ]);
            session()->flash('success', 'Kreasi berhasil di-like!');
        }
    }

    public function render()
    {
        // Query untuk mengambil bookmark yang terhubung ke kreasi yang valid
        $bookmarks = Bookmark::with([
                'kreasi.tag', 
                'kreasi.user',
                'kreasi.likes',      // Eager load likes
                'kreasi.comments'    // Eager load comments
            ])
            ->where('user_id', Auth::id())
            ->whereHas('kreasi', function ($query) {
                // Asumsi: Hanya tampilkan kreasi yang aktif dan terapkan pencarian
                if ($this->search) {
                    $query->where('judul', 'like', "%{$this->search}%");
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        // Reset pagination jika halaman saat ini kosong setelah pencarian/penghapusan
        if ($bookmarks->isEmpty() && $this->page > 1) {
            $this->resetPage();
        }

        // Tambahkan informasi apakah user sudah like setiap kreasi
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
        ])->layout('layouts.user', ['title' => 'Bookmarks']);
    }
}