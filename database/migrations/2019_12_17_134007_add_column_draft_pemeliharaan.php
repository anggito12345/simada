<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDraftPemeliharaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('pemeliharaan', 'draft')) {

            Schema::table('pemeliharaan', function (Blueprint $table) {
                //
                $table->dropColumn(['draft']);
            });
    
        }

        Schema::table('pemeliharaan', function (Blueprint $table) {
            //
            $table->string('draft',1)->nullable();
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
