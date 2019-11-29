<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePenghapusanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penghapusan', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pidinventaris')->nullable();
			$table->string('noreg')->nullable();
			$table->date('tglhapus')->nullable();
			$table->string('kriteria')->nullable();
			$table->string('kondisi')->nullable();
			$table->string('harga_apprisal')->nullable();
			$table->string('dokumen')->nullable();
			$table->string('foto')->nullable();
			$table->string('nosk')->nullable();
			$table->date('tglsk')->nullable();
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
		Schema::drop('penghapusan');
	}

}
