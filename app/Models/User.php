<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'kontak',
        'deskripsi_profil',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ============================================
    // RELASI UNTUK KREASI
    // ============================================
    
    public function kreasi()
    {
        return $this->hasMany(Kreasi::class, 'user_id');
    }

    // ============================================
    // RELASI UNTUK FOLLOWERS (SESUAI TABEL KAMU)
    // ============================================
    
    /**
     * Orang-orang yang follow user ini (pengikut)
     * Pakai 'followed_id' sesuai tabel kamu
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')
                    ->withTimestamps();
    }

    /**
     * Orang-orang yang di-follow oleh user ini (mengikuti)
     * Pakai 'follower_id' sesuai tabel kamu
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')
                    ->withTimestamps();
    }

    /**
     * Cek apakah user ini follow user tertentu
     */
    public function isFollowing($userId)
    {
        return $this->following()->where('followed_id', $userId)->exists();
    }

    // ============================================
    // RELASI UNTUK LIKES
    // ============================================
    
    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    public function hasLiked($kreasiId)
    {
        return $this->likes()->where('kreasi_id', $kreasiId)->exists();
    }

    // ============================================
    // RELASI UNTUK BOOKMARKS
    // ============================================
    
    public function bookmarks()
    {
        return $this->belongsToMany(Kreasi::class, 'bookmarks', 'user_id', 'kreasi_id')
                    ->withTimestamps();
    }

    public function hasBookmarked($kreasiId)
    {
        return $this->bookmarks()->where('kreasi_id', $kreasiId)->exists();
    }

    // ============================================
    // RELASI UNTUK KOMENTAR
    // ============================================
    
    public function komentars()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}