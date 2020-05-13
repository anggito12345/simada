<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRkaDetilTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rka_detil', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
            $table->bigInteger('pid')->nullable();
            $table->integer('kode_barang')->nullable();
			$table->integer('jumlah_real')->nullable();
			$table->float('harga_satuan_real')->nullable();
			$table->float('nilai_real')->nullable();
			$table->string('kib')->nullable();
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
		Schema::drop('rka_detil');
	}

}
