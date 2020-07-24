<?php

namespace App\Imports;

use App\Models\barang;
use App\Models\jenisbarang;
use App\Models\organisasi;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use App\Models\satuanbarang;
use Illuminate\Support\Facades\Storage;
use App\Repositories\inventarisRepository;

class InventarisImport implements  OnEachRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row)
    {
        try {
            $rowIndex = $row->getIndex();
            $row      = $row->toArray();

            if ($rowIndex == 1) {
                return;
            }

            $row[3] = round($row[3], 2);
            $row[8] = round($row[8], 2);

            $barang = barang::find($row[0]);

            if (empty($barang)) {
                $seqKode =  [
                    "kode_akun",
                    "kode_kelompok",
                    "kode_jenis",
                    "kode_objek",
                    "kode_rincian_objek",
                    "kode_sub_rincian_objek"
                ];

                $splittedData = explode(".",$row[0]);
                $whereRaw = "";

                foreach($splittedData as $n => $val) {
                    if (isset($seqKode[$n])) {
                        $whereRaw .= $seqKode[$n] . " = " . $val;
                    }
                }

                $barang = barang::whereRaw($whereRaw)->first();

                if (empty($barang)) {
                    throw new \Exception("Barang not found");
                }
            }

            $jenisBarang = jenisbarang::where("kode", $barang->kode_jenis)->first();

            $stBarang = satuanBarang::where("nama", $row[2])->first();

            $org = organisasi::where("kode", $row[7])->first();

            inventarisRepository::InsertLogic([
                "pidbarang" => $row[0],
                "jumlah" => $row[1],
                "tipe_kib" => $jenisBarang->kelompok_kib,
                "satuan" => empty($stBarang) ? null : $stBarang->id,
                "harga_satuan" => $row[3],
                "tahun_perolehan" => $row[6],
                "pid_organisasi" => empty($org) ? null : $org->id
            ]);
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}
