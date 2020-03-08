<?php

namespace App\Models;

use Eloquent as Model;

class BaseModel extends Model {

    public function __construct()
    {
        parent::boot();
    }

    public static $default = [
        'maxlength' => 30,
        'minlength' => 6
    ];

    public static function generateValidation($key, $rules, $defaultAttributes) {        

        $defaultValues = self::$default;        

        if (!array_key_exists($key, $rules)) {
            $defaultValues = array_merge($defaultAttributes, $defaultValues);
            return $defaultValues;
        }

        $rulesAray = explode("|", $rules[$key]);

        for ($i=0; $i < count($rulesAray); $i++) { 

            if (strpos($rulesAray[$i], "min") > -1) {
                $minExploded = explode(":", $rulesAray[$i]);
                $defaultValues["minlength"] = $minExploded[1];
            } else if (strpos($rulesAray[$i], "max") > -1) {
                $maxExploded = explode(":", $rulesAray[$i]);
                $defaultValues["maxlength"] = $maxExploded[1];
            } else if (strpos($rulesAray[$i], "required") > -1) {                
                $defaultValues["required"] = true;
            }

        }

        $defaultValues = array_merge($defaultAttributes, $defaultValues);

        return $defaultValues;
    }


    public static function getRelationData($data, $keyToObtain, $defaultValue = "")
    {
        return isset($data) ? $data->$keyToObtain : $defaultValue;
    }

    public static $LevelDs = [
        -1,0,1,2,3
    ];

    public static $JenisKelaminDs = [
        'L' => 'Laki - Laki',
        'P' => 'Perempuan'
    ];


    public static $YesNoDs = [
        '1' => 'Ya',
        '0' => 'Tidak'
    ];

    public static $sertifikatDs = [
        'Ada' => 'Ada',
        'Tidak Ada' => 'Tidak Ada',
    ];

    public static $hakDs = [
        'Pakai' => 'Pakai',
        'Pengelolaan' => 'Pengelolaan',
        'Milik' => 'Milik',
    ];

    public static $kondisiDs = [
        'Baik' => 'Baik',
        'Kurang Baik' => 'Kurang Baik',
        'Rusak Berat' => 'Rusak Berat'
    ];

    public static $jenisKotaDs = [
        '0' => 'Provinsi',
        '1' => 'Kota',
        '2' => 'Kecamatan',
        '3' => 'Kelurahan/Desa',
    ];

    public static $konstruksiDs = [
        'Permanen' => 'Permanen',
        'Tidak Permanen' => 'Tidak Permanen',
    ];

    public static $perolehanDs = [
        'Pembelian' => 'Pembelian',
        'Hadiah/Hibah' => 'Hadiah/Hibah',
        'Lainnya' => 'Lainnya',
        'Mutasi' => 'Mutasi',
    ];

    public static $peruntukanDs = [
        'Retribusi' => 'Retribusi',
        // 'Pinjam Pakai' => 'Pinjam Pakai',
        'Sewa' => 'Sewa',
        'BGS' => 'BGS',
        'BSG' => 'BSG',
        'KSP' => 'KSP',
        'KSPI' => 'KSPI',
    ];

    public static $tipeKontribusiDs = [
        '0' => 'Tetap',
        '1' => 'Bagi Hasil',
        '2' => 'Tetap dan Bagi Hasil',
    ];

    public static $kelompokJabatanDs = [
        '-3' => 'Gubernur',
        '-2' => 'Sekda',
        '-1' => 'BPKAD',
        '0' => 'OPD',
        '1' => 'Cabang OPD',
        //'2' => 'UPT'
    ];
}