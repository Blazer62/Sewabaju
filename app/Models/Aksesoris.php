<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aksesoris extends Model
{
    use HasFactory;

    protected $table = 'aksesoris';

    protected $fillable = [
        'baju_id',
        'nama',
    ];

    protected $casts = [];

    public function baju()
    {
        return $this->belongsTo(Baju::class, 'baju_id');
    }
}
