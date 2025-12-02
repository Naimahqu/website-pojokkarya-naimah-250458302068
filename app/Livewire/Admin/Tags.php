<?php

namespace App\Livewire\Admin;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Tags extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';

    // For create/edit modal
    public bool $showModal = false;
    public bool $isEditing = false;
    public ?int $editingTagId = null;
    public string $namaTag = '';
    public string $slug = '';

    protected $queryString = ['search'];

    public function updatingSearch(): void
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

    public function updatedNamaTag(): void
    {
        $this->slug = Str::slug($this->namaTag);
    }

    public function create(): void
    {
        $this->reset(['editingTagId', 'namaTag', 'slug']);
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit(int $tagId): void
    {
        $tag = Tag::findOrFail($tagId);
        $this->editingTagId = $tag->id;
        $this->namaTag = $tag->nama_tag;
        $this->slug = $tag->slug;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate([
            'namaTag' => 'required|min:2',
            'slug' => 'required|unique:tags,slug,' . $this->editingTagId,
        ]);

        if ($this->isEditing) {
            $tag = Tag::findOrFail($this->editingTagId);
            $tag->update([
                'nama_tag' => $this->namaTag,
                'slug' => $this->slug,
            ]);
            session()->flash('message', 'Tag berhasil diupdate!');
        } else {
            Tag::create([
                'nama_tag' => $this->namaTag,
                'slug' => $this->slug,
            ]);
            session()->flash('message', 'Tag berhasil ditambahkan!');
        }

        $this->closeModal();
    }

    public function delete(int $tagId): void
    {
        Tag::findOrFail($tagId)->delete();
        session()->flash('message', 'Tag berhasil dihapus!');
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->reset(['editingTagId', 'namaTag', 'slug', 'isEditing']);
    }

    public function render()
    {
        $tags = Tag::query()
            ->when($this->search, fn($q) => $q->where('nama_tag', 'like', "%{$this->search}%"))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.tags', [
            'tags' => $tags,
        ])->layout('layouts.admin', ['title' => 'Manajemen Tags']);
    }
}

