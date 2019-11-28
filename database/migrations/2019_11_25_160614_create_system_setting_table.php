<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystemSettingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_setting', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama')->nullable();
			$table->string('nilai')->nullable();
			$table->boolean('aktif')->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->string('type')->nullable();
			$table->integer('user_akses')->nullable();
			$table->boolean('editable')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('system_setting');
	}

}
