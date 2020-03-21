<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullableIdHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasColumn('inventaris_history', 'id')) {
            Schema::table('inventaris_history', function (Blueprint $table) {
                $table->integer('id')->nullable()->change();                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        if (Schema::hasColumn('inventaris_history', 'id')) {
            Schema::table('inventaris_history', function (Blueprint $table) {
                $table->integer('id')->change();                
            });
        }
    }
}
