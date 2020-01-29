<?php

use Illuminate\Database\Seeder;

class InitUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 11,
                'name' => 'coba daftar',
                'email' => 'anggitowibisono12@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$CrB2BZuZ56LCy.mKE4dso.NyQa2NOUMn/0FtCslG1ECtNUDfL4AbG',
                'remember_token' => NULL,
                'created_at' => '2019-11-06 18:53:44',
                'updated_at' => '2019-11-24 17:30:25',
                'nip' => '312312312412312312',
                'no_hp' => '123123',
                'tgl_lahir' => '1999-11-07',
                'jenis_kelamin' => 'L',
                'pid_organisasi' => 14,
                'role' => NULL,
                'username' => 'admincoba',
                'aktif' => '1',
                'email_verification_code' => '',
                'jabatan' => 1,
                'api_token' => '1648d032ccfc26bfc84483674ad199fabf0dd1f771055da36e0dc98d21432281',
                'email_forgot_password' => 'e3e489bb6a6ca1618386c2009356f6f16c9e4791',
            ),
            1 => 
            array (
                'id' => 10,
                'name' => 'admin_bpkad',
                'email' => 'mbahdavesby74@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$VazzRtpxgPz3jDCkmIoAfuBDX6xZMXbOdGWYibDGCvM99Jo2tEW3.',
                'remember_token' => NULL,
                'created_at' => '2019-11-03 16:29:35',
                'updated_at' => '2019-11-24 17:32:46',
                'nip' => '412312331233333333',
                'no_hp' => '123123',
                'tgl_lahir' => '1984-11-03',
                'jenis_kelamin' => 'L',
                'pid_organisasi' => 202,
                'role' => NULL,
                'username' => 'admin_bpkad',
                'aktif' => '1',
                'email_verification_code' => '',
                'jabatan' => 3,
                'api_token' => '3682f22c2da49de3b3b410ec8674af15b445381ec8aaa6647361cce2a3df94b9',
                'email_forgot_password' => NULL,
            ),
            2 => 
            array (
                'id' => 9,
                'name' => 'anggito',
                'email' => 'anggitowibisono14@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$6meSlXmyi2aK1l/gXRGGMuDIGIZJG24HTVFIznVKR2KYUJoBdTsNq',
                'remember_token' => NULL,
                'created_at' => '2019-10-20 11:01:40',
                'updated_at' => '2019-11-24 17:33:07',
                'nip' => '312312312323123123',
                'no_hp' => '123123',
                'tgl_lahir' => '1989-10-20',
                'jenis_kelamin' => 'L',
                'pid_organisasi' => 10,
                'role' => NULL,
                'username' => 'admin123',
                'aktif' => '1',
                'email_verification_code' => '',
                'jabatan' => 4,
                'api_token' => '42cd51926beef9e0b1de9b31d0c6a3db6dc24a418cd59c1fd89528e38ef4a3c5',
                'email_forgot_password' => NULL,
            ),
        ));
        
        
    }
}