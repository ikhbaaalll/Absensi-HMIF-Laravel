<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KegiatanRequest;
use App\Models\Absen;
use App\Models\CalonAnggota;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $kegiatans = Kegiatan::when($request->filled('kategori'), function ($query) {
            $query->where('kegiatan', request()->get('kategori'));
        })
            ->when($request->filled('tempat'), function ($query) {
                $query->where('tempat', request()->get('tempat'));
            })
            ->latest()
            ->get();

        $kategoris = Kegiatan::select('kegiatan')->distinct()->get();

        $tempats = Kegiatan::select('tempat')->distinct()->get();

        return view('dashboard.report.index', compact('kegiatans', 'kategoris', 'tempats'));
    }

    public function show(Request $request, Kegiatan $kegiatan)
    {
        $kelompoks = CalonAnggota::select('kelompok')->distinct()->orderBy('kelompok')->get();

        $absens = CalonAnggota::with(['absen' => function ($query) use ($kegiatan) {
            $query->where('kegiatan_id', $kegiatan->id);
        }])
            ->when(request()->filled('kelompok'), function ($query) {
                $query->where('kelompok', request()->get('kelompok'));
            })
            ->orderBy('kelompok')
            ->get();

        return view('dashboard.report.show', compact('kegiatan', 'kelompoks', 'absens'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('dashboard.report.edit', compact('kegiatan'));
    }

    public function update(KegiatanRequest $request, Kegiatan $kegiatan)
    {
        $kegiatan->update($request->validated());

        return redirect()->route('kegiatan.index')->with('status', "Berhasil mengubah kegiatan {$kegiatan->judul}");
    }
}
