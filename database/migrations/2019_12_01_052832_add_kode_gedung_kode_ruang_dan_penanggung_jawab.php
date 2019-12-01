<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKodeGedungKodeRuangDanPenanggungJawab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventaris', function (Blueprint $table) {
            //
            $table->string('kode_gedung',50)->nullable();
            $table->string('kode_ruang',50)->nullable();
            $table->integer('penanggung_jawab')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaris', function (Blueprint $table) {
            //
        });
    }
}
