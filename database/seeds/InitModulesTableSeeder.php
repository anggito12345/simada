<?php

use Illuminate\Database\Seeder;

class InitModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('modules')->delete();
        
        \DB::table('modules')->insert(array (
            0 => 
            array (
                'id' => 14,
                'nama' => 'mutasi',
                'updated_at' => NULL,
                'created_at' => NULL,
                'kode' => 'mutasi',
            ),
            1 => 
            array (
                'id' => 13,
                'nama' => 'inventaris',
                'updated_at' => NULL,
                'created_at' => NULL,
                'kode' => 'inventasi',
            ),
            2 => 
            array (
                'id' => 15,
                'nama' => 'penghapusan',
                'updated_at' => NULL,
                'created_at' => NULL,
                'kode' => 'png',
            ),
            3 => 
            array (
                'id' => 16,
                'nama' => 'pemeliharaan',
                'updated_at' => NULL,
                'created_at' => NULL,
                'kode' => 'pmh',
            ),
            4 => 
            array (
                'id' => 17,
                'nama' => 'master barang',
                'updated_at' => NULL,
                'created_at' => NULL,
                'kode' => 'mba',
            ),
            5 => 
            array (
                'id' => 18,
                'nama' => 'RKA',
                'updated_at' => NULL,
                'created_at' => NULL,
                'kode' => 'rka',
            ),
            6 => 
            array (
                'id' => 19,
                'nama' => 'master',
                'updated_at' => NULL,
                'created_at' => NULL,
                'kode' => 'mas',
            ),
            7 => 
            array (
                'id' => 20,
                'nama' => 'user',
                'updated_at' => NULL,
                'created_at' => NULL,
                'kode' => 'usr',
            ),
            8 => 
            array (
                'id' => 21,
                'nama' => 'system',
                'updated_at' => NULL,
                'created_at' => NULL,
                'kode' => 'sys',
            ),
        ));
        
        
    }
}