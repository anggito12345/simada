<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetilKonstruksiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detil_konstruksi', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pidinventaris')->nullable();
			$table->string('konstruksi')->nullable();
			$table->string('bertingkat')->nullable();
			$table->string('beton')->nullable();
			$table->integer('luasbangunan')->nullable();
			$table->string('alamat')->nullable();
			$table->integer('idkota')->nullable();
			$table->integer('idkecamatan')->nullable();
			$table->integer('idkelurahan')->nullable();
			$table->string('koordinatlokasi')->nullable();
			$table->string('koordinattanah', 2000)->nullable();
			$table->date('tglmulai')->nullable();
			$table->date('tgldokumen')->nullable();
			$table->string('nodokumen')->nullable();
			$table->integer('luastanah')->nullable();
			$table->string('statustanah')->nullable();
			$table->string('keterangan')->nullable();
			$table->string('dokumen')->nullable();
			$table->string('foto', 500)->nullable();
			$table->integer('kodetanah')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detil_konstruksi');
	}

}
