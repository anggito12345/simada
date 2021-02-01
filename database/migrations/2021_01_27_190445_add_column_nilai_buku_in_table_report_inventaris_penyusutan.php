<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnNilaiBukuInTableReportInventarisPenyusutan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('report_inventaris_penyusutan', function (Blueprint $table) {
            //
            $table->double('nilai_buku');
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
            $table->dropColumn('nilai_buku');
        });
    }
}
