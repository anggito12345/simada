<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventarisSensusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventaris_sensus', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('idinventaris')->nullable();
			$table->string('no_sk', 50)->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->string('tanggal_sk')->nullable();
			$table->string('status_barang', 50)->nullable();
			$table->string('status_barang_hilang', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inventaris_sensus');
	}

}
