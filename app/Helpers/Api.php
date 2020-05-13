<?php
namespace App\Helpers;

class Api {


    public static function mandatory($input, $fields = []) {
        
        foreach ($fields as $key => $value) {
            if (!array_key_exists($value, $input)) {
                return response([
                    'message' => 'param '.$value.' is mandatory',
                ] , 400);
            }
        }
    }


    public static function rules($input, $rules = []) {
                
        foreach ($rules as $key => $value) {
            $strSplits = explode("|", $value);

            foreach ($strSplits as $rule) {
                # code...
                if (!array_key_exists($key,$input) && $rule != 'required') {
                    continue;
                }
    
                switch ($rule) {
                    case 'integer':
                        if (!is_integer($input[$key])) {
                            return response($key . ' should be integer' , 400);
                        }
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }

            
        }
    }
}