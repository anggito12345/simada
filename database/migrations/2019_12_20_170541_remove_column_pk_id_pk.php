<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnPkIdPk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasColumns('inventaris_mutasi', ['idpk', 'id_pk'])) {

            Schema::table('inventaris_mutasi', function (Blueprint $table) {
                //
                $table->dropColumn(['idpk', 'id_pk']);
            });
    
        }

        Schema::table('inventaris_mutasi', function (Blueprint $table) {
            //
            $table->bigIncrements('id_pk',true);
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
