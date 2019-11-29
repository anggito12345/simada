<?php

use Illuminate\Database\Seeder;

class InitMPerolehanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('m_perolehan')->delete();
        
        \DB::table('m_perolehan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Perolehan 1',
                'aktif' => 0,
                'created_at' => '2019-09-08',
                'updated_at' => '2019-09-08',
            ),
        ));
        
        
    }
}