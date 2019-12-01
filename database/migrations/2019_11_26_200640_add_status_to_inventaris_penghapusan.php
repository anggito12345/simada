<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToInventarisPenghapusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventaris_penghapusan', function (Blueprint $table) {
            //
            $table->dropColumn(['status']);
        });

        Schema::table('inventaris_penghapusan', function (Blueprint $table) {
            //
            $table->string('status', 15)->if;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaris_penghapusan', function (Blueprint $table) {
            //
            
        });
    }
}
