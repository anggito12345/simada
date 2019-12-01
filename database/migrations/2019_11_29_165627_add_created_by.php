<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penghapusan', function (Blueprint $table) {
            //
            $table->dropColumn(['created_by']);
        });

        Schema::table('penghapusan', function (Blueprint $table) {
            //
            $table->integer('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penghapusan', function (Blueprint $table) {
            //
        });
    }
}
