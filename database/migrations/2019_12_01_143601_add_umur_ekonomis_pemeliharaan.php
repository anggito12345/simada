<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUmurEkonomisPemeliharaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('pemeliharaan', 'umur_ekonomis')) {

            Schema::table('pemeliharaan', function (Blueprint $table) {
                //
                $table->dropColumn(['umur_ekonomis']);
            });
    
        }

        Schema::table('pemeliharaan', function (Blueprint $table) {
            //
            $table->integer('umur_ekonomis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemeliharaan', function (Blueprint $table) {
            //
        });
    }
}
