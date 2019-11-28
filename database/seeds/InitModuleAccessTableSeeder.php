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
                'id' => 24,
                'nama' => 'mutasi',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'create',
                'pid_jabatan' => 1,
            ),
            1 => 
            array (
                'id' => 25,
                'nama' => 'mutasi',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'update',
                'pid_jabatan' => 1,
            ),
            2 => 
            array (
                'id' => 26,
                'nama' => 'mutasi',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'view',
                'pid_jabatan' => 1,
            ),
            3 => 
            array (
                'id' => 27,
                'nama' => 'mutasi',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'export',
                'pid_jabatan' => 1,
            ),
            4 => 
            array (
                'id' => 28,
                'nama' => 'mutasi',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'import',
                'pid_jabatan' => 1,
            ),
            5 => 
            array (
                'id' => 29,
                'nama' => 'inventaris',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'create',
                'pid_jabatan' => 1,
            ),
            6 => 
            array (
                'id' => 30,
                'nama' => 'inventaris',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'update',
                'pid_jabatan' => 1,
            ),
            7 => 
            array (
                'id' => 31,
                'nama' => 'inventaris',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'view',
                'pid_jabatan' => 1,
            ),
            8 => 
            array (
                'id' => 32,
                'nama' => 'inventaris',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'export',
                'pid_jabatan' => 1,
            ),
            9 => 
            array (
                'id' => 33,
                'nama' => 'inventaris',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'import',
                'pid_jabatan' => 1,
            ),
            10 => 
            array (
                'id' => 34,
                'nama' => 'penghapusan',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'create',
                'pid_jabatan' => 1,
            ),
            11 => 
            array (
                'id' => 35,
                'nama' => 'penghapusan',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'update',
                'pid_jabatan' => 1,
            ),
            12 => 
            array (
                'id' => 36,
                'nama' => 'penghapusan',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'view',
                'pid_jabatan' => 1,
            ),
            13 => 
            array (
                'id' => 37,
                'nama' => 'penghapusan',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'export',
                'pid_jabatan' => 1,
            ),
            14 => 
            array (
                'id' => 38,
                'nama' => 'penghapusan',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'import',
                'pid_jabatan' => 1,
            ),
            15 => 
            array (
                'id' => 39,
                'nama' => 'pemeliharaan',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'create',
                'pid_jabatan' => 1,
            ),
            16 => 
            array (
                'id' => 40,
                'nama' => 'pemeliharaan',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'update',
                'pid_jabatan' => 1,
            ),
            17 => 
            array (
                'id' => 41,
                'nama' => 'pemeliharaan',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'view',
                'pid_jabatan' => 1,
            ),
            18 => 
            array (
                'id' => 42,
                'nama' => 'pemeliharaan',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'export',
                'pid_jabatan' => 1,
            ),
            19 => 
            array (
                'id' => 43,
                'nama' => 'pemeliharaan',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'import',
                'pid_jabatan' => 1,
            ),
            20 => 
            array (
                'id' => 44,
                'nama' => 'master barang',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'create',
                'pid_jabatan' => 1,
            ),
            21 => 
            array (
                'id' => 45,
                'nama' => 'master barang',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'update',
                'pid_jabatan' => 1,
            ),
            22 => 
            array (
                'id' => 46,
                'nama' => 'master barang',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'view',
                'pid_jabatan' => 1,
            ),
            23 => 
            array (
                'id' => 47,
                'nama' => 'master barang',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'export',
                'pid_jabatan' => 1,
            ),
            24 => 
            array (
                'id' => 48,
                'nama' => 'master barang',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'import',
                'pid_jabatan' => 1,
            ),
            25 => 
            array (
                'id' => 49,
                'nama' => 'RKA',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'create',
                'pid_jabatan' => 1,
            ),
            26 => 
            array (
                'id' => 50,
                'nama' => 'RKA',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'update',
                'pid_jabatan' => 1,
            ),
            27 => 
            array (
                'id' => 51,
                'nama' => 'RKA',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'view',
                'pid_jabatan' => 1,
            ),
            28 => 
            array (
                'id' => 52,
                'nama' => 'RKA',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'export',
                'pid_jabatan' => 1,
            ),
            29 => 
            array (
                'id' => 53,
                'nama' => 'RKA',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'import',
                'pid_jabatan' => 1,
            ),
            30 => 
            array (
                'id' => 54,
                'nama' => 'master',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'create',
                'pid_jabatan' => 1,
            ),
            31 => 
            array (
                'id' => 55,
                'nama' => 'master',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'update',
                'pid_jabatan' => 1,
            ),
            32 => 
            array (
                'id' => 56,
                'nama' => 'master',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'view',
                'pid_jabatan' => 1,
            ),
            33 => 
            array (
                'id' => 57,
                'nama' => 'master',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'export',
                'pid_jabatan' => 1,
            ),
            34 => 
            array (
                'id' => 58,
                'nama' => 'master',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'import',
                'pid_jabatan' => 1,
            ),
            35 => 
            array (
                'id' => 59,
                'nama' => 'user',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'create',
                'pid_jabatan' => 1,
            ),
            36 => 
            array (
                'id' => 60,
                'nama' => 'user',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'update',
                'pid_jabatan' => 1,
            ),
            37 => 
            array (
                'id' => 61,
                'nama' => 'user',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'view',
                'pid_jabatan' => 1,
            ),
            38 => 
            array (
                'id' => 62,
                'nama' => 'user',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'export',
                'pid_jabatan' => 1,
            ),
            39 => 
            array (
                'id' => 63,
                'nama' => 'user',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'import',
                'pid_jabatan' => 1,
            ),
            40 => 
            array (
                'id' => 64,
                'nama' => 'system',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'create',
                'pid_jabatan' => 1,
            ),
            41 => 
            array (
                'id' => 65,
                'nama' => 'system',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'update',
                'pid_jabatan' => 1,
            ),
            42 => 
            array (
                'id' => 66,
                'nama' => 'system',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'view',
                'pid_jabatan' => 1,
            ),
            43 => 
            array (
                'id' => 67,
                'nama' => 'system',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'export',
                'pid_jabatan' => 1,
            ),
            44 => 
            array (
                'id' => 68,
                'nama' => 'system',
                'created_at' => '2019-11-17',
                'updated_at' => '2019-11-17',
                'kode_module' => 'import',
                'pid_jabatan' => 1,
            ),
            45 => 
            array (
                'id' => 69,
                'nama' => 'mutasi',
                'created_at' => '2019-11-24',
                'updated_at' => '2019-11-24',
                'kode_module' => 'create',
                'pid_jabatan' => 3,
            ),
            46 => 
            array (
                'id' => 70,
                'nama' => 'mutasi',
                'created_at' => '2019-11-24',
                'updated_at' => '2019-11-24',
                'kode_module' => 'update',
                'pid_jabatan' => 3,
            ),
        ));
        
        
    }
}