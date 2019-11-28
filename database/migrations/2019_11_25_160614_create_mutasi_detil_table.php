<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMutasiDetilTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mutasi_detil', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pid')->nullable();
			$table->integer('inventaris')->nullable();
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
		Schema::drop('mutasi_detil');
	}

}
