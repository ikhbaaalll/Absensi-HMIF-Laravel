<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalonAnggotaStoreRequest;
use App\Models\CalonAnggota;
use Illuminate\Support\Facades\Hash;
use LaravelQRCode\Facades\QRCode;

class CalonAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calonAnggotas = CalonAnggota::all();

        return view('dashboard.calonanggota.index', compact('calonAnggotas'));
    }

    public function create()
    {
        return view('dashboard.calonanggota.create');
    }

    public function store(CalonAnggotaStoreRequest $request)
    {
        $calonAnggota = CalonAnggota::create($request->validated());

        QRCode::text(Hash::make($calonAnggota->id))->setOutfile($calonAnggota->nim . '.png')->png();

        CalonAnggota::find($calonAnggota->id)->update(
            [
                'qr_code'   => asset("{$calonAnggota->nim}.png")
            ]
        );

        return redirect()->route('calonanggota.index')->with('status', "Sukses menambah calon anggota {$calonAnggota->nama}");
    }

    public function edit(CalonAnggota $calonanggotum)
    {
        return view('dashboard.calonanggota.edit', compact('calonanggotum'));
    }

    public function update(CalonAnggotaStoreRequest $request, CalonAnggota $calonanggotum)
    {
        $calonanggotum->update($request->validated());

        return redirect()->route('calonanggota.index')->with('status', "Sukses mengubah {$calonanggotum->nama}");
    }

    public function destroy(CalonAnggota $calonanggotum)
    {
        $calonanggotum->delete();

        return redirect()->route('calonanggota.index')->with('status', "Sukses menghapus {$calonanggotum->nama}");
    }
}
