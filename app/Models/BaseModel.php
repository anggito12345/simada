<?php

namespace App\Models;

use Eloquent as Model;

class BaseModel extends Model {

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


    public static $YesNoDs = [
        '1' => 'Ya',
        '0' => 'Tidak'
    ];


    public static $kondisiDs = [
        'Baik' => 'Baik',
        'Kurang Baik' => 'Kurang Baik',
        'Rusak Berat' => 'Rusak Berat'
    ];

    public static $jenisKotaDs = [
        'Propinsi' => 'Propinsi',
        'Kota' => 'Kota',
        'Kecamatan' => 'Kecamatan',
        'Kelurahan/Desa' => 'Kelurahan/Desa',
    ];

    public static $konstruksiDs = [
        'Permanen' => 'Permanen',
        'Tidak Permanen' => 'Tidak Permanen',
    ];
}