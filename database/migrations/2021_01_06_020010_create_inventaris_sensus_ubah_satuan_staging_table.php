<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventarisSensusUbahSatuanStagingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventaris_sensus_ubah_satuan_staging', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('idinventaris')->nullable();
			$table->bigInteger('id_sensus')->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->date('deleted_at')->nullable();
			$table->text('data_temporary')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inventaris_sensus_ubah_satuan_staging');
	}

}
