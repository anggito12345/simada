<?php
namespace App\Helpers;

class LookupHelper {


    public static function build($query, $request) {
        $group = [];
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

                if (isset($value['group'])) {
                    

                    if (isset($value['logic']) && $value['logic'] == "or" && isset($group[$value['group']])) {
                        $group[$value['group']] .= " OR " . $key . " ".$value['operator']." '".$value['value']."'";
                        continue;
                    }

                    if (isset($group[$value['group']])) {
                        $group[$value['group']] .= " AND " . $key . " ".$value['operator']." '".$value['value']."'";
                        continue;
                    } 

                    $group[$value['group']] = $key . " ".$value['operator']." '".$value['value']."'";
                    
                    continue;
                }

                if (isset($value['logic']) && $value['logic'] == "or") {
                    $query = $query->orWhereRaw($key." ".$value['operator']." '".$value['value']."'");
                    continue;
                } 
                
                $query = $query->whereRaw($key." ".$value['operator']." '".$value['value']."'");
            }
        }


        foreach ($group as $key => $value) {
            $query = $query->whereRaw("(".$value.")");
        }

        return $query;
    }
}