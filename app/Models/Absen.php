<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'calon_anggota_id',
        'kegiatan_id',
    ];

    public function calonAnggota()
    {
        return $this->belongsTo(CalonAnggota::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
