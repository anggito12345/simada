<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetilAsetLainnyaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detil_aset_lainnya', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pidinventaris')->nullable();
			$table->string('buku_judul')->nullable();
			$table->string('buku_spesifikasi')->nullable();
			$table->string('seni_asal')->nullable();
			$table->string('seni_pencipta')->nullable();
			$table->string('seni_bahan')->nullable();
			$table->string('ternak_jenis')->nullable();
			$table->string('ternak_ukuran')->nullable();
			$table->string('keterangan')->nullable();
			$table->string('dokumen')->nullable();
			$table->string('foto', 500)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detil_aset_lainnya');
	}

}
