<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePemanfaatanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pemanfaatan', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('pidinventaris')->nullable();
			$table->string('peruntukan')->nullable();
			$table->integer('umur')->nullable();
			$table->string('umur_satuan')->nullable();
			$table->string('no_perjanjian')->nullable();
			$table->date('tgl_mulai')->nullable();
			$table->date('tgl_akhir')->nullable();
			$table->integer('mitra')->nullable();
			$table->string('tipe_kontribusi')->nullable();
			$table->bigInteger('jumlah_kontribusi')->nullable();
			$table->integer('pegawai')->nullable();
			$table->char('aktif', 1)->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->integer('bagi_hasil')->nullable();
			$table->integer('tetap')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pemanfaatan');
	}

}
