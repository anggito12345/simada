<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkflowTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workflow', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama')->nullable();
			$table->string('trigger')->nullable();
			$table->integer('pid_user')->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('workflow');
	}

}
