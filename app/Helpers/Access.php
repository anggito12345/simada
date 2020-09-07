<?php
namespace App\Helpers;

use Auth;
use Illuminate\Support\Facades\Session;
use Constant;

class Access {

    /**
     * methods to check is accesable ornot
     * $kel is levels in m_organisasi, example values are (bpkad, opd, et)
     * $access is detail access in users will required when $names filled
     * $names is needed when u use $access
     */

     /**
      * access had some access name they are, view, export, create, update, delete, and import
      * names had some module name you can find those in module table.
      * any question can ask to anggitowibisono12@gmail.com
      * how do we used this function , as example: is(['inventaris'],['create'],[-1])
      * the third parameters are numeric value which is available in Constant class
      */
    public static function is($names = '', $access = [], $kel = []) {
        if (in_array(Constant::$GROUP_CABANGOPD_ORG, $kel)) {
            array_push($kel, Constant::$GROUP_UPT_ORG);
        }

        $templateSQL = '(([names] AND [access]) OR ([kel]))';

        $combination = 'NAMES:' . json_encode($names) . 'ACCESS:' . json_encode($access) . 'KEL:' . json_encode($kel);

        if (!empty(session('cache-user', null))) {
            $cacheString = session('cache-user');
            if (strpos($cacheString, $combination) && strpos($cacheString, '&DELIMITER:')) {
                $cacheArray = explode('&DELIMITER:', $cacheString);
                if($names == 'master alamat') {
                    return $cacheString;
                }

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
        ->leftJoin('m_jabatan', 'm_jabatan.id', 'users.jabatan')
        ->leftJoin('m_organisasi', 'm_organisasi.id', 'users.pid_organisasi');

        if ($names != '' || count($access) > 0) {
            $query = $query
                ->leftJoin('module_access', 'module_access.pid_jabatan', 'users.jabatan');
        }

        if ($names != '' && count($access) > 0) {
            array_walk($access, function(&$x) {$x = "'$x'";});


            $templateSQL = str_replace('[names]', 'module_access.nama = \''.$names.'\'', $templateSQL);
            $templateSQL = str_replace('[access]', 'module_access.kode_module IN ('.implode(',', $access).')',$templateSQL);

        } else {
            $templateSQL = str_replace('[names]', 'false',$templateSQL);
            $templateSQL = str_replace('[access]', 'false',$templateSQL);
        }

        if (count($kel) > 0) {
            //array_walk($kel, function(&$x) {$x = "'$x'";});
            $templateSQL = str_replace('[kel]', 'm_organisasi.level IN ('.implode(',', $kel).')',$templateSQL);
        } else {
            $templateSQL = str_replace('[kel]', 'false',$templateSQL);
        }

        $query = $query
                ->whereRaw($templateSQL);



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
