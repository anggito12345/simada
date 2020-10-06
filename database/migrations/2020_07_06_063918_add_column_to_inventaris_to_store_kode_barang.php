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
        if (!Schema::hasColumn('inventaris', 'kode_barang')) {
            Schema::table('inventaris', function (Blueprint $table) {
                //
                $table->string('kode_barang', 100)->nullable();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('inventaris', 'kode_barang')) {
            Schema::table('inventaris', function (Blueprint $table) {
                //
                $table->dropColumn('kode_barang');
            });
        }
    }
}
