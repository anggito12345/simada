<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitAlamat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_alamat', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('pid');
            $table->string('nama', 255);
            $table->string('jenis', 255);
            $table->string('kodepos', 255);
            $table->date('updated_at');
            $table->date('created_at');
            $table->string('kode', 25);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_alamat', function (Blueprint $table) {
            //
        });
    }
}
