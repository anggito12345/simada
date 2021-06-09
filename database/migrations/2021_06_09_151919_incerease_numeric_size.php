<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncereaseNumericSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('inventaris', function (Blueprint $table) {
            //
            $table->decimal("harga_satuan", 25, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('inventaris', function (Blueprint $table) {
            //
            $table->decimal("harga_satuan", 15, 2)->change();
        });
    }
}
