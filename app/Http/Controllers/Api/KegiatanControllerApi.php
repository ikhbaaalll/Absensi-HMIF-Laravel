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
    public function index()
    {
        $kegiatans = KegiatanResource::collection(Kegiatan::all());
    }

    public function show(Request $request, $id)
    {
        $checkPassword = Kegiatan::where('id', $id)->where('password', $request->password)->first();

        if (!$checkPassword) {
            return response()->json(['error' => 'Password salah'], 422);
        }

        $absen = Absen::with('calonAnggota')->where('kegiatan_id', $id)->get();

        return response()->json(['kegiatan' => $absen], 200);
    }

    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'judul'     => ['required'],
                'tempat'    => ['required'],
                'waktu'     => ['required'],
                'password'  => ['required']
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'error' => $validation->errors()
            ]);
        }

        Kegiatan::create($validation->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kegiatan berhasil ditambah'
        ], 200);
    }

    public function update(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'judul'     => ['required'],
                'tempat'    => ['required'],
                'waktu'     => ['required']
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'error' => $validation->errors()
            ]);
        }

        Kegiatan::find($request->id)
            ->update($validation->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kegiatan berhasil diubah'
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

        if ($check) {
            return response()->json(['error' => "{$calonAnggota->nama} telah melakukan presensi"], 422);
        }

        $absen = Absen::create(
            [
                'kegiatan_id'       => $request->id,
                'calon_anggota_id'  => $calonAnggota->id
            ]
        );

        if ($absen->wasRecentlyCreated) {
            return response()->json([
                'success' => 'true',
                'message' => "Berhasil presensi {$calonAnggota->nama}"
            ], 200);
        }
    }
}
