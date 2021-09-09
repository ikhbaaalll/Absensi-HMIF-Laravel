<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $dates = [
        'waktu',
    ];

    public $fillable = [
        'judul',
        'tempat',
        'waktu',
        'password',
        'kegiatan'
    ];

    public function absen()
    {
        return $this->hasMany(Absen::class);
    }
}
