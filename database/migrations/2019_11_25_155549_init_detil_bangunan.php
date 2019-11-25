<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitDetilBangunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detil_bangunan', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('pidinventaris');
            $table->string('konstruksi', 255);
            $table->string('bertingkat', 255);
            $table->string('beton', 255);
            $table->integer('luasbangunan');
            $table->string('alamat', 255);
            $table->integer('idkota');
            $table->integer('idkecamatan');
            $table->integer('idkelurahan');
            $table->string('koordinatlokasi', 1000);
            $table->string('koordinattanah', 2000);
            $table->date('tgldokumen');
            $table->string('nodokumen', 255);
            $table->integer('luastanah');
            $table->string('kodetanah', 255);
            $table->string('keterangan', 255);
            $table->date('created_at');
            $table->date('updated_at');
            $table->integer('statustanah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detil_bangunan', function (Blueprint $table) {
            //
        });
    }
}
