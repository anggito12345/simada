<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class modulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('modules')->insert([
            'nama' => 'inventaris',            
        ]);

        DB::table('modules')->insert([
            'nama' => 'mutasi',            
        ]);

        DB::table('modules')->insert([
            'nama' => 'penghapusan',            
        ]);
    }
}
