<?php
namespace App\Helpers;

class LookupHelper {


    public static function build($query, $request) {
        if ($request->input('search-lookup') != null) {
            foreach ($request->input('search-lookup') as $key => $value) {
                if ($value['operator'] == '~*') {
                    $value['value'] = ".*".$value['value'].".*";
                } else if ($value['operator'] == 'like') {
                    $value['value'] = "%".$value['value']."%";
                }

                if ($value['value'] == null) {
                    continue;
                }
                $query = $query->whereRaw($key." ".$value['operator']." '".$value['value']."'");
            }
        }

        return $query;
    }
}