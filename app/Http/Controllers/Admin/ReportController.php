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
        $kegiatan = $kegiatan->load('absen');

        return view('dashboad.report.show', compact('absens'));
    }
}
