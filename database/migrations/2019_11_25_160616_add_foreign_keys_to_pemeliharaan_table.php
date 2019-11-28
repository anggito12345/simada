<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPemeliharaanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pemeliharaan', function(Blueprint $table)
		{
			$table->foreign('pidinventaris', 'inventaris_pemeliharaan')->references('id')->on('inventaris')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pemeliharaan', function(Blueprint $table)
		{
			$table->dropForeign('inventaris_pemeliharaan');
		});
	}

}
