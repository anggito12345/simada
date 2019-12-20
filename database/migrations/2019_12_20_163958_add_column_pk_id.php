<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPkId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumns('inventaris_mutasi', ['idpk'])) {

            Schema::table('inventaris_mutasi', function (Blueprint $table) {
                //
                $table->dropColumn(['idpk']);
            });
    
        }


        Schema::table('inventaris_mutasi', function (Blueprint $table) {
            //
            $table->bigIncrements('idpk', true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaris_mutasi', function (Blueprint $table) {
            //
        });
    }
}
