<?php

use Illuminate\Database\Seeder;

class InitMStatusTanahTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('m_status_tanah')->delete();
        
        \DB::table('m_status_tanah')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Milik Sendiri',
                'created_at' => '2019-09-09',
                'updated_at' => '2019-09-09',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Sewa',
                'created_at' => '2019-09-09',
                'updated_at' => '2019-09-09',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Lainnya',
                'created_at' => '2019-09-09',
                'updated_at' => '2019-09-09',
            ),
        ));
        
        
    }
}