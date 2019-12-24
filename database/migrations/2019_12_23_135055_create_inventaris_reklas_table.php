<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventarisReklasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventaris_reklas', function(Blueprint $table)
		{
			$table->integer('id');
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
			$table->string('keterangan', 500)->nullable();
			$table->date('updated_at')->nullable();
			$table->date('created_at')->nullable();
			$table->string('tahun_perolehan', 4)->nullable();
			$table->integer('jumlah')->nullable();
			$table->date('tgl_dibukukan')->nullable();
			$table->integer('satuan')->nullable();
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
			$table->string('kode_gedung', 50)->nullable();
			$table->string('kode_ruang', 50)->nullable();
			$table->integer('penanggung_jawab')->nullable();
			$table->integer('umur_ekonomis')->nullable();
			$table->string('draft', 1)->nullable();
			$table->bigInteger('id_pk', true);
			$table->integer('created_by')->nullable();
			$table->date('reklas_at')->nullable();
			$table->string('status',10)->nullable();
			$table->string('tipe_kib',5)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inventaris_reklas');
	}

}
