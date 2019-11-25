<?php

use Illuminate\Database\Seeder;

class InitMMitraTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('m_mitra')->delete();
        
        \DB::table('m_mitra')->insert(array (
            0 => 
            array (
                'id' => 1,
                'npwp' => NULL,
                'siup_tdp' => NULL,
                'nama' => 'PT Jaya',
                'alamat' => NULL,
                'telp' => NULL,
                'email' => NULL,
                'jenis_usaha' => NULL,
                'pic' => NULL,
                'jabatan_pic' => NULL,
                'hp_pic' => NULL,
                'email_pic' => NULL,
                'aktf' => NULL,
                'created_at' => '2019-10-18',
                'updated_at' => '2019-10-18',
            ),
        ));
        
        
    }
}