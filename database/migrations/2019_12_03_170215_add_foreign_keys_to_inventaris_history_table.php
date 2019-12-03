<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInventarisHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inventaris_history', function(Blueprint $table)
		{
			$table->foreign('id', 'id_inventaris_history')->references('id')->on('inventaris')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inventaris_history', function(Blueprint $table)
		{
			$table->dropForeign('id_inventaris_history');
		});
	}

}
