<?php

use App\Helpers\Constant;
use App\Models\users;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        app('config')->set('permission.enable_wildcard_permission', true);

        Permission::findOrCreate('*');

        Permission::findOrCreate('master.*');

        Permission::findOrCreate('master.lokasi.*');
        Permission::findOrCreate('master.lokasi.update');
        Permission::findOrCreate('master.lokasi.create');
        Permission::findOrCreate('master.lokasi.read');
        Permission::findOrCreate('master.lokasi.delete');

        Permission::findOrCreate('master.barang.*');
        Permission::findOrCreate('master.barang.update');
        Permission::findOrCreate('master.barang.create');
        Permission::findOrCreate('master.barang.read');
        Permission::findOrCreate('master.barang.delete');

        Permission::findOrCreate('master.organisasi.*');
        Permission::findOrCreate('master.organisasi.update');
        Permission::findOrCreate('master.organisasi.create');
        Permission::findOrCreate('master.organisasi.read');
        Permission::findOrCreate('master.organisasi.delete');

        Permission::findOrCreate('master.satuan_barang.*');
        Permission::findOrCreate('master.satuan_barang.update');
        Permission::findOrCreate('master.satuan_barang.create');
        Permission::findOrCreate('master.satuan_barang.read');
        Permission::findOrCreate('master.satuan_barang.delete');

        Permission::findOrCreate('master.mitra.*');
        Permission::findOrCreate('master.mitra.update');
        Permission::findOrCreate('master.mitra.create');
        Permission::findOrCreate('master.mitra.read');
        Permission::findOrCreate('master.mitra.delete');

        Permission::findOrCreate('master.penggunaan_kib_a.*');
        Permission::findOrCreate('master.penggunaan_kib_a.update');
        Permission::findOrCreate('master.penggunaan_kib_a.create');
        Permission::findOrCreate('master.penggunaan_kib_a.read');
        Permission::findOrCreate('master.penggunaan_kib_a.delete');

        Permission::findOrCreate('master.kode_daerah.*');
        Permission::findOrCreate('master.kode_daerah.update');
        Permission::findOrCreate('master.kode_daerah.create');
        Permission::findOrCreate('master.kode_daerah.read');
        Permission::findOrCreate('master.kode_daerah.delete');

        Permission::findOrCreate('master.merk.*');
        Permission::findOrCreate('master.merk.update');
        Permission::findOrCreate('master.merk.create');
        Permission::findOrCreate('master.merk.read');
        Permission::findOrCreate('master.merk.delete');

        Permission::findOrCreate('setup.*');

        Permission::findOrCreate('setup.pengaturan.*');
        Permission::findOrCreate('setup.pengaturan.update');
        Permission::findOrCreate('setup.pengaturan.create');
        Permission::findOrCreate('setup.pengaturan.read');
        Permission::findOrCreate('setup.pengaturan.delete');

        Permission::findOrCreate('setup.data_center.*');
        Permission::findOrCreate('setup.data_center.update');
        Permission::findOrCreate('setup.data_center.create');
        Permission::findOrCreate('setup.data_center.read');
        Permission::findOrCreate('setup.data_center.delete');

        Permission::findOrCreate('otorisasi.*');
        Permission::findOrCreate('otorisasi.mutasi');
        Permission::findOrCreate('otorisasi.penghapusan');
        Permission::findOrCreate('otorisasi.sensus');
        Permission::findOrCreate('otorisasi.reklas');

        Permission::findOrCreate('transaksi.*');

        Permission::findOrCreate('transaksi.penghapusan.*');
        Permission::findOrCreate('transaksi.penghapusan.create');
        Permission::findOrCreate('transaksi.penghapusan.update');
        Permission::findOrCreate('transaksi.penghapusan.delete');
        Permission::findOrCreate('transaksi.penghapusan.read');
        Permission::findOrCreate('transaksi.penghapusan.post');

        Permission::findOrCreate('transaksi.pemeliharaan.*');
        Permission::findOrCreate('transaksi.pemeliharaan.create');
        Permission::findOrCreate('transaksi.pemeliharaan.update');
        Permission::findOrCreate('transaksi.pemeliharaan.delete');
        Permission::findOrCreate('transaksi.pemeliharaan.read');
        Permission::findOrCreate('transaksi.pemeliharaan.post');

        Permission::findOrCreate('transaksi.pemanfaatan.*');
        Permission::findOrCreate('transaksi.pemanfaatan.create');
        Permission::findOrCreate('transaksi.pemanfaatan.update');
        Permission::findOrCreate('transaksi.pemanfaatan.delete');
        Permission::findOrCreate('transaksi.pemanfaatan.read');
        Permission::findOrCreate('transaksi.pemanfaatan.post');

        Permission::findOrCreate('transaksi.mutasi.*');
        Permission::findOrCreate('transaksi.mutasi.create');
        Permission::findOrCreate('transaksi.mutasi.update');
        Permission::findOrCreate('transaksi.mutasi.delete');
        Permission::findOrCreate('transaksi.mutasi.read');
        Permission::findOrCreate('transaksi.mutasi.post');

        Permission::findOrCreate('transaksi.rka.*');
        Permission::findOrCreate('transaksi.rka.create');
        Permission::findOrCreate('transaksi.rka.update');
        Permission::findOrCreate('transaksi.rka.delete');
        Permission::findOrCreate('transaksi.rka.read');
        Permission::findOrCreate('transaksi.rka.post');

        Permission::findOrCreate('transaksi.reklas.*');
        Permission::findOrCreate('transaksi.reklas.create');
        Permission::findOrCreate('transaksi.reklas.update');
        Permission::findOrCreate('transaksi.reklas.delete');
        Permission::findOrCreate('transaksi.reklas.read');
        Permission::findOrCreate('transaksi.reklas.post');

        Permission::findOrCreate('transaksi.sensus.*');
        Permission::findOrCreate('transaksi.sensus.create');
        Permission::findOrCreate('transaksi.sensus.update');
        Permission::findOrCreate('transaksi.sensus.delete');
        Permission::findOrCreate('transaksi.sensus.read');
        Permission::findOrCreate('transaksi.sensus.post');

        Permission::findOrCreate('transaksi.koreksi.*');
        Permission::findOrCreate('transaksi.koreksi.create');
        Permission::findOrCreate('transaksi.koreksi.update');
        Permission::findOrCreate('transaksi.koreksi.delete');
        Permission::findOrCreate('transaksi.koreksi.read');
        Permission::findOrCreate('transaksi.koreksi.post');

        Permission::findOrCreate('transaksi.inventaris.*');
        Permission::findOrCreate('transaksi.inventaris.create');
        Permission::findOrCreate('transaksi.inventaris.update');
        Permission::findOrCreate('transaksi.inventaris.delete');
        Permission::findOrCreate('transaksi.inventaris.read');
        Permission::findOrCreate('transaksi.inventaris.post');

        Permission::findOrCreate('transaksi.level.1');
        Permission::findOrCreate('transaksi.level.2');
        Permission::findOrCreate('transaksi.level.3');
        Permission::findOrCreate('transaksi.level.4');

        //create role sub kuasa pengguna barang

        $role1AddPerm = Role::create(['name' => 'sub kuasa pengguna barang', 'level' => 2]);

        //==== master
        $role1AddPerm->givePermissionTo('master.*');

        $role1AddPerm->givePermissionTo('master.merk.*');
        //==== transaksi
        $role1AddPerm->givePermissionTo('transaksi.inventaris.*');
        $role1AddPerm->givePermissionTo('transaksi.sensus.*');
        $role1AddPerm->givePermissionTo('transaksi.reklas.*');
        $role1AddPerm->givePermissionTo('transaksi.rka.*');
        $role1AddPerm->givePermissionTo('transaksi.mutasi.*');
        $role1AddPerm->givePermissionTo('transaksi.pemanfaatan.*');
        $role1AddPerm->givePermissionTo('transaksi.pemeliharaan.*');
        $role1AddPerm->givePermissionTo('transaksi.penghapusan.*');
        $role1AddPerm->givePermissionTo('transaksi.level.4');

        // create role kuasa pengguna barang

        $role2AddPerm = Role::create(['name' => 'kuasa pengguna barang', 'level' => 1]);
        //==== master
        $role2AddPerm->givePermissionTo('master.lokasi.*');

        $role2AddPerm->givePermissionTo('master.merk.*');

        $role2AddPerm->givePermissionTo('otorisasi.mutasi');

        $role2AddPerm->givePermissionTo('transaksi.inventaris.*');
        $role2AddPerm->givePermissionTo('transaksi.sensus.*');
        $role2AddPerm->givePermissionTo('transaksi.reklas.*');
        $role2AddPerm->givePermissionTo('transaksi.rka.*');
        $role2AddPerm->givePermissionTo('transaksi.mutasi.*');
        $role2AddPerm->givePermissionTo('transaksi.pemanfaatan.*');
        $role2AddPerm->givePermissionTo('transaksi.pemeliharaan.*');
        $role2AddPerm->givePermissionTo('transaksi.penghapusan.*');

        $role2AddPerm->givePermissionTo('transaksi.level.3');
        // create role pengguna barang

        $role3AddPerm = Role::create(['name' => 'pengguna barang', 'level' => 0]);
       //==== master
        $role3AddPerm->givePermissionTo('master.lokasi.*');

        $role3AddPerm->givePermissionTo('master.merk.*');

        $role3AddPerm->givePermissionTo('otorisasi.mutasi');

        $role3AddPerm->givePermissionTo('transaksi.inventaris.*');
        $role3AddPerm->givePermissionTo('transaksi.sensus.*');
        $role3AddPerm->givePermissionTo('transaksi.reklas.*');
        $role3AddPerm->givePermissionTo('transaksi.rka.*');
        $role3AddPerm->givePermissionTo('transaksi.mutasi.*');
        $role3AddPerm->givePermissionTo('transaksi.pemanfaatan.*');
        $role3AddPerm->givePermissionTo('transaksi.pemeliharaan.*');
        $role3AddPerm->givePermissionTo('transaksi.penghapusan.*');

        $role3AddPerm->givePermissionTo('transaksi.level.2');

        // create role pengelola barang

        $role4AddPerm = Role::create(['name' => 'pengelola barang', 'level' => -1]);

        $role4AddPerm->givePermissionTo('*');

        // create role pengelola barang

        $role5AddPerm = Role::create(['name' => 'gubernur', 'level' => -2]);

        $role5AddPerm->givePermissionTo('*');

    }
}
