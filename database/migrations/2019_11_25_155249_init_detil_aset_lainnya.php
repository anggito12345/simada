<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitDetilAsetLainnya extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detil_aset_lainnya', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('pidinventaris');
            $table->string('buku_judul', 255);
            $table->string('buku_spesifikasi', 255);
            $table->string('seni_asal', 255);
            $table->string('seni_pencipta', 255);
            $table->string('seni_bahan', 255);
            $table->string('ternak_jenis', 255);
            $table->string('ternak_ukuran', 255);
            $table->string('keterangan', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detil_aset_lainnya', function (Blueprint $table) {
            //
        });
    }
}
