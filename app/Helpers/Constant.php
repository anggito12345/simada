<?php
namespace App\Helpers;


class Constant {


    public static $ACTION_HISTORY = [
        "PEM1" => [
            'nama' => 'Tambah Pemeliharaan'
        ],
        "MUT" => [
            'nama' => 'Mutasi'
        ],
        "PENGHAPUSAN" => [
            'nama' => 'Penghapusan'
        ],
        'NEW' => [
            'nama' => 'Baru'
        ],
        "UPDATE" => [
            'nama' => 'Update'
        ],
        "KOREKSI" => [
            'nama' => 'Koreksi'
        ],
    ];

    public static $STATUS = [
        'CODE1' => [
            'nama' => 'PROGRESS',
            'class' => 'bg-yellow'
        ],
        'CODE2' => [
            'nama' => 'CANCELLED',
            'class' => 'bg-red'
        ],
        'CODE3' => [
            'nama' => 'DONE',
            'class' => 'bg-green'
        ],
    ];

}