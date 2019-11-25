<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetilTanahTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detil_tanah', function(Blueprint $table)
		{
			$table->foreign('pidinventaris', 'detil_tanah_pidinventaris_fkey1')->references('id')->on('inventaris')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detil_tanah', function(Blueprint $table)
		{
			$table->dropForeign('detil_tanah_pidinventaris_fkey1');
		});
	}

}
