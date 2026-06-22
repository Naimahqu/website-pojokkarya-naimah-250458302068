<?php

use App\Livewire\Landing;
use App\Livewire\User\Likes;
use App\Livewire\KreasiDetail;
use App\Livewire\User\Followers;
use App\Livewire\User\KreasiIndex;
use App\Livewire\User\KreasiCreate;
use App\Livewire\User\BookmarkIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Tags as AdminTags;
use App\Livewire\Admin\Users as AdminUsers;
use App\Livewire\Admin\Kreasi as AdminKreasi;
use App\Livewire\User\Profile as UserProfile;
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\Admin\Dashboard as AdminDashboard;

//ini untuk si admin
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/users', AdminUsers::class)->name('users');
    Route::get('/tags', AdminTags::class)->name('tags');
    Route::get('/kreasi', AdminKreasi::class)->name('kreasi');
});

Route::get('/profile/{user?}', UserProfile::class)->name('profile');

//ini untuk dashboard user
Route::middleware(['auth'])->group(function () {
    Route::get('/kreasi', UserProfile::class)->name('kreasi.index');
    Route::get('/kreasi/create', KreasiCreate::class)->name('kreasi.create');
    Route::get('/bookmarks', UserProfile::class)->name('bookmarks');
    Route::get('/likes', UserProfile::class)->name('likes');
    Route::get('/followers', UserProfile::class)->name('followers');
});

Route::get('/', Landing::class)->name('landing');
Route::get('/kreasi/{kreasi}', KreasiDetail::class)->name('kreasi.detail');

require __DIR__.'/auth.php';