<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMMitraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_mitra', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('npwp')->nullable();
			$table->string('siup_tdp')->nullable();
			$table->string('nama')->nullable();
			$table->string('alamat')->nullable();
			$table->string('telp')->nullable();
			$table->string('email')->nullable();
			$table->string('jenis_usaha')->nullable();
			$table->string('pic')->nullable();
			$table->string('jabatan_pic')->nullable();
			$table->string('hp_pic')->nullable();
			$table->string('email_pic')->nullable();
			$table->integer('aktf')->nullable();
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
		Schema::drop('m_mitra');
	}

}
