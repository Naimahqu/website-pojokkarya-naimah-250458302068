<?php

namespace App\Livewire\Admin;

use App\Models\Kreasi as KreasiModel;
use App\Models\Tag;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Kreasi extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';
    public string $tagFilter = '';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';

    // For create/edit modal
    public bool $showModal = false;
    public bool $isEditing = false;
    public ?int $editingKreasiId = null;
    public string $judul = '';
    public string $deskripsi = '';
    public $foto;
    public ?string $fotoPreview = null;
    public string $userId = '';
    public string $tagId = '';

    protected $queryString = ['search', 'tagFilter'];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingTagFilter(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function create(): void
    {
        $this->reset(['editingKreasiId', 'judul', 'deskripsi', 'foto', 'fotoPreview', 'userId', 'tagId']);
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit(int $kreasiId): void
    {
        $kreasi = KreasiModel::findOrFail($kreasiId);
        $this->editingKreasiId = $kreasi->id;
        $this->judul = $kreasi->judul;
        $this->deskripsi = $kreasi->deskripsi;
        $this->fotoPreview = $kreasi->foto;
        $this->userId = (string) $kreasi->user_id;
        $this->tagId = (string) $kreasi->tag_id;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save(): void
    {
        $rules = [
            'judul' => 'required|min:3',
            'deskripsi' => 'required|min:10',
            'userId' => 'required|exists:users,id',
            'tagId' => 'required|exists:tags,id',
        ];

        if (!$this->isEditing || $this->foto) {
            $rules['foto'] = 'required|image|max:2048';
        }

        $this->validate($rules);

        $fotoPath = $this->fotoPreview;
        if ($this->foto) {
            if ($this->isEditing && $this->fotoPreview) {
                Storage::disk('public')->delete($this->fotoPreview);
            }
            $fotoPath = $this->foto->store('kreasi', 'public');
        }

        if ($this->isEditing) {
            $kreasi = KreasiModel::findOrFail($this->editingKreasiId);
            $kreasi->update([
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
                'foto' => $fotoPath,
                'user_id' => $this->userId,
                'tag_id' => $this->tagId,
            ]);
            session()->flash('message', 'Kreasi berhasil diupdate!');
        } else {
            KreasiModel::create([
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
                'foto' => $fotoPath,
                'user_id' => $this->userId,
                'tag_id' => $this->tagId,
            ]);
            session()->flash('message', 'Kreasi berhasil ditambahkan!');
        }

        $this->closeModal();
    }

    public function delete(int $kreasiId): void
    {
        $kreasi = KreasiModel::findOrFail($kreasiId);
        if ($kreasi->foto) {
            Storage::disk('public')->delete($kreasi->foto);
        }
        $kreasi->delete();
        session()->flash('message', 'Kreasi berhasil dihapus!');
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->reset(['editingKreasiId', 'judul', 'deskripsi', 'foto', 'fotoPreview', 'userId', 'tagId', 'isEditing']);
    }

    public function render()
    {
        $kreasis = KreasiModel::with(['user', 'tag'])
            ->when($this->search, fn($q) => $q->where('judul', 'like', "%{$this->search}%"))
            ->when($this->tagFilter, fn($q) => $q->where('tag_id', $this->tagFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.kreasi', [
            'kreasis' => $kreasis,
            'tags' => Tag::all(),
            'users' => User::all(),
        ])->layout('layouts.admin', ['title' => 'Manajemen Kreasi']);
    }
}

