<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdbarangtargetColumnOnInventarisReklasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('inventaris_reklas', 'idbarangtarget')) {
            Schema::table('inventaris_reklas', function (Blueprint $table) {
                $table->dropColumn(['idbarangtarget']);
            });
        }

        Schema::table('inventaris_reklas', function (Blueprint $table) {
            $table->integer('idbarangtarget')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('inventaris_reklas', 'idbarangtarget')) {
            Schema::table('inventaris_reklas', function (Blueprint $table) {
                $table->dropColumn(['idbarangtarget']);
            });
        }
    }
}
