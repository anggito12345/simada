<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModuleAccessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('module_access', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama', 50)->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->string('kode_module')->nullable();
			$table->integer('pid_jabatan')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('module_access');
	}

}
