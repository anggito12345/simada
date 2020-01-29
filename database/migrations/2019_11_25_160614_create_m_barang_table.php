<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMBarangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_barang', function(Blueprint $table)
		{
			$table->integer('id');
			$table->string('nama_rek_aset')->nullable();
			$table->smallInteger('umur_ekononomis')->nullable();
			$table->date('updated_at')->nullable();
			$table->date('created_at')->nullable();
			$table->string('kode_akun', 4)->nullable();
			$table->string('kode_kelompok', 4)->nullable();
			$table->string('kode_jenis', 4)->nullable();
			$table->string('kode_objek', 4)->nullable();
			$table->string('kode_rincian_objek', 4)->nullable();
			$table->string('kode_sub_rincian_objek', 4)->nullable();
			$table->string('kode_sub_sub_rincian_objek', 4)->nullable();
			$table->primary('id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('m_barang');
	}

}
