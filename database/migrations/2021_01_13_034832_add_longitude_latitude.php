<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLongitudeLatitude extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_alamat', function (Blueprint $table) {
            //
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
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
            $table->dropColumn("latitude");
            $table->dropColumn("longitude");
        });
    }
}
