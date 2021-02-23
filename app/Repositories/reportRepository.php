<?php

namespace App\Repositories;

use App\Models\inventaris;
use App\Models\pemeliharaan;
use Illuminate\Support\Facades\DB;

class reportRepository extends BaseRepository
{
    protected $fieldSearchable = [
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return inventaris::class;
    }

    public function GetDataDaftarBarang($paginate = true, $options = [
        'take' => 0,
        'skip' => 0,
        'q' => '',
        'filters' => []
    ]) {
        $inventaris = new \App\Models\inventaris();

        $qData = DB::table($inventaris->table.' as inv')->selectRaw(' 
        (inv.kode_barang || \'/\' || inv.id) as kodeid_barang,
        inv.noreg,
        barang.nama_rek_aset as nama_barang,
        \'-\' as alamat,
        mesin.merk,
        tanah.nomor_sertifikat || \'/\' || mesin.nopabrik || \'/\' || mesin.nomesin || \'/\' || mesin.nopol || \'/\' as info_item, 
        inv.id,
        inv.perolehan,
        inv.harga_satuan,
        inv.tahun_perolehan,
        inv.volume,
        inv.harga_satuan,
        \'-\' as ukuran_barang,
        inv.kondisi,
        inv.keterangan,
        EXTRACT(MONTH from inv.tgl_perolehan) as bulan_perolehan,
        round((CASE WHEN barang.umur_ekonomis != 0 THEN inv.harga_satuan/barang.umur_ekonomis else 0 END ), 2) beban_penyusutan_perbulan,
        (CASE WHEN invpe.id IS NULL then barang.umur_ekonomis ELSE invpe.masa_manfaat_sd_akhir_tahun END) masa_manfaat_sd_akhir_tahun,
        (CASE WHEN invpe.id IS NULL then inv.harga_satuan ELSE invpe.penyusutan_sd_tahun_sebelumnya END) penyusutan_sd_tahun_sebelumnya,
        (CASE WHEN invpe.id IS NULL then barang.umur_ekonomis ELSE invpe.running_sd_bulan END) running_sd_bulan,
        (CASE WHEN invpe.id IS NULL then 0 ELSE invpe.bulan_manfaat_berjalan END) bulan_manfaat_berjalan,
        round(CAST((CASE WHEN invpe.id IS NULL then 0 ELSE invpe.penyusutan_tahun_sekarang END) as numeric), 2) penyusutan_tahun_sekarang,
        round(CAST((CASE WHEN invpe.id IS NULL then inv.harga_satuan ELSE invpe.penyusutan_sd_tahun_sekarang END) as numeric), 2) penyusutan_sd_tahun_sekarang,
        round(CAST((CASE WHEN invpe.id IS NULL then 0 ELSE invpe.nilai_buku END) as numeric), 2) nilai_buku')
        ->join('m_barang as barang', 'barang.id', '=', 'inv.pidbarang')
        ->leftJoin('detil_mesin as mesin', 'mesin.pidinventaris', '=', 'inv.id')
        ->leftJoin('detil_tanah as tanah', 'tanah.pidinventaris', '=', 'inv.id')
        ->leftJoin(DB::raw('
                (select 
                    rpt.id, 
                    rpt.inventaris_id, 
                    rpt.masa_manfaat_sd_akhir_tahun,
                    rpt.penyusutan_sd_tahun_sebelumnya,
                    rpt.running_sd_bulan,
                    rpt.bulan_manfaat_berjalan,
                    rpt.penyusutan_tahun_sekarang,
                    rpt.penyusutan_sd_tahun_sekarang,
                    rpt.nilai_buku
                from report_inventaris_penyusutan rpt
                INNER JOIN (
                    select rpt2.inventaris_id, MAX(rpt2.id) id from report_inventaris_penyusutan rpt2 group by rpt2.inventaris_id
                ) recent
                ON recent.id = rpt.id
                ) invpe
            ')
            , function($join)
            {
               $join->on('invpe.inventaris_id', '=', 'inv.id');
            })
        ->whereRaw('inv.deleted_at IS NULL')
        ->groupBy(DB::raw('
            inv.noreg,
            inv.kode_barang,
            barang.nama_rek_aset,
            mesin.merk,
            inv.id,
            barang.umur_ekonomis,
            invpe.id,
            inv.perolehan,
            inv.tgl_perolehan,
            inv.tahun_perolehan,
            inv.kondisi,
            inv.volume,
            inv.harga_satuan,
            invpe.penyusutan_sd_tahun_sebelumnya,
            invpe.running_sd_bulan,
            invpe.bulan_manfaat_berjalan,
            invpe.penyusutan_tahun_sekarang,
            invpe.penyusutan_sd_tahun_sekarang,
            invpe.nilai_buku,
            invpe.masa_manfaat_sd_akhir_tahun,
            tanah.nomor_sertifikat,
            mesin.nopabrik,
            mesin.nomesin,
            mesin.nopol,
            inv.keterangan
        ')
        );

        if (array_key_exists('filters', $options)) {
            foreach ($options['filters'] as $filter) {
                # code...
                $qData = $qData->where($filter);
            }
        }
        

        if ($paginate) {
            $datas = $qData
                ->skip((int)$options['skip'])
                ->limit((int)$options['take'])
                ->get()
                ;

            $index = 0;

            foreach ($datas as $data) {
                # code...
                $pemeliharaan = pemeliharaan::where('pidinventaris', $data->id)->get();
                $data->pemeliharaan = $pemeliharaan;
                $index++;
            }

            return [
                'recordsTotal' => inventaris::count(),
                'data' => $datas,
                "draw" => '1',
                'recordsFiltered' => inventaris::count(),
            ];
        } else {
            return $qData->get();
        }
    }
}