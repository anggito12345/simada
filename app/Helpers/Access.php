<?php
namespace App\Helpers;

use Auth;
use Illuminate\Support\Facades\Session;
use Constant;

class Access {


    public static function is($names = [], $access = [], $kel = []) {
        if (in_array(Constant::GROUP_CABANGOPD_ORG, $key)) {
            $kel = array_push($kel, Constant::GROUP_UPT_ORG);
        }

        $combination = 'NAMES:' . json_encode($names) . 'ACCESS:' . json_encode($access) . 'KEL:' . json_encode($kel);        

        if (!empty(session('cache-user', null))) {
            $cacheString = session('cache-user');
            if (strpos($cacheString, $combination) && strpos($cacheString, '&DELIMITER:')) {
                $cacheArray = explode('&DELIMITER:', $cacheString);
                foreach ($cacheArray as $key => $value) {
                    # code...
                    if(strpos($value, $combination)) {                                                  
                        return explode('RESULT:',$value)[1] == 'true' ? true : false;
                    }
                }
                return false;
            } else if (strpos($cacheString, $combination)) {
                
                return explode('RESULT:', $cacheString)[1] == 'true' ? true : false;
            }
        }

        $query = \App\Models\users::where([
            'users.id' => Auth::user()->id,
        ])
        ->join('m_jabatan', 'm_jabatan.id', 'users.jabatan')
        ->join('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi');

        if (count($names) > 0 || count($access) > 0) {
            $query = $query
                ->join('module_access', 'module_access.pid_jabatan', 'users.jabatan');
        }

        if (count($access) > 0) {
            array_walk($access, function(&$x) {$x = "'$x'";});
            $query = $query
                ->whereRaw('module_access.kode_module IN ('.implode(',', $access).')');
        }

        if (count($kel) > 0) {
            array_walk($kel, function(&$x) {$x = "'$x'";});
            $query = $query
                ->whereRaw('m_organisasi.jabatans IN ('.implode(',', $kel).')');
        }

        if (count($names) > 0) {
            array_walk($names, function(&$x) {$x = "'$x'";});
            $query = $query
                ->whereRaw('module_access.nama IN ('.implode(',', $names).')');
        }

        if (empty(session('cache-user', null))) {
            Session::put('cache-user', 'START:' . $combination .  'RESULT:' . ($query->count() > 0 ? 'true' : 'false'));
            
        } else {
            if (!strpos($cacheString, $combination)) {
                Session::put('cache-user', Session::get('cache-user') . '&DELIMITER:START:' . $combination .  'RESULT:' . ($query->count() > 0 ? 'true' : 'false'));       
            }
            
        }

        Session::save();

        return $query->count() > 0;
    }

    public static function isKel($kel = []) {
        return \App\Models\users::where([
            'users.id' => Auth::user()->jabatan,
        ])
        ->join('m_jabatan', 'm_jabatan.id', 'users.jabatan')
        ->join('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi')
        ->where('m_organisasi.jabatans', 'IN', '('.implode(',', $kel).')')->count() > 0;
    }


}