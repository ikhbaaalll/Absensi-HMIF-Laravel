<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\KegiatanResource;
use App\Models\Absen;
use App\Models\CalonAnggota;
use App\Models\Kegiatan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KegiatanControllerApi extends Controller
{
    public function index(Request $request)
    {
        $kegiatans = KegiatanResource::collection(Kegiatan::where('kegiatan', $request->kegiatan)->get());

        return response()->json(
            [
                'kegiatan' => $kegiatans
            ]
        );
    }

    public function show($id)
    {
        $absen = Absen::with('calonAnggota')->where('kegiatan_id', $id)->get();

        return response()->json(['absen' => $absen], 200);
    }

    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'judul'     => ['required'],
                'tempat'    => ['required'],
                'waktu'     => ['required'],
                'password'  => ['required'],
                'kegiatan'  => ['required']
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'error' => $validation->errors()
            ]);
        }

        $kegiatan = Kegiatan::create($validation->validated());

        $calonAnggotas = CalonAnggota::all();

        foreach ($calonAnggotas as $calonAnggota) {
            Absen::create(
                [
                    'calon_anggota_id'  => $calonAnggota->id,
                    'kegiatan_id'       => $kegiatan->id
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Kegiatan berhasil ditambah'
        ], 200);
    }

    public function destroy($id)
    {
        Kegiatan::find($id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kegiatan berhasil dihapus'
        ], 200);
    }

    public function absen(Request $request)
    {
        try {
            $decryptQR = Crypt::decryptString($request->data);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'QR Code tidak ditemukan'], 422);
        }

        $calonAnggota = CalonAnggota::where('nim', $decryptQR)->first();

        if (!$calonAnggota) {
            return response()->json(['error' => 'QR Code tidak ditemukan'], 422);
        }

        $check = Absen::where('kegiatan_id', $request->id)
            ->where('calon_anggota_id', $calonAnggota->id)
            ->first();

        if ($check->kehadiran == '1') {
            return response()->json(['error' => "{$calonAnggota->nama} telah melakukan presensi"], 422);
        }

        $absen = $check->update(
            [
                'kehadiran' => 1
            ]
        );

        return response()->json([
            'success' => true,
            'message' => "{$calonAnggota->nama} Berhasil presensi"
        ], 200);
    }

    public function checkPassword(Request $request, $id)
    {
        $kegiatan = Kegiatan::where('id', $id)->where('password', $request->password)->first();

        if (!$kegiatan) {
            return response()->json(
                [
                    'error' => 'Password salah'
                ]
            );
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Berhasil'
            ]
        );
    }

    public function setAbsen(Request $request, $id)
    {
        $absen = Absen::find($id)->update(['kehadiran' => $request->kehadiran]);

        return  response()->json(
            [
                'success' => true,
                'message' => ($absen->kehadiran == 1) ? true : false
            ]
        );
    }
}
