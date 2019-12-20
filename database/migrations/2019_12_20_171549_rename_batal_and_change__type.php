<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameBatalAndChangeType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumns('mutasi', ['batal'])) {

            Schema::table('mutasi', function (Blueprint $table) {
                //
                $table->dropColumn(['batal']);
            });
    
        }


        Schema::table('mutasi', function (Blueprint $table) {
            //
            $table->string('status', 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mutasi', function (Blueprint $table) {
            //
        });
    }
}
