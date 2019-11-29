<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetilTanahTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detil_tanah', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pidinventaris')->nullable();
			$table->integer('luas')->nullable();
			$table->string('alamat')->nullable();
			$table->integer('idkota')->nullable();
			$table->integer('idkecamatan')->nullable();
			$table->integer('idkelurahan')->nullable();
			$table->string('koordinatlokasi', 500)->nullable();
			$table->string('koordinattanah', 1000)->nullable();
			$table->string('hak')->nullable();
			$table->string('status_sertifikat')->nullable();
			$table->date('tgl_sertifikat')->nullable();
			$table->string('nomor_sertifikat')->nullable();
			$table->string('penggunaan')->nullable();
			$table->string('keterangan', 500)->nullable();
			$table->string('dokumen')->nullable();
			$table->string('foto', 500)->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detil_tanah');
	}

}
