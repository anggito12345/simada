<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMutasiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mutasi', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('opd_asal')->nullable();
			$table->integer('opd_tujuan')->nullable();
			$table->string('no_bast')->nullable();
			$table->date('tgl_bast')->nullable();
			$table->integer('idpegawai')->nullable();
			$table->string('alasan_mutasi')->nullable();
			$table->string('keterangan')->nullable();
			$table->date('updated_at')->nullable();
			$table->date('created_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mutasi');
	}

}
