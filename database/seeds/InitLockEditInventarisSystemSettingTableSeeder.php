<?php

use Illuminate\Database\Seeder;

class InitLockEditInventarisSystemSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lockInventarisSetting = \DB::table('system_setting')->where('nama', \Constant::$SETTING_UBAH_PENATA_USAHAAN)->first();

        if (empty($lockInventarisSetting)) {
            \DB::table('system_setting')->insert([
                [
                    'id' => 7,
                    'nama' => 'UBAH_PENATA_USAHAAN',
                    'nilai' => 'TRUE',
                    'aktif' => NULL,
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                    'type' => 'global',
                    'user_akses' => NULL,
                    'editable' => true,
                ]
            ]);
        }
    }
}
