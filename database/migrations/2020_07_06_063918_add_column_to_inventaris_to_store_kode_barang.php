<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToInventarisToStoreKodeBarang extends Migration
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
            Schema::table('inventaris', function (Blueprint $table) {
                $table->string('kode_barang', 100)->nullable();             
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaris_to_store_kode_barang', function (Blueprint $table) {
            //
        });
    }
}
