<?php

namespace App\Repositories;

use App\Models\inventaris;
use App\Repositories\BaseRepository;

/**
 * Class inventarisRepository
 * @package App\Repositories
 * @version September 5, 2019, 2:24 pm UTC
*/

class inventarisRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'noreg',
        'pidbarang',
        'pidopd',
        'pidlokasi',
        'tgl_perolehan',
        'tgl_sensus',
        'volume',
        'pembagi',
        'satuan',
        'harga_satuan',
        'perolehan',
        'kondisi',
        'lokasi_detil',
        'umur_ekonomis',
        'keterangan'
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
        return inventaris::class;
    }

    public static function generateKodeLokasi($req) {
        $kodeStatus = \App\Models\setting::where('nama', 'KODE_LOKASI_STATUS')->first()->nilai;
        $kodePropinsi = \App\Models\setting::where('nama', 'KODE_PROPINSI')->first()->nilai;
        $intraEkstra = \App\Models\inventaris::CalculateIsIntraOrEkstra($req['tahun_perolehan'], $req['harga_satuan']);
        $kodeKota = \App\Models\setting::where('nama', 'KODE_KOTA')->first()->nilai;    

        $propinsi = \App\Models\alamat::find(!array_key_exists('alamat_propinsi', $req) ? "" : $req['alamat_propinsi']);
        if (empty($propinsi)) {
            $propinsi = 0;
        } else {
            $propinsi = $propinsi->kode;
        }


        $kota = \App\Models\alamat::find(!array_key_exists('alamat_kota', $req) ? "" : $req['alamat_kota']);
        if (empty($kota)) {
            $kota = 0;
        } else {
            $kota = $kota->kode;
        }

        $organisasiOpd = \App\Models\organisasi::find(!array_key_exists('pidopd', $req) ? "" : $req['pidopd']);
        if (empty($organisasiOpd)) {
            $organisasiOpd = 0;
        } else {
            $organisasiOpd = $organisasiOpd->kode;
        }

        $organisasiOpdCabang = \App\Models\organisasi::find(!array_key_exists('pidopd_cabang', $req) ? "" : $req['pidopd_cabang']);
        if (empty($organisasiOpdCabang)) {
            $organisasiOpdCabang = '00';
        } else {
            if(strlen($organisasiOpdCabang->kode) > 2) {
                $organisasiOpdCabang = substr($organisasiOpdCabang->kode, strlen($organisasiOpdCabang->kode) - 2, strlen($organisasiOpdCabang->kode));
            } else {
                $organisasiOpdCabang = $organisasiOpdCabang->kode;
            }
            
        }

        $organisasiUpt = \App\Models\organisasi::find(!array_key_exists('pidupt', $req) ? "" : $req['pidupt']);
        if (empty($organisasiUpt)) {
            $organisasiUpt = '';
        } else {
            $organisasiUpt = $organisasiUpt->kode;
        }


        return $kodeStatus . '.' . 
        $intraEkstra . '.' .
        $propinsi . '.' .
        $kota . '.' .
        $organisasiOpd . '.' .
        $organisasiOpdCabang . '.' .
        $organisasiUpt . '.' .
        $req['tahun_perolehan'];

    }
}
