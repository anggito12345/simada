<?php

use Illuminate\Database\Seeder;

class InitMAlamatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('m_alamat')->delete();
        
        \DB::table('m_alamat')->insert(array (
            0 => 
            array (
                'id' => 13,
                'pid' => NULL,
                'nama' => 'Yogyakarta',
                'jenis' => '0',
                'kodepos' => NULL,
                'updated_at' => '2019-10-28',
                'created_at' => '2019-10-28',
                'kode' => '34',
            ),
            1 => 
            array (
                'id' => 14,
                'pid' => 13,
                'nama' => 'Kota Yogyakarta',
                'jenis' => '1',
                'kodepos' => NULL,
                'updated_at' => '2019-10-28',
                'created_at' => '2019-10-28',
                'kode' => '71',
            ),
        ));
        
        
    }
}