<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InitUsersTableSeeder::class);
        $this->call(InitSystemSettingTableSeeder::class);
        $this->call(InitModulesTableSeeder::class);
        $this->call(InitModuleAccessTableSeeder::class);
        $this->call(InitMStatusTanahTableSeeder::class);
        $this->call(InitMSatuanBarangTableSeeder::class);
        $this->call(InitMPerolehanTableSeeder::class);
        $this->call(InitMOrganisasiTableSeeder::class);
        $this->call(InitMMitraTableSeeder::class);
        $this->call(InitMMerkBarangTableSeeder::class);
        $this->call(InitMKondisiTableSeeder::class);
        $this->call(InitMJabatanTableSeeder::class);
        $this->call(InitMBarangTableSeeder::class);
        $this->call(InitMAlamatTableSeeder::class);
        $this->call(InitMJenisBarangTableSeeder::class);
    }
}
