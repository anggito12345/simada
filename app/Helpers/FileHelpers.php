<?php
namespace App\Helpers;

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
}