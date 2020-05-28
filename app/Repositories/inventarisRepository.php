<?php

namespace App\Repositories;

use App\Models\inventaris;
use App\Repositories\BaseRepository;
use Constant;
use Auth;

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

    /**
     * its called when penghapusan needed to get data inventaris
     * 
     */
    public static function getDataInventarisFromPenghapusan() {
        return [];
    }

    /**
     * its need to be trigger when there are more than 1 filter is filled.
     * @jenisbarangs
     * @kodeobjek
     * @koderincianobjek
     * @kodesubrincianobjek
     * @organisasi_filter
     * 
     * @is_exist_inventaris_penghapusan
     */
    public static function appendInventarisGridFilter($buildingModel = null, $theFilter = [])
    {
        $defRet = new \App\Models\inventaris();

        if ($buildingModel == null) {
            return  $defRet->newQuery();
        }


        if (isset($theFilter['jenisbarangs']) && $theFilter['jenisbarangs'] != "" && $theFilter['jenisbarangs'] != null) {
            $buildingModel = $buildingModel->where('m_jenis_barang.id', $_GET['jenisbarangs']);
        }

        if (isset($theFilter['kodeobjek']) && $theFilter['kodeobjek'] != "" && $theFilter['kodeobjek'] != null) {
            $buildingModel = $buildingModel->where('m_barang.kode_objek', $theFilter['kodeobjek']);
        }

        if (isset($theFilter['koderincianobjek']) && $theFilter['koderincianobjek'] != "" && $theFilter['koderincianobjek'] != null) {
            $buildingModel = $buildingModel->where('m_barang.kode_rincian_objek', $theFilter['koderincianobjek']);
        }

        if (isset($theFilter['kodesubrincianobjek']) && $theFilter['kodesubrincianobjek'] != "" && $theFilter['kodesubrincianobjek'] != null) {
            $buildingModel = $buildingModel->where('m_barang.kode_sub_rincian_objek', $theFilter['kodesubrincianobjek']);
        }     
        
        if (isset($theFilter['organisasi_filter']) && $theFilter['organisasi_filter'] != "" && $theFilter['organisasi_filter'] != null) {
            $buildingModel = $buildingModel->where('m_organisasi.id', $theFilter['organisasi_filter']);
        }   
        

        // take data which is doesn't has any duplicate data in inventaris_penghapusan
        if(isset($theFilter['is_exist_inventaris_penghapusan'])) {

            // false it mean must not be in there
            if ($theFilter['is_exist_inventaris_penghapusan'] == 'false') {
                $buildingModel = $buildingModel
                                        ->whereRaw('inventaris_penghapusan.id IS NULL');    
            }             
        }

        return $buildingModel;
    }

    public static function getData($isDraft = null, $rawSelect = "") {
        $buildingModel = new \App\Models\inventaris();

        $buildingModel = $buildingModel->newQuery();


        if (isset($isDraft) && $isDraft == '1') {
            $buildingModel = inventaris::onlyDrafts();
        }

        $organisasiUser = \App\Models\organisasi::find(Auth::user()->pid_organisasi);
        if ($organisasiUser == null) {
            $organisasiUser = new \App\Models\organisasi();
        }
            
        if ($rawSelect == "") {
            $buildingModel = $buildingModel->select([
                "inventaris.*",
                "m_barang.nama_rek_aset",
                "m_merk_barang.nama as merk",
                "m_jenis_barang.kelompok_kib",
                "m_jenis_barang.nama as jenis",
                "detil_mesin.bahan as bahan",
                "m_organisasi.setting as setauth",
                "inventaris_penghapusan.id as ip",
                "inventaris_reklas.id as ir",
                "detil_mesin.norangka",                
                "detil_mesin.nomesin",
                "detil_mesin.nopol",
            ])
            ->selectRaw('CONCAT(detil_tanah.nomor_sertifikat,\'/\',detil_mesin.nopabrik,\'/\', detil_mesin.norangka,\'/\', detil_mesin.nomesin) as nomor')            
            ->selectRaw('CONCAT(\'1 \',m_satuan_barang.nama) as barang');
        } else {
            $buildingModel = $buildingModel->selectRaw($rawSelect);
        }
                     
        $buildingModel = $buildingModel->join("m_barang", "m_barang.id", "inventaris.pidbarang")
            ->join("m_jenis_barang", "m_jenis_barang.kode", "m_barang.kode_jenis")
            // role =================
            ->leftJoin("users","users.id", "inventaris.idpegawai")
            ->leftJoin("m_jabatan", "m_jabatan.id", 'users.jabatan')
            ->leftJoin("inventaris_reklas", "inventaris.id", "inventaris_reklas.id")
            // role end
            ->leftJoin("detil_tanah", "detil_tanah.pidinventaris", "inventaris.id")
            ->leftJoin("m_satuan_barang", "m_satuan_barang.id", "inventaris.satuan")
            ->leftJoin("detil_mesin", "detil_mesin.pidinventaris", "inventaris.id")
            ->leftJoin("detil_bangunan", "detil_bangunan.pidinventaris", "inventaris.id")
            ->leftJoin("detil_aset_lainnya", "detil_aset_lainnya.pidinventaris", "inventaris.id")
            ->leftJoin("detil_jalan", "detil_jalan.pidinventaris", "inventaris.id")
            ->leftJoin("detil_konstruksi", "detil_konstruksi.pidinventaris", "inventaris.id")
            ->leftJoin("m_merk_barang", "m_merk_barang.id", "detil_mesin.merk")
            ->leftJoin('inventaris_penghapusan', 'inventaris_penghapusan.id', 'inventaris.id')
            ->leftJoin('m_organisasi', 'm_organisasi.id', 'inventaris.pid_organisasi');
            // role =================
            // ->where('m_jabatan.level', '<=', $mineJabatan->level)
            
        // role conditional please check this whenever u want customizing role
        if ($organisasiUser->jabatans == Constant::$GROUP_OPD_ORG) {            
            $buildingModel = $buildingModel
                ->whereRaw('( inventaris.pid_organisasi = '.$organisasiUser->id.' OR m_organisasi.pid = '.$organisasiUser->id . ')')
                ->where('m_organisasi.jabatans', '>=', $organisasiUser->jabatans);
        } else if ($organisasiUser->jabatans == Constant::$GROUP_CABANGOPD_ORG) {            
            $buildingModel = $buildingModel
                ->whereRaw(' ( inventaris.pid_organisasi = '.$organisasiUser->id . ' OR m_organisasi.id = ' . $organisasiUser->pid . ' ) ')
                ->where('m_organisasi.jabatans', '>=', Constant::$GROUP_OPD_ORG);
        }

        return $buildingModel;
    }

    public static function generateKodeLokasi($req) {
        $kodeStatus = \App\Models\setting::where('nama', Constant::$SETTING_KODE_LOKASI_STATUS)->first()->nilai;
        $kodePropinsi = \App\Models\setting::where('nama', Constant::$SETTING_KODE_PROPINSI)->first()->nilai;
        $intraEkstra = \App\Models\inventaris::CalculateIsIntraOrEkstra($req['tahun_perolehan'], $req['harga_satuan']);
        $kodeKota = \App\Models\setting::where('nama', Constant::$SETTING_KODE_KOTA)->first()->nilai;    

        $propinsi = \App\Models\alamat::find(!array_key_exists('alamat_propinsi', $req) ? -1 : $req['alamat_propinsi']);
        if (empty($propinsi)) {
            $propinsi = 0;
        } else {
            $propinsi = $propinsi->kode;
        }


        $kota = \App\Models\alamat::find(!array_key_exists('alamat_kota', $req) ? -1 : $req['alamat_kota']);
        if (empty($kota)) {
            $kota = 0;
        } else {
            $kota = $kota->kode;
        }

        $organisasiOpd = \App\Models\organisasi::find(!array_key_exists('pidopd', $req) ? -1 : $req['pidopd']);
        if (empty($organisasiOpd)) {
            $organisasiOpd = 0;
        } else {
            $organisasiOpd = $organisasiOpd->kode;
        }

        $organisasiOpdCabang = \App\Models\organisasi::find(!array_key_exists('pidopd_cabang', $req) ? -1 : $req['pidopd_cabang']);
        if (empty($organisasiOpdCabang)) {
            $organisasiOpdCabang = '00';
        } else {
            if(strlen($organisasiOpdCabang->kode) > 2) {
                $organisasiOpdCabang = substr($organisasiOpdCabang->kode, strlen($organisasiOpdCabang->kode) - 2, strlen($organisasiOpdCabang->kode));
            } else {
                $organisasiOpdCabang = $organisasiOpdCabang->kode;
            }
            
        }

        $organisasiUpt = \App\Models\organisasi::find(!array_key_exists('pidupt', $req) ? -1 : $req['pidupt']);
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

    public static function kodeBarang($pidBarang) {
        $barang = \App\Models\barang::find($pidBarang);
        $kode = "";
        if ($barang->kode_akun != null) {
            $kode .= $barang->kode_akun;
        }

        if ($barang->kode_kelompok != null) {
            $kode .= ".".$barang->kode_kelompok;
        }

        if ($barang->kode_jenis != null) {
            $kode .= ".".$barang->kode_jenis;
        }

        if ($barang->kode_objek != null) {
            $kode .= ".".$barang->kode_objek;
        }

        if ($barang->kode_rincian_objek != null) {
            $kode .= ".".$barang->kode_rincian_objek;
        }

        if ($barang->kode_sub_rincian_objek != null) {
            $kode .= ".".$barang->kode_sub_rincian_objek;
        }

        if ($barang->kode_sub_sub_rincian_objek != null) {
            $kode .= ".".$barang->kode_sub_sub_rincian_objek;
        }

        return $kode;
    }
}
