<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToInventarisPenghapusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventaris_penghapusan', function (Blueprint $table) {
            $table->foreign('id', 'inventaris_penghapusan')->references('id')->on('inventaris')->onUpdate('RESTRICT')->onDelete('SET NULL');
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
            $table->dropForeign('inventaris_penghapusan');
        });
    }
}
