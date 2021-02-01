<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnKodeBarangIdSensusAndImportFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('inventaris_history', function (Blueprint $table) {
            //
            $table->integer("id_sensus")->nullable();
            $table->string("kode_barang")->nullable();
            $table->string("import_flag")->nullable();
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
        Schema::table('inventaris_history', function (Blueprint $table) {
            //
            $table->dropColumn("id_sensus");
            $table->dropColumn("kode_barang");
            $table->dropColumn("import_flag");
        });
    }
}
