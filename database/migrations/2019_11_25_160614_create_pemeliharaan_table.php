<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePemeliharaanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pemeliharaan', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pidinventaris')->nullable();
			$table->date('tgl')->nullable();
			$table->string('uraian')->nullable();
			$table->string('persh')->nullable();
			$table->string('alamat')->nullable();
			$table->string('nokontrak')->nullable();
			$table->date('tglkontrak')->nullable();
			$table->integer('biaya')->nullable();
			$table->integer('menambah')->nullable();
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
		Schema::drop('pemeliharaan');
	}

}
