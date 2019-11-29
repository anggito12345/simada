<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetilBangunanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detil_bangunan', function(Blueprint $table)
		{
			$table->foreign('pidinventaris', 'detil_bangunan_pidinventaris_fkey2')->references('id')->on('inventaris')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detil_bangunan', function(Blueprint $table)
		{
			$table->dropForeign('detil_bangunan_pidinventaris_fkey2');
		});
	}

}
