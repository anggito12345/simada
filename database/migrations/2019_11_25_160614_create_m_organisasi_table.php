<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMOrganisasiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_organisasi', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pid')->nullable();
			$table->string('nama')->nullable();
			$table->string('alamat')->nullable();
			$table->integer('aktif')->nullable();
			$table->integer('setting')->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->string('kode')->nullable();
			$table->integer('level')->nullable();
			$table->string('jabatans')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('m_organisasi');
	}

}
