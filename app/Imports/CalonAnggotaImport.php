<?php

namespace App\Imports;

use App\Models\CalonAnggota;
use Maatwebsite\Excel\Concerns\ToModel;

class CalonAnggotaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new CalonAnggota([
            'nama'      => $row[0],
            'nim'       => $row[1],
            'kelompok'  => $row[2]
        ]);
    }
}
