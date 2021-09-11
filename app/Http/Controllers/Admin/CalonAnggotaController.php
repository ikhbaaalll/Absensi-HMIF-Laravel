<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalonAnggotaStoreRequest;
use App\Imports\CalonAnggotaImport;
use App\Models\Absen;
use App\Models\CalonAnggota;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;

class CalonAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $calonAnggotas = CalonAnggota::orderBy('kelompok')->get();

        return view('dashboard.calonanggota.index', compact('calonAnggotas'));
    }

    public function create()
    {
        return view('dashboard.calonanggota.create');
    }

    public function store(CalonAnggotaStoreRequest $request)
    {
        $calonAnggota = CalonAnggota::create($request->validated());

        QrCode::format('png')
            ->merge(asset("icon/icon_round.png"), .2)
            ->size(800)
            ->generate(Crypt::encryptString($calonAnggota->nim), "../public/qrcodes/{$calonAnggota->nim}.png");

        CalonAnggota::find($calonAnggota->id)->update(
            [
                'qr_code'   => asset("qrcodes/{$calonAnggota->nim}.png")
            ]
        );

        $kegiatans = Kegiatan::all();

        foreach ($kegiatans as $kegiatan) {
            Absen::create(
                [
                    'kegiatan_id' => $kegiatan->id,
                    'calon_anggota_id' => $calonAnggota->id
                ]
            );
        }

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

    public function importView()
    {
        return view('dashboard.calonanggota.import');
    }

    public function importStore(Request $request)
    {
        $request->validate(
            [
                'file'      => ['required', 'mimes:xlsx'],
                'kelompok'  => ['integer', 'required']
            ]
        );

        if ($request->password != config('app.password')) {
            return redirect()->back()->withErrors('Password salah');
        }

        Excel::import(new CalonAnggotaImport, $request->file('file'));

        $calonAnggotas = CalonAnggota::where('kelompok', $request->kelompok)->get();

        $kegiatans = Kegiatan::all();

        foreach ($calonAnggotas as $calonAnggota) {
            $encryptData = Crypt::encryptString($calonAnggota->nim);

            QrCode::format('png')
                ->merge(asset("icon/icon_round.png"), .2)
                ->size(800)
                ->generate($encryptData, "../public/qrcodes/{$calonAnggota->nim}.png");

            $calonAnggota->update(
                [
                    'qr_code' => asset("qrcodes/{$calonAnggota->nim}.png")
                ]
            );

            foreach ($kegiatans as $kegiatan) {
                Absen::create(
                    [
                        'kegiatan_id'       => $kegiatan->id,
                        'calon_anggota_id'  => $calonAnggota->id
                    ]
                );
            }
        }

        return redirect()->route('calonanggota.index')->with('status', "Sukses mengimport data");
    }
}
