<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public string $search = '';
    public string $roleFilter = '';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';

    // For edit modal
    public bool $showEditModal = false;
    public ?int $editingUserId = null;
    public string $editName = '';
    public string $editEmail = '';
    public string $editRole = '';
    public string $editKontak = '';
    public string $editDeskripsi = '';

    protected $queryString = ['search', 'roleFilter'];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingRoleFilter(): void
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

    public function editUser(int $userId): void
    {
        $user = User::findOrFail($userId);
        $this->editingUserId = $user->id;
        $this->editName = $user->name;
        $this->editEmail = $user->email;
        $this->editRole = $user->role ?? 'user';
        $this->editKontak = $user->kontak ?? '';
        $this->editDeskripsi = $user->deskripsi_profil ?? '';
        $this->showEditModal = true;
    }

    public function updateUser(): void
    {
        $this->validate([
            'editName' => 'required|min:3',
            'editEmail' => 'required|email|unique:users,email,' . $this->editingUserId,
            'editRole' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($this->editingUserId);
        $user->update([
            'name' => $this->editName,
            'email' => $this->editEmail,
            'role' => $this->editRole,
            'kontak' => $this->editKontak,
            'deskripsi_profil' => $this->editDeskripsi,
        ]);

        $this->showEditModal = false;
        $this->reset(['editingUserId', 'editName', 'editEmail', 'editRole', 'editKontak', 'editDeskripsi']);
        session()->flash('message', 'User berhasil diupdate!');
    }

    public function deleteUser(int $userId): void
    {
        $user = User::findOrFail($userId);

        if ($user->id === auth()->id()) {
            session()->flash('error', 'Tidak bisa menghapus akun sendiri!');
            return;
        }

        $user->delete();
        session()->flash('message', 'User berhasil dihapus!');
    }

    public function closeModal(): void
    {
        $this->showEditModal = false;
        $this->reset(['editingUserId', 'editName', 'editEmail', 'editRole', 'editKontak', 'editDeskripsi']);
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"))
            ->when($this->roleFilter, fn($q) => $q->where('role', $this->roleFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.users', [
            'users' => $users,
        ])->layout('layouts.admin', ['title' => 'Manajemen Pengguna']);
    }
}

