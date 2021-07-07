<?php

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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();



        Permission::findOrCreate('Edit.Lokasi');
        Permission::findOrCreate('Add.Lokasi');
        Permission::findOrCreate('View.Lokasi');
        Permission::findOrCreate('Import.Lokasi');
        Permission::findOrCreate('Delete.Lokasi');

        Permission::findOrCreate('Edit.Barang');
        Permission::findOrCreate('Add.Barang');
        Permission::findOrCreate('View.Barang');
        Permission::findOrCreate('Import.Barang');
        Permission::findOrCreate('Delete.Barang');

        Permission::findOrCreate('Edit.Organisasi');
        Permission::findOrCreate('Add.Organisasi');
        Permission::findOrCreate('View.Organisasi');
        Permission::findOrCreate('Import.Organisasi');
        Permission::findOrCreate('Delete.Organisasi');



        Permission::findOrCreate('Edit.Satuan Barang');
        Permission::findOrCreate('Add.Satuan Barang');
        Permission::findOrCreate('View.Satuan Barang');
        Permission::findOrCreate('Import.Satuan Barang');
        Permission::findOrCreate('Delete.Satuan Barang');

        Permission::findOrCreate('Edit.Mitra');
        Permission::findOrCreate('Add.Mitra');
        Permission::findOrCreate('View.Mitra');
        Permission::findOrCreate('Import.Mitra');
        Permission::findOrCreate('Delete.Mitra');

        Permission::findOrCreate('Edit.Penggunaan KIB A');
        Permission::findOrCreate('Add.Penggunaan KIB A');
        Permission::findOrCreate('View.Penggunaan KIB A');
        Permission::findOrCreate('Import.Penggunaan KIB A');
        Permission::findOrCreate('Delete.Penggunaan KIB A');

        Permission::findOrCreate('Edit.Kode Daerah');
        Permission::findOrCreate('Add.Kode Daerah');
        Permission::findOrCreate('View.Kode Daerah');
        Permission::findOrCreate('Import.Kode Daerah');
        Permission::findOrCreate('Delete.Kode Daerah');

        Permission::findOrCreate('Edit.Merk');
        Permission::findOrCreate('Add.Merk');
        Permission::findOrCreate('View.Merk');
        Permission::findOrCreate('Import.Merk');
        Permission::findOrCreate('Delete.Merk');

        Permission::findOrCreate('Edit.Pengaturan');
        Permission::findOrCreate('Add.Pengaturan');
        Permission::findOrCreate('View.Pengaturan');
        Permission::findOrCreate('Import.Pengaturan');
        Permission::findOrCreate('Delete.Pengaturan');

        Permission::findOrCreate('AllMaster');

        //===

        Permission::findOrCreate('Edit.Data Center');
        Permission::findOrCreate('Add.Data Center');
        Permission::findOrCreate('View.Data Center');
        Permission::findOrCreate('Import.Data Center');
        Permission::findOrCreate('Delete.Data Center');

        Permission::findOrCreate('Transaction.Level1');
        Permission::findOrCreate('Transaction.Level2');
        Permission::findOrCreate('Transaction.Level3');
        Permission::findOrCreate('Transaction.Level4');

        Permission::findOrCreate('Verifikasi.Mutasi');
        Permission::findOrCreate('Verifikasi.Penghapusan');
        Permission::findOrCreate('Verifikasi.Sensus');
        Permission::findOrCreate('Verifikasi.Reklas');

        //transaksi
        Permission::findOrCreate('Edit.Penghapusan');
        Permission::findOrCreate('Add.Penghapusan');
        Permission::findOrCreate('View.Penghapusan');
        Permission::findOrCreate('Import.Penghapusan');
        Permission::findOrCreate('Delete.Penghapusan');

        Permission::findOrCreate('Edit.Pemeliharaan');
        Permission::findOrCreate('Add.Pemeliharaan');
        Permission::findOrCreate('View.Pemeliharaan');
        Permission::findOrCreate('Import.Pemeliharaan');
        Permission::findOrCreate('Delete.Pemeliharaan');

        Permission::findOrCreate('Edit.Pemanfaatan');
        Permission::findOrCreate('Add.Pemanfaatan');
        Permission::findOrCreate('View.Pemanfaatan');
        Permission::findOrCreate('Import.Pemanfaatan');
        Permission::findOrCreate('Delete.Pemanfaatan');

        Permission::findOrCreate('Edit.Mutasi');
        Permission::findOrCreate('Add.Mutasi');
        Permission::findOrCreate('View.Mutasi');
        Permission::findOrCreate('Import.Mutasi');
        Permission::findOrCreate('Delete.Mutasi');

        Permission::findOrCreate('Edit.RKA');
        Permission::findOrCreate('Add.RKA');
        Permission::findOrCreate('View.RKA');
        Permission::findOrCreate('Import.RKA');
        Permission::findOrCreate('Delete.RKA');

        Permission::findOrCreate('Edit.Reklas');
        Permission::findOrCreate('Add.Reklas');
        Permission::findOrCreate('View.Reklas');
        Permission::findOrCreate('Import.Reklas');
        Permission::findOrCreate('Delete.Reklas');

        Permission::findOrCreate('Edit.Sensus');
        Permission::findOrCreate('Add.Sensus');
        Permission::findOrCreate('View.Sensus');
        Permission::findOrCreate('Import.Sensus');
        Permission::findOrCreate('Delete.Sensus');

        Permission::findOrCreate('Edit.Koreksi');
        Permission::findOrCreate('Add.Koreksi');
        Permission::findOrCreate('View.Koreksi');
        Permission::findOrCreate('Import.Koreksi');
        Permission::findOrCreate('Delete.Koreksi');

        //posting data dari draft
        Permission::findOrCreate('Inventaris.Post');

        Permission::findOrCreate('AllTransaction.Except.Koreksi');
        Permission::findOrCreate('AllTransaction');


        //create role sub kuasa pengguna barang

        $role1AddPerm = Role::create(['name' => 'sub kuasa pengguna barang']);

        //==== master
        $role1AddPerm->givePermissionTo('Add.Lokasi');
        $role1AddPerm->givePermissionTo('View.Lokasi');
        $role1AddPerm->givePermissionTo('Import.Lokasi');
        $role1AddPerm->givePermissionTo('Delete.Lokasi');

        $role1AddPerm->givePermissionTo('Edit.Merk');
        $role1AddPerm->givePermissionTo('Add.Merk');
        $role1AddPerm->givePermissionTo('View.Merk');
        $role1AddPerm->givePermissionTo('Import.Merk');
        $role1AddPerm->givePermissionTo('Delete.Merk');
        //==== transaksi

        $role1AddPerm->givePermissionTo('AllTransaction.Except.Koreksi');
        $role1AddPerm->givePermissionTo('AllTransaction');

        $role1AddPerm->givePermissionTo('Transaction.Level4');

        // create role kuasa pengguna barang

        $role2AddPerm = Role::create(['name' => 'kuasa pengguna barang']);
        $role2AddPerm->givePermissionTo('Add.Lokasi');
        $role2AddPerm->givePermissionTo('View.Lokasi');
        $role2AddPerm->givePermissionTo('Import.Lokasi');
        $role2AddPerm->givePermissionTo('Delete.Lokasi');

        $role2AddPerm->givePermissionTo('Edit.Merk');
        $role2AddPerm->givePermissionTo('Add.Merk');
        $role2AddPerm->givePermissionTo('View.Merk');
        $role2AddPerm->givePermissionTo('Import.Merk');
        $role2AddPerm->givePermissionTo('Delete.Merk');

        $role2AddPerm->givePermissionTo('Verifikasi.Mutasi');

        $role2AddPerm->givePermissionTo('AllTransaction.Except.Koreksi');

        $role2AddPerm->givePermissionTo('Transaction.Level3');



        // create role pengguna barang

        $role3AddPerm = Role::create(['name' => 'pengguna barang']);
        $role3AddPerm->givePermissionTo('Add.Lokasi');
        $role3AddPerm->givePermissionTo('View.Lokasi');
        $role3AddPerm->givePermissionTo('Import.Lokasi');
        $role3AddPerm->givePermissionTo('Delete.Lokasi');

        $role3AddPerm->givePermissionTo('Edit.Merk');
        $role3AddPerm->givePermissionTo('Add.Merk');
        $role3AddPerm->givePermissionTo('View.Merk');
        $role3AddPerm->givePermissionTo('Import.Merk');
        $role3AddPerm->givePermissionTo('Delete.Merk');

        $role3AddPerm->givePermissionTo('Verifikasi.Mutasi');

        $role1AddPerm->givePermissionTo('AllTransaction.Except.Koreksi');

        $role1AddPerm->givePermissionTo('Transaction.Level2');


        // create role Gubernur

        $role5AddPerm = Role::create(['name' => 'gubernur']);

        $role5AddPerm->givePermissionTo('Verifikasi.Mutasi');
        $role5AddPerm->givePermissionTo('Verifikasi.Penghapusan');
        $role5AddPerm->givePermissionTo('Verifikasi.Sensus');
        $role5AddPerm->givePermissionTo('Verifikasi.Reklas');

        $role5AddPerm->givePermissionTo('Edit.Data Center');
        $role5AddPerm->givePermissionTo('Add.Data Center');
        $role5AddPerm->givePermissionTo('View.Data Center');
        $role5AddPerm->givePermissionTo('Import.Data Center');
        $role5AddPerm->givePermissionTo('Delete.Data Center');

        $role5AddPerm->givePermissionTo('Edit.Pengaturan');
        $role5AddPerm->givePermissionTo('Add.Pengaturan');
        $role5AddPerm->givePermissionTo('View.Pengaturan');
        $role5AddPerm->givePermissionTo('Import.Pengaturan');
        $role5AddPerm->givePermissionTo('Delete.Pengaturan');

        $role5AddPerm->givePermissionTo('AllMaster');
        $role5AddPerm->givePermissionTo('AllTransaction');

        $role5AddPerm->givePermissionTo('Inventaris.Post');

        $role5AddPerm->givePermissionTo('Transaction.Level1');

    }
}
