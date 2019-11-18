<?php
namespace App\Helpers;

use Auth;

class Access {


    public static function is($names = [], $access = [], $kel = []) {
        $query = \App\Models\jabatan::where([
            'm_jabatan.id' => Auth::user()->jabatan,
        ]);

        if (count($names) > 0 || count($access) > 0) {
            $query = $query
                ->join('module_access', 'module_access.pid_jabatan', 'm_jabatan.id');
        }

        if (count($access) > 0) {
            array_walk($access, function(&$x) {$x = "'$x'";});
            $query = $query
                ->whereRaw('module_access.kode_module IN ('.implode(',', $access).')');
        }

        if (count($kel) > 0) {
            $query = $query
                ->whereRaw('m_jabatan.kelompok IN ('.implode(',', $kel).')');
        }

        if (count($names) > 0) {
            array_walk($names, function(&$x) {$x = "'$x'";});
            $query = $query
                ->whereRaw('module_access.nama IN ('.implode(',', $names).')');
        }

        return $query->count() > 0;
    }

    public static function isKel($kel = []) {
        return \App\Models\jabatan::where([
            'id' => Auth::user()->jabatan,
        ])->where('kelompok', 'IN', '('.implode(',', $kel).')')->count() > 0;
    }


}