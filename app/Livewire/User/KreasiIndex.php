<?php

namespace App\Livewire\User;

use App\Models\Kreasi;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class KreasiIndex extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';

    // Edit modal
    public bool $showModal = false;
    public ?int $editingKreasiId = null;
    public string $judul = '';
    public string $deskripsi = '';
    public $foto;
    public ?string $fotoPreview = null;
    public string $tagId = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function edit(int $kreasiId): void
    {
        $kreasi = Kreasi::where('user_id', auth()->id())->findOrFail($kreasiId);
        $this->editingKreasiId = $kreasi->id;
        $this->judul = $kreasi->judul;
        $this->deskripsi = $kreasi->deskripsi;
        $this->fotoPreview = $kreasi->foto;
        $this->tagId = (string) $kreasi->tag_id;
        $this->showModal = true;
    }

    public function save(): void
    {
        $rules = [
            'judul' => 'required|min:3|max:255',
            'deskripsi' => 'required|min:10',
            'tagId' => 'required|exists:tags,id',
        ];

        if ($this->foto) {
            $rules['foto'] = 'image|max:2048';
        }

        $this->validate($rules);

        $kreasi = Kreasi::where('user_id', auth()->id())->findOrFail($this->editingKreasiId);

        $fotoPath = $kreasi->foto;
        if ($this->foto) {
            Storage::disk('public')->delete($kreasi->foto);
            $fotoPath = $this->foto->store('kreasi', 'public');
        }

        $kreasi->update([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'foto' => $fotoPath,
            'tag_id' => $this->tagId,
        ]);

        session()->flash('message', 'Kreasi berhasil diperbarui!');
        $this->closeModal();
    }

    public function delete(int $kreasiId): void
    {
        $kreasi = Kreasi::where('user_id', auth()->id())->findOrFail($kreasiId);
        Storage::disk('public')->delete($kreasi->foto);
        $kreasi->delete();
        session()->flash('message', 'Kreasi berhasil dihapus!');
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->reset(['editingKreasiId', 'judul', 'deskripsi', 'foto', 'fotoPreview', 'tagId']);
    }

    public function render()
    {
        $kreasis = Kreasi::with('tag')
            ->where('user_id', auth()->id())
            ->when($this->search, fn($q) => $q->where('judul', 'like', "%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('livewire.user.kreasi-index', [
            'kreasis' => $kreasis,
            'tags' => Tag::all(),
        ])->layout('layouts.user', ['title' => 'Kelola Kreasi']);
    }
}

