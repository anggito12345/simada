<?php
namespace App\Helpers;


class Constant {

    public static $SETTING_UBAH_PENATA_USAHAAN = 'UBAH_PENATA_USAHAAN';
    public static $SETTING_NAMA_KOTA = 'NAMA_KOTA';
    public static $SETTING_KODE_KOTA = 'KODE_KOTA';
    public static $SETTING_NAMA_PROPINSI = 'NAMA_PROPINSI';
    public static $SETTING_KODE_PROPINSI = 'KODE_PROPINSI';
    public static $SETTING_KODE_LOKASI_STATUS = 'KODE_LOKASI_STATUS';
    public static $SETTING_SKIN = 'SKIN';

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

    public static $SENSUS_STATUS_01 = [
        'Tidak Ada',
        'Ubah Satuan'
    ];

    public static $SENSUS_STATUS_02 = [
        'Pisah',
        'Gabung'
    ];

    public static $SENSUS_STATUS_03 = [
        'Sudah dihapuskan',
        'Hilang',
        'Tidak diketahui keberadaanya',
        'Double catat'
    ];

    public static $SENSUS_STATUS_APPROVAL = [
        'Pengajuan',
        'Disetujui BPKAD',

    ];

    public static $GROUP_GUBERNUR = -3;
    public static $GROUP_SEKDA = -2;
    public static $GROUP_BPKAD_ORG = -1;
    public static $GROUP_OPD_ORG = 0;
    public static $GROUP_CABANGOPD_ORG = 1;
    public static $GROUP_UPT_ORG = 2;


}
