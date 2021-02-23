<?php

namespace App\Repositories;

use App\Models\barang;
use App\Models\inventaris;
use App\Models\inventaris_penyusutan;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class inventaris_penyusutanRepository
 * @package App\Repositories
 * @version January 25, 2021, 10:20 am UTC
*/

class inventaris_penyusutanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'deskripsi',
        'inventaris_id',
        'beban_penyusutan_perbulan',
        'masa_manfaat_sd_akhir_tahun',
        'penyusutan_sd_tahun_sebelumnya',
        'running_penyesutan',
        'running_sd_bulan',
        'penyusutan_tahun_sekarang',
        'penyusutan_sd_tahun_sekarang'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return inventaris_penyusutan::class;
    }

    /**
     * calculating all data
     */
    public function CalculatingAllPenyusutanData($dateRunning) {

        $inventaris = new inventaris();
        $inventarises = DB::table($inventaris->table.' as inv')
            ->selectRaw('inv.*')
            ->join('m_barang as barang', 'barang.id', '=', 'inv.pidbarang')
            ->whereRaw('
                (DATE_PART(\'year\', AGE(now(), inv.tgl_perolehan)) * 12)+DATE_PART(\'month\', AGE(now(), inv.tgl_perolehan))+1 <= barang.umur_ekonomis and 
                barang.umur_ekonomis != 0
            ')->get();

        foreach ($inventarises as $invent) {
            # code...
            $this->CalculatingPenyusutan($invent->id, $dateRunning);
        }
    } 

    /**
     * calculating penyusutan one data
     */
    public function CalculatingPenyusutan($inventaris_id, $dateRunning) {
        $inventaris = inventaris::withTrashed()->find((int)$inventaris_id);
        if (empty($inventaris)) {
            throw new \Exception("inventaris is empty");
        }

        $yearRunning = date('Y', strtotime(str_replace('/', '-',$dateRunning)));
        $monthRunning = date('m', strtotime(str_replace('/', '-',$dateRunning)));

        $ifExist = inventaris_penyusutan::where('inventaris_id', $inventaris_id)
            ->whereRaw('EXTRACT(YEAR FROM running_penyusutan) = '.$yearRunning)
            ->whereRaw('EXTRACT(MONTH FROM running_penyusutan) = '.$monthRunning)
            ->count();

        if ($ifExist > 0) {
            return;
        }

        $bItem = barang::find($inventaris->pidbarang);
        if (empty($bItem)) {
            throw new \Exception("barang is empty");
        }

        $yearInv = date('Y', strtotime(str_replace('/', '-',$inventaris->tgl_perolehan)));
        $mnInv = date('m', strtotime(str_replace('/', '-',$inventaris->tgl_perolehan)));
        $currentPrevYear = date('Y', strtotime('-1 year',  strtotime(str_replace('/', '-',$inventaris->tgl_perolehan))));
        $currentPrevMonth = 12;

        $currentYear = $yearRunning;
        $currentMonth = $monthRunning;

        $penyusutan = new inventaris_penyusutan();
        $penyusutan->beban_penyusutan_perbulan = 0;
        if ($bItem->umur_ekonomis != 0) {
            $penyusutan->beban_penyusutan_perbulan = $inventaris->harga_satuan/$bItem->umur_ekonomis;    
        }
        
        

        $diffMonth = (($currentPrevYear - $yearInv) * 12) + ($currentPrevMonth - $mnInv);
        if ($diffMonth < 0) {
            $penyusutan->masa_manfaat_sd_akhir_tahun = 0;
        } else if ($diffMonth+1 > $bItem->umur_ekonomis) {
            $penyusutan->masa_manfaat_sd_akhir_tahun = $bItem->umur_ekonomis;
        } else {
            $penyusutan->masa_manfaat_sd_akhir_tahun = $diffMonth+1;
        }

        $penyusutan->penyusutan_sd_tahun_sebelumnya = $penyusutan->masa_manfaat_sd_akhir_tahun * $penyusutan->beban_penyusutan_perbulan;
        $penyusutan->running_penyusutan = date('Y-m-d', strtotime(str_replace('/', '-',$dateRunning)));

        $diffMonthSdSkr = (($currentYear - $yearInv) * 12) + ($currentMonth - $mnInv);
        if ($diffMonthSdSkr < 0) {
            $penyusutan->running_sd_bulan = 0;
        } else if ($diffMonthSdSkr+1 > $bItem->umur_ekonomis) {
            $penyusutan->running_sd_bulan = $bItem->umur_ekonomis;
        } else {
            $penyusutan->running_sd_bulan = $diffMonthSdSkr+1;
        }

        $penyusutan->bulan_manfaat_berjalan = $penyusutan->running_sd_bulan - $penyusutan->masa_manfaat_sd_akhir_tahun;
        $penyusutan->penyusutan_tahun_sekarang = $penyusutan->bulan_manfaat_berjalan * $penyusutan->beban_penyusutan_perbulan;
        $penyusutan->penyusutan_sd_tahun_sekarang = $penyusutan->penyusutan_sd_tahun_sebelumnya + $penyusutan->penyusutan_tahun_sekarang;
        $penyusutan->nilai_buku = $inventaris->harga_satuan - $penyusutan->penyusutan_sd_tahun_sekarang;
        $penyusutan->deskripsi = "Penyusutan ".date('Y-m', strtotime(str_replace('/', '-',$dateRunning)));
        $penyusutan->inventaris_id = $inventaris_id;
        $penyusutan->save();
    }
}
