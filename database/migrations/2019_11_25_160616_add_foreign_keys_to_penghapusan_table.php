<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPenghapusanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('penghapusan', function(Blueprint $table)
		{
			$table->foreign('pidinventaris', 'inventaris_penghapusan')->references('id')->on('inventaris')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('penghapusan', function(Blueprint $table)
		{
			$table->dropForeign('inventaris_penghapusan');
		});
	}

}
