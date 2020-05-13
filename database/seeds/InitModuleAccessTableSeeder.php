<?php

use Illuminate\Database\Seeder;

class InitModuleAccessTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('module_access')->delete();
        
        \DB::table('module_access')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'inventaris',
                'created_at' => '2020-03-24',
                'updated_at' => '2020-03-24',
                'kode_module' => 'update',
                'pid_jabatan' => 3,
            ),
        ));
        
        
    }
}