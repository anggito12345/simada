<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMAlamatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_alamat', function(Blueprint $table)
		{
			$table->bigIncrements('id', true);
			$table->integer('pid')->nullable();
			$table->string('nama')->nullable();
			$table->string('jenis')->nullable();
			$table->string('kodepos')->nullable();
			$table->date('updated_at')->nullable();
			$table->date('created_at')->nullable();
			$table->string('kode')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('m_alamat');
	}

}
