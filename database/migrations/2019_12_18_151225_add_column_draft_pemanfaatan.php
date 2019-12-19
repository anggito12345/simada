<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDraftPemanfaatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('pemanfaatan', 'draft')) {

            Schema::table('pemanfaatan', function (Blueprint $table) {
                //
                $table->dropColumn(['draft']);
            });
    
        }

        Schema::table('pemanfaatan', function (Blueprint $table) {
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
        Schema::table('pemanfaatan', function (Blueprint $table) {
            //
        });
    }
}
