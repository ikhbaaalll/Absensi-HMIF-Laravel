<?php

namespace Database\Seeders;

use App\Models\CalonAnggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use LaravelQRCode\Facades\QRCode;

class CalonAnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // echo dirname(__FILE__);
        $file = fopen(dirname(__FILE__) . "/calon_anggota.csv", "r");
        while (($data = fgetcsv($file)) !== false) {
            $calonAnggota = CalonAnggota::create([
                'nama'  => $data[0],
                'nim'   => $data[1],
                'prodi' => $data[2]
            ]);

            QRCode::text(Crypt::encryptString($calonAnggota->nim))->setSize(10)->setOutfile('public/' . $calonAnggota->nim . '.svg')->svg();

            CalonAnggota::find($calonAnggota->id)->update(
                [
                    'qr_code'   => asset("{$calonAnggota->nim}.svg")
                ]
            );
        }
    }
}
