<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMJenisBarangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_jenis_barang', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nama')->nullable();
			$table->integer('aktif')->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->string('kode', 1)->nullable();
			$table->string('kelompok_kib', 2)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('m_jenis_barang');
	}

}
