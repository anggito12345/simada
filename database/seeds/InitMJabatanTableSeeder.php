<?php

use Illuminate\Database\Seeder;

class InitMJabatanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('m_jabatan')->delete();
        
        \DB::table('m_jabatan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Pengelola Barang',
                'created_at' => '2019-10-20',
                'updated_at' => '2019-10-27',
                'nama_jabatan' => 'Sekda',
                'level' => -1,
                'kelompok' => 0,
            ),
            1 => 
            array (
                'id' => 8,
                'nama' => 'Pejabat Penatausahaan Barang',
                'created_at' => '2019-10-20',
                'updated_at' => '2019-10-27',
                'nama_jabatan' => 'Kaban',
                'level' => 0,
                'kelompok' => 0,
            ),
            2 => 
            array (
                'id' => 4,
                'nama' => 'Pengguna Barang',
                'created_at' => '2019-10-20',
                'updated_at' => '2019-10-27',
                'nama_jabatan' => 'Kepala OPD',
                'level' => 2,
                'kelompok' => 0,
            ),
            3 => 
            array (
                'id' => 5,
                'nama' => 'Kuasa Pengguna Barang',
                'created_at' => '2019-10-20',
                'updated_at' => '2019-10-27',
                'nama_jabatan' => 'Sekretaris/Eselon 3',
                'level' => 3,
                'kelompok' => 1,
            ),
            4 => 
            array (
                'id' => 10,
                'nama' => 'Pejabat Penatausahaan pengguna',
                'created_at' => '2019-10-27',
                'updated_at' => '2019-10-27',
                'nama_jabatan' => 'Kasubag Kepegawaian dan Umum',
                'level' => 4,
                'kelompok' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'Pengurus Barang Pembantu',
                'created_at' => '2019-10-20',
                'updated_at' => '2019-10-27',
                'nama_jabatan' => 'Staf',
                'level' => 5,
                'kelompok' => 2,
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'Pengurus Barang',
                'created_at' => '2019-10-20',
                'updated_at' => '2019-10-27',
                'nama_jabatan' => 'Staf',
                'level' => 5,
                'kelompok' => 2,
            ),
            7 => 
            array (
                'id' => 3,
                'nama' => 'Pengurus Barang Pengelola',
                'created_at' => '2019-10-20',
                'updated_at' => '2019-11-24',
                'nama_jabatan' => 'Kabid BMD',
                'level' => 1,
                'kelompok' => -1,
            ),
        ));
        
        
    }
}