<?php

namespace App\Imports;

use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KelasImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $jurusan = Jurusan::where('nama_jurusan', $row['nama_jurusan'])->first();
            $jurusanID = $jurusan ? $jurusan->id_jurusan : null;

            Kelas::create([
                'id_jurusan' => $jurusanID,
                'nomor_kelas' => $row['nomor_kelas'],
                'tingkat' => $row['tingkat'],
            ]);
        }
    }
}
