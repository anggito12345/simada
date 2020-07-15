<?php

namespace App\Imports;

use App\Models\organisasi;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use App\Models\satuanbarang;
use Illuminate\Support\Facades\Storage;

class InventarisImport implements  OnEachRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row)
    {
        $row      = $row->toArray();

        $stBarang = satuanBarang::where("nama", $row[2])->first();

        $org = organisasi::where("kode", $row[7])->first();

        $this->inventarisRepository->InsertLogic([
            "pidbarang" => $row[0],
            "satuan" => empty($stBarang) ? null : $stBarang->id,
            "harga_satuan" => $row[3],
            "tahun_perolehan" => $row[6],
            "pid_organisasi" => empty($org) ? null : $org->id
        ]);

    }
}
