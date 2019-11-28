<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetilKonstruksiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detil_konstruksi', function(Blueprint $table)
		{
			$table->foreign('pidinventaris', 'detil_konstruksi_pidinventaris_fkey')->references('id')->on('inventaris')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detil_konstruksi', function(Blueprint $table)
		{
			$table->dropForeign('detil_konstruksi_pidinventaris_fkey');
		});
	}

}
