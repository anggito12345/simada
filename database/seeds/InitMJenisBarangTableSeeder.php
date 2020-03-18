<?php

use Illuminate\Database\Seeder;

class InitMJenisBarangTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('m_jenis_barang')->delete();
        
        \DB::table('m_jenis_barang')->insert(array (
            0 => 
            array (
                'id' => 5,
                'nama' => 'Peralatan dan Mesin',
                'aktif' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'kode' => '2',
                'kelompok_kib' => 'B',
            ),
            1 => 
            array (
                'id' => 6,
                'nama' => 'Gedung dan Bangunan',
                'aktif' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'kode' => '3',
                'kelompok_kib' => 'C',
            ),
            2 => 
            array (
                'id' => 7,
                'nama' => 'Jalan, Irigasi dan Jaringan',
                'aktif' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'kode' => '4',
                'kelompok_kib' => 'D',
            ),
            3 => 
            array (
                'id' => 8,
                'nama' => 'Aset Tetap Lainnya',
                'aktif' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'kode' => '5',
                'kelompok_kib' => 'E',
            ),
            4 => 
            array (
                'id' => 9,
                'nama' => 'Konstruksi dalam Pengerjaan',
                'aktif' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'kode' => '6',
                'kelompok_kib' => 'F',
            ),
            5 => 
            array (
                'id' => 1,
                'nama' => 'Tanah',
                'aktif' => NULL,
                'created_at' => '2019-09-07',
                'updated_at' => '2019-09-07',
                'kode' => '1',
                'kelompok_kib' => 'A',
            ),
        ));
        
        
    }
}