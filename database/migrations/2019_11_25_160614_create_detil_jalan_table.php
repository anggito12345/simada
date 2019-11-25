<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetilJalanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detil_jalan', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pidinventaris')->nullable();
			$table->string('konstruksi')->nullable();
			$table->integer('panjang')->nullable();
			$table->integer('lebar')->nullable();
			$table->integer('luas')->nullable();
			$table->string('alamat')->nullable();
			$table->integer('idkota')->nullable();
			$table->integer('idkecamatan')->nullable();
			$table->integer('idkelurahan')->nullable();
			$table->string('koordinatlokasi')->nullable();
			$table->string('koordinattanah', 2000)->nullable();
			$table->date('tgldokumen')->nullable();
			$table->string('nodokumen')->nullable();
			$table->string('luastanah')->nullable();
			$table->string('statustanah')->nullable();
			$table->string('kodetanah')->nullable();
			$table->string('keterangan')->nullable();
			$table->string('dokumen')->nullable();
			$table->string('foto', 500)->nullable();
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
		Schema::drop('detil_jalan');
	}

}
