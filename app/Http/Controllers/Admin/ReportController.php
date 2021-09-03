<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::latest()->get();

        return view('dashboard.report.index', compact('kegiatans'));
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan = $kegiatan->load('absen', 'absen.calonAnggota');

        return view('dashboard.report.show', compact('kegiatan'));
    }

    public function destroy(Request $request, $id)
    {
        Absen::find($id)->delete();

        return redirect()->route('kegiatan.show', $request->kegiatan)->with('status', 'Sukses menghapus presensi');
    }
}
