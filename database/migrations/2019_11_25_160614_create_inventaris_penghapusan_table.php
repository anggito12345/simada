<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventarisPenghapusanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventaris_penghapusan', function(Blueprint $table)
		{
			$table->integer('id', false);
			$table->string('noreg')->nullable();
			$table->integer('pidbarang')->nullable();
			$table->string('pidopd')->nullable();
			$table->integer('pidlokasi')->nullable();
			$table->date('tgl_sensus')->nullable();
			$table->integer('volume')->nullable();
			$table->integer('pembagi')->nullable();
			$table->bigInteger('harga_satuan')->nullable();
			$table->string('perolehan', 50)->nullable();
			$table->string('kondisi', 50)->nullable();
			$table->string('lokasi_detil')->nullable();
			$table->integer('umur_ekonomis')->nullable();
			$table->string('keterangan', 500)->nullable();
			$table->date('updated_at')->nullable();
			$table->date('created_at')->nullable();
			$table->string('tahun_perolehan', 4)->nullable();
			$table->integer('jumlah')->nullable();
			$table->date('tgl_dibukukan')->nullable();
			$table->integer('satuan')->nullable();
			$table->boolean('draft')->nullable();
			$table->date('deleted_at')->nullable();
			$table->integer('pidopd_cabang')->nullable();
			$table->integer('pidupt')->nullable();
			$table->string('kode_lokasi', 1000)->nullable();
			$table->integer('alamat_propinsi')->nullable();
			$table->integer('alamat_kota')->nullable();
			$table->integer('alamat_kecamatan')->nullable();
			$table->bigInteger('alamat_kelurahan')->nullable();
			$table->integer('idpegawai')->nullable();
			$table->integer('pid_organisasi')->nullable();
			$table->bigInteger('id_pk', true);
			$table->integer('pid_penghapusan')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inventaris_penghapusan');
	}

}
