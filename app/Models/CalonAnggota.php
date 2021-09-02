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
        'prodi',
        'qr_code'
    ];
}
