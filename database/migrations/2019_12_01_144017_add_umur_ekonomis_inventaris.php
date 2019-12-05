<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUmurEkonomisInventaris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('inventaris', 'umur_ekonomis')) {

            Schema::table('inventaris', function (Blueprint $table) {
                //
                $table->dropColumn(['umur_ekonomis']);
            });
    
        }

        Schema::table('inventaris', function (Blueprint $table) {
            //
            $table->integer('umur_ekonomis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaris', function (Blueprint $table) {
            //
        });
    }
}
