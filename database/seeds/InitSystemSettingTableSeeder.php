<?php

use Illuminate\Database\Seeder;

class InitSystemSettingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('system_setting')->delete();
        
        \DB::table('system_setting')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'SKIN',
                'nilai' => 'blue',
                'aktif' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'type' => 'global',
                'user_akses' => NULL,
                'editable' => false,
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'KODE_LOKASI_STATUS',
                'nilai' => '11',
                'aktif' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-10-20',
                'type' => 'global',
                'user_akses' => NULL,
                'editable' => true,
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'KODE_PROPINSI',
                'nilai' => '22',
                'aktif' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-10-21',
                'type' => 'global',
                'user_akses' => NULL,
                'editable' => true,
            ),
            3 => 
            array (
                'id' => 6,
                'nama' => 'NAMA_KOTA',
                'nilai' => 'Bogor',
                'aktif' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-11-06',
                'type' => 'global',
                'user_akses' => NULL,
                'editable' => true,
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'KODE_KOTA',
                'nilai' => '3123',
                'aktif' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-11-06',
                'type' => 'global',
                'user_akses' => NULL,
                'editable' => true,
            ),
            5 => 
            array (
                'id' => 4,
                'nama' => 'NAMA_PROPINSI',
                'nilai' => 'Jawa Bara',
                'aktif' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-11-06',
                'type' => 'global',
                'user_akses' => NULL,
                'editable' => true,
            ),
        ));
        
        
    }
}