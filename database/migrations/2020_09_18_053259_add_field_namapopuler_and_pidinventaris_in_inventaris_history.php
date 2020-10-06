<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldNamapopulerAndPidinventarisInInventarisHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('inventaris_history')) {
            Schema::table('inventaris_history', function(Blueprint $table) {
                $table->string('nama_populer')->nullable();
                $table->integer('pidinventaris')->nullable();
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
        if(Schema::hasTable('inventaris_history')) {
            Schema::table('inventaris_history', function(Blueprint $table) {
                $table->dropColumn('nama_populer');
                $table->dropColumn('pidinventaris');
            });
        }
    }
}
