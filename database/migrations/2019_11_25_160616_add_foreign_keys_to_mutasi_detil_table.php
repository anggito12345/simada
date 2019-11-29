<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMutasiDetilTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mutasi_detil', function(Blueprint $table)
		{
			$table->foreign('pid', 'pid_mutasi')->references('id')->on('mutasi')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mutasi_detil', function(Blueprint $table)
		{
			$table->dropForeign('pid_mutasi');
		});
	}

}
