<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHargaApprisalColumnOnInventarisPenghapusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('inventaris_penghapusan', 'harga_apprisal')) {
            Schema::table('inventaris_penghapusan', function (Blueprint $table) {
                $table->dropColumn(['harga_apprisal']);
            });
        }

        Schema::table('inventaris_penghapusan', function (Blueprint $table) {
            $table->bigInteger('harga_apprisal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('inventaris_penghapusan', 'harga_apprisal')) {
            Schema::table('inventaris_penghapusan', function (Blueprint $table) {
                $table->dropColumn(['harga_apprisal']);
            });
        }
    }
}
