<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeDraftInventaris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('inventaris', 'draft')) {

            Schema::table('inventaris', function (Blueprint $table) {
                //
                $table->dropColumn(['draft']);
            });
    
        }

        Schema::table('inventaris', function (Blueprint $table) {
            //
            $table->string('draft', 1)->nullable();
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
