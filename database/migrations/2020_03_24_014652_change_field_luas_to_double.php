<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldLuasToDouble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('detil_tanah', 'luas')) {
            Schema::table('detil_tanah', function (Blueprint $table) {
                $table->float('luas')->nullable()->change();                
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
        if (Schema::hasColumn('detil_tanah', 'luas')) {
            Schema::table('detil_tanah', function (Blueprint $table) {
                $table->float('luas')->nullable()->change();                
            });
        }
    }
}
