<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystemUploadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_upload', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('uid')->nullable();
			$table->string('name')->nullable();
			$table->string('type')->nullable();
			$table->integer('size')->nullable();
			$table->string('path')->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->string('jenis')->nullable();
			$table->string('keterangan')->nullable();
			$table->string('foreign_field')->nullable();
			$table->string('foreign_value')->nullable();
			$table->integer('foreign_id')->nullable();
			$table->string('foreign_table')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('system_upload');
	}

}
