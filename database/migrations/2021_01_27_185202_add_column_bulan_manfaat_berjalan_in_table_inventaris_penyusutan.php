<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBulanManfaatBerjalanInTableInventarisPenyusutan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventaris_penyusutan', function (Blueprint $table) {
            $table->integer('bulan_manfaat_berjalan');
            $table->rename('report_inventaris_penyusutan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_inventaris_penyusutan', function (Blueprint $table) {
            //
            $table->dropColumn('bulan_manfaat_berjalan');
            $table->rename('inventaris_penyusutan');
        });
    }
}
