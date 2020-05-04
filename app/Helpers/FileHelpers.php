<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelpers {

    public static $imageExt = [
        'png',
        'jpg',
        'jpeg',
    ];


    public static $docExt = [
        'doc',
        'docx',
        'rtf',
        'xls',
        'xlsx'
    ];

    public static function showFile($filename) {
        $splitedFilename = explode(".",$filename);
        $extension = $splitedFilename[count($splitedFilename) - 1];
        $splitterRealFilename =  explode("/",$filename);
        $realFilename = $splitterRealFilename[count($splitterRealFilename) - 1];
        if (in_array($extension,self::$docExt)) {
            return "<span class='btn btn-default' onclick='App.Helpers.downloadFile(\"".$filename."\")'><i class='fa fa-download'></i> ".basename($filename)."</span>";
        } else {
            return "<img src='".$filename."' class='image-preview'/>";
        }
    }

    public static function uploadMultiple($fileKey, $request, $folder, $funcBeforeSave) {
        $ids = [];
        $systemUploadRetFunc = true;
        $input = $request->all();

        if (!isset($input[$fileKey])) {
            return;
        }

        $files = $input[$fileKey];
        $isUpdate = true;

        if($files) {    
            foreach ($files as $key => $value) {                                
                if (isset($input[$fileKey . '_metadata_id'][$key]) && $value) {
                    $isUpdate = true;
                    $systemUpload = \App\Models\system_upload::find($input[$fileKey . '_metadata_id'][$key]);

                    if ($value && $value != "false")
                        Storage::delete($systemUpload->path);
                } else {
                    $isUpdate = false;
                    $systemUpload = new \App\Models\system_upload();
                }
            
                if ($value && $value != "false") {
                    $systemUpload->name = $value->getClientOriginalName();
                    $systemUpload->path = $value->storeAs('public/'. $folder, sha1(time(). $value->getClientOriginalName()). uniqid());
                    $systemUpload->size = $value->getSize();
                    $systemUpload->type = $value->getClientMimeType();
                }
                                
                
                if ($funcBeforeSave != null) {
                    $systemUpload = $funcBeforeSave($input, $key, $systemUpload);      
                }    
                            
                $systemUploadReturnData = $systemUpload->save();    
                if (!$isUpdate) {                                          
                    array_push($ids, $systemUpload);
                } else {
                }                
            }
        } 

        return $ids;
    }


    public static function deleteAll($files, $commited = true) { 
        if ($files == null) {
            return; 
        }

        foreach ($files as $key => $value) {
            # code...
            $systemUpload = null;

            if ($commited) {
                $systemUpload = \App\Models\system_upload::find($value->id);
            }
            
            if ($value->path != "") {
                Storage::delete($value->path);
            }

            if ($systemUpload) {
                $systemUpload->delete();
            }

            
        }        
    }


    public static function getOnlyFilenameInArray($arrayFilenames = []) {
        $onlyFilenameArray = [];
        foreach ($arrayFilenames as $filename) {
            # code...
            array_push($onlyFilenameArray, substr($filename, strrpos($filename, '/') + 1));
        }

        return $onlyFilenameArray;    
    }
}