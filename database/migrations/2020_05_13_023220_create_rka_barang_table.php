<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRkaBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rka_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_organisasi')->nullable();
            $table->string('nama_organisasi')->nullable();
            $table->string('tahun_rka')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->integer('jumlah')->nullable();
            $table->float('harga_satuan')->nullable();
            $table->float('nilai')->nullable();
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('rka_barang');
    }
}
