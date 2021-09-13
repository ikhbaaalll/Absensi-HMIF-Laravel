<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\CalonAnggota;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index(Request $request)
    {
        $calonAnggotas = CalonAnggota::with('absen', 'absen.kegiatan')
            ->withCount(['absen as total_absen' => function ($query) {
                $query->where('kehadiran', 1);
            }])
            ->when(request()->filled('kelompok'), function ($query) {
                $query->where('kelompok', request()->get('kelompok'));
            })
            ->orderBy('kelompok')
            ->get();

        $kegiatans = Kegiatan::all();

        $kelompoks = CalonAnggota::select('kelompok')->distinct()->orderBy('kelompok')->get();

        return view('dashboard.data.index', compact('calonAnggotas', 'kegiatans', 'kelompoks'));
    }
}
