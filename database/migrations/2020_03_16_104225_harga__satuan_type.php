<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HargaSatuanType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasColumn('inventaris', 'harga_satuan')) {
            Schema::table('inventaris', function (Blueprint $table) {
                $table->decimal('harga_satuan', 15, 2)->change();                
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
        if (Schema::hasColumn('inventaris', 'harga_satuan')) {

            Schema::table('inventaris', function (Blueprint $table) {
                $table->bigInteger('harga_satuan')->change();
                
            });
        }
    }
}
