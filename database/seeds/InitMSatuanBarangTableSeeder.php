<?php

use Illuminate\Database\Seeder;

class InitMSatuanBarangTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('m_satuan_barang')->delete();
        
        \DB::table('m_satuan_barang')->insert(array (
            0 => 
            array (
                'id' => 2,
                'nama' => 'Buah',
                'aktif' => 1,
                'bisadibagi' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'nama' => 'Hektar',
                'aktif' => 1,
                'bisadibagi' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'nama' => 'Meter',
                'aktif' => 1,
                'bisadibagi' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 6,
                'nama' => 'test',
                'aktif' => 1,
                'bisadibagi' => 0,
                'created_at' => '2019-09-08',
                'updated_at' => '2019-09-08',
            ),
            4 => 
            array (
                'id' => 1,
                'nama' => 'Unit',
                'aktif' => 1,
                'bisadibagi' => 0,
                'created_at' => NULL,
                'updated_at' => '2019-09-08',
            ),
        ));
        
        
    }
}