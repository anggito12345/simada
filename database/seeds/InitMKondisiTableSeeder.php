<?php

use Illuminate\Database\Seeder;

class InitMKondisiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('m_kondisi')->delete();
        
        \DB::table('m_kondisi')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'test',
                'aktif' => NULL,
                'updated_at' => '2019-09-08',
                'created_at' => '2019-09-08',
            ),
        ));
        
        
    }
}