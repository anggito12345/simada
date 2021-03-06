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
        if (Schema::hasColumn('inventaris_penghapusan', 'status')) {
            
            Schema::table('inventaris_penghapusan', function (Blueprint $table) {
                //            
                $table->dropColumn(['status']);
            });
            
        }
        

        Schema::table('inventaris_penghapusan', function (Blueprint $table) {
            //
            $table->string('status', 15)->nullable();
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
