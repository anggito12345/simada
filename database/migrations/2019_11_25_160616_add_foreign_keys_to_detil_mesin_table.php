<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetilMesinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detil_mesin', function(Blueprint $table)
		{
			$table->foreign('pidinventaris', 'detil_mesin_pidinventaris_fkey')->references('id')->on('inventaris')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detil_mesin', function(Blueprint $table)
		{
			$table->dropForeign('detil_mesin_pidinventaris_fkey');
		});
	}

}
