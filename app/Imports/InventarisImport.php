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
use Exception;

class InventarisImport implements  OnEachRow
{

    private $importName;

    public function __construct($importName)
    {
        $this->importName = $importName;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row)
    {
        $COL_IDBARANG = 0;
        $COL_JUMLAH = 1;
        $COL_SATUAN = 2;
        $COL_HARGA = 3;
        $COL_TGLDAY = 4;
        $COL_TGLMONTH = 5;
        $COL_TGLYEAR = 6;
        $COL_ORGANISASI = 7;

        try {
            $rowIndex = $row->getIndex();
            $row      = $row->toArray();

            if ($rowIndex == 1 || empty($row[$COL_HARGA]) || empty($row[$COL_IDBARANG])) {
                return;
            }

            $row[$COL_HARGA] = round($row[$COL_HARGA], 2);
            if (!empty($row[$COL_IDBARANG])) {
                $barang = barang::find($row[$COL_IDBARANG]);

                $jenisBarang = jenisbarang::where("kode", $barang->kode_jenis)->first();
            }


            if (empty($barang)) {
                $seqKode =  [
                    "kode_akun",
                    "kode_kelompok",
                    "kode_jenis",
                    "kode_objek",
                    "kode_rincian_objek",
                    "kode_sub_rincian_objek"
                ];

                $splittedData = explode(".",$row[$COL_IDBARANG]);
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



            $stBarang = satuanBarang::where("nama", $row[$COL_SATUAN])->first();

            $org = organisasi::where("kode", trim($row[$COL_ORGANISASI]))->first();


            if(empty($org)) {
                throw new \Exception('organisasi tidak ditemukan '.$row[$COL_ORGANISASI]);
                return;
            }

            inventarisRepository::InsertLogic([
                "pidbarang" => $row[$COL_IDBARANG],
                "jumlah" => $row[$COL_JUMLAH],
                "tipe_kib" => $jenisBarang->kelompok_kib,
                "satuan" => empty($stBarang) ? null : $stBarang->id,
                "harga_satuan" => $row[$COL_HARGA],
                "tahun_perolehan" => $row[$COL_TGLYEAR],
                "kode_barang" => inventarisRepository::kodeBarang($row[$COL_IDBARANG]),
                "pid_organisasi" => empty($org) ? null : $org->id,
                "draft" => '1',
                "tgl_dibukukan" => date('Y-m-d',strtotime($row[$COL_TGLYEAR].'-'.$row[$COL_TGLMONTH].'-'.$row[$COL_TGLDAY])),
                "import_flag" => $this->importName
            ]);
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}
