<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonAnggota extends Model
{
    use HasFactory;

    public $fillable = [
        'nama',
        'nim',
        'kelompok',
        'qr_code'
    ];

    public function absen()
    {
        return $this->hasMany(Absen::class);
    }
}
