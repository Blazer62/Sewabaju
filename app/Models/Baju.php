<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baju extends Model
{
    use HasFactory;

    protected $table = 'bajus';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'kategori',
        'aktif',
        'ketersediaan',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'ketersediaan' => 'string',
        'kategori' => 'array',
    ];

    public function aksesoris()
    {
        return $this->hasMany(Aksesoris::class, 'baju_id');
    }

    public function getGambarUrlAttribute()
    {
        if ($this->gambar && str_starts_with($this->gambar, 'http')) {
            return $this->gambar;
        }
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return "https://placehold.co/400x250/f7ebda/8b5a2b?text=" . urlencode($this->nama);
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeKategori($query, $kategori)
    {
        return $query->whereJsonContains('kategori', $kategori);
    }
}
