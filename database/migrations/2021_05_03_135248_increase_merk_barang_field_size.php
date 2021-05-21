<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncreaseMerkBarangFieldSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('m_merk_barang', function (Blueprint $table) {
            //
            $table->string('nama', 1000)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('m_merk_barang', function (Blueprint $table) {
            //
            $table->string('nama', 200)->nullable()->change();
        });
    }
}
