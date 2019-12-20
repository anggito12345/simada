<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnNotePembatalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumns('mutasi', ['cancel_note', 'batal'])) {

            Schema::table('mutasi', function (Blueprint $table) {
                //
                $table->dropColumn(['cancel_note', 'batal']);
            });
    
        }

        Schema::table('mutasi', function (Blueprint $table) {
            //
            $table->string('cancel_note', 500)->nullable();
            $table->boolean('batal')->nullable();
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
