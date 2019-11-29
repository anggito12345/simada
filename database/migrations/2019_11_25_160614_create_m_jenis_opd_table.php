<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMJenisOpdTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_jenis_opd', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama')->nullable();
			$table->integer('aktif')->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->integer('level')->nullable();
			$table->string('group')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('m_jenis_opd');
	}

}
