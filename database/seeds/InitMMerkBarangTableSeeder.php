<?php

use Illuminate\Database\Seeder;

class InitMMerkBarangTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('m_merk_barang')->delete();
        
        \DB::table('m_merk_barang')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'cobamerk2',
                'aktif' => 0,
                'created_at' => '2019-09-08',
                'updated_at' => '2019-09-08',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'merk3',
                'aktif' => 1,
                'created_at' => '2019-09-09',
                'updated_at' => '2019-09-09',
            ),
            2 => 
            array (
                'id' => 5,
                'nama' => 'test',
                'aktif' => 1,
                'created_at' => '2019-09-27',
                'updated_at' => '2019-09-27',
            ),
        ));
        
        
    }
}