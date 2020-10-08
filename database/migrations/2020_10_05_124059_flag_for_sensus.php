<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FlagForSensus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(Schema::hasTable('inventaris')) {
            Schema::table('inventaris', function(Blueprint $table) {
                $table->string('is_sensus')->nullable();
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
        //
        if(Schema::hasTable('inventaris')) {
            Schema::table('inventaris', function(Blueprint $table) {
                $table->dropColumn('is_sensus');
            });
        }
    }
}
