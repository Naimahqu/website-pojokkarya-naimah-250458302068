<?php

namespace App\Livewire\User;

use App\Models\Kreasi;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;

class KreasiCreate extends Component
{
    use WithFileUploads;

    public string $judul = '';
    public string $deskripsi = '';
    public $foto;
    public string $tagId = '';

    public function save(): void
    {
        $validated = $this->validate([
            'judul' => 'required|min:3|max:255',
            'deskripsi' => 'required|min:10',
            'foto' => 'required|image|max:2048',
            'tagId' => 'required|exists:tags,id',
        ]);

        $fotoPath = $this->foto->store('kreasi', 'public');

        Kreasi::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'foto' => $fotoPath,
            'tag_id' => $validated['tagId'],
            'user_id' => auth()->id(),
        ]);

        session()->flash('message', 'Kreasi berhasil diunggah!');
        $this->redirect(route('kreasi.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.user.kreasi-create', [
            'tags' => Tag::all(),
        ])->layout('layouts.user', ['title' => 'Unggah Kreasi']);
    }
}

