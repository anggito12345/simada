<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTglPerolehanInHistoryReklasMutasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventaris_mutasi', function (Blueprint $table) {
            //
            $table->date('tgl_perolehan')->nullable();
        });

        Schema::table('inventaris_history', function (Blueprint $table) {
            //
            $table->date('tgl_perolehan')->nullable();
        });

        Schema::table('inventaris_reklas', function (Blueprint $table) {
            //
            $table->date('tgl_perolehan')->nullable();
        });
       
        Schema::table('inventaris_penghapusan', function (Blueprint $table) {
            //
            $table->date('tgl_perolehan')->nullable();
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
            $table->dropColumn('tgl_perolehan');
        });

        Schema::table('inventaris_history', function (Blueprint $table) {
            //
            $table->dropColumn('tgl_perolehan');
        });

        Schema::table('inventaris_reklas', function (Blueprint $table) {
            //
            $table->dropColumn('tgl_perolehan');
        });

        Schema::table('inventaris_penghapusan', function (Blueprint $table) {
            //
            $table->dropColumn('tgl_perolehan');
        });
    }
}
