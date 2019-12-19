<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIntegerIdToBigIntegerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('m_alamat', 'id')) {

            Schema::table('m_alamat', function (Blueprint $table) {
                //
                $table->dropColumn(['id']);
            });
    
        }

        Schema::table('m_alamat', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_alamat', function (Blueprint $table) {
            //
        });
    }
}
