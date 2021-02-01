<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTypoColumnNameRunningPenyesutanInTableInventarisPenyusutan extends Migration
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
            $table->renameColumn('running_penyesutan', 'running_penyusutan');
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
            $table->renameColumn('running_penyusutan', 'running_penyesutan');
        });
    }
}
