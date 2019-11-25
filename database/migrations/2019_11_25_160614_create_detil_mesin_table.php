<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetilMesinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detil_mesin', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pidinventaris')->nullable();
			$table->integer('merk')->nullable();
			$table->string('ukuran')->nullable();
			$table->string('bahan')->nullable();
			$table->string('nopabrik')->nullable();
			$table->string('norangka')->nullable();
			$table->string('nomesin')->nullable();
			$table->string('nopol')->nullable();
			$table->string('bpkb')->nullable();
			$table->string('keterangan')->nullable();
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
		Schema::drop('detil_mesin');
	}

}
