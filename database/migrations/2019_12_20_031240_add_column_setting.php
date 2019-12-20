<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if (Schema::hasColumn('m_organisasi', 'setting')) {

            Schema::table('m_organisasi', function (Blueprint $table) {
                //
                $table->dropColumn(['setting']);
            });
    
        }


        Schema::table('m_organisasi', function (Blueprint $table) {
            //
            $table->integer('setting')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_organisasi', function (Blueprint $table) {
            //
        });
    }
}
