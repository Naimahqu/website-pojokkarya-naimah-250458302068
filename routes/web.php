<?php

use App\Livewire\Landing;
use App\Livewire\KreasiDetail;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Users as AdminUsers;
use App\Livewire\Admin\Tags as AdminTags;
use App\Livewire\Admin\Kreasi as AdminKreasi;
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\User\Profile as UserProfile;
use App\Livewire\User\KreasiCreate;
use App\Livewire\User\KreasiIndex;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/users', AdminUsers::class)->name('users');
    Route::get('/tags', AdminTags::class)->name('tags');
    Route::get('/kreasi', AdminKreasi::class)->name('kreasi');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');
    Route::get('/profile', UserProfile::class)->name('profile');
    Route::get('/kreasi', KreasiIndex::class)->name('kreasi.index');
    Route::get('/kreasi/create', KreasiCreate::class)->name('kreasi.create');
});

Route::get('/', Landing::class)->name('landing');
Route::get('/kreasi/{kreasi}', KreasiDetail::class)->name('kreasi.detail');

require __DIR__.'/auth.php';
