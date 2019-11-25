<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name');
			$table->string('email')->unique();
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('nip')->nullable();
			$table->string('no_hp', 20)->nullable();
			$table->date('tgl_lahir')->nullable();
			$table->char('jenis_kelamin', 1)->nullable();
			$table->integer('pid_organisasi')->nullable();
			$table->integer('role')->nullable();
			$table->string('username', 15)->nullable();
			$table->char('aktif', 1)->nullable();
			$table->string('email_verification_code', 150)->nullable();
			$table->integer('jabatan')->nullable();
			$table->string('api_token', 80)->nullable();
			$table->string('email_forgot_password', 150)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
