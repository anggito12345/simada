<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRkaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rka', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('no_spk')->nullable();
			$table->string('no_bast')->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->bigInteger('nilai_kontrak')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rka');
	}

}
