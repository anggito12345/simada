<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveNomorSuratToPenghapusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasColumn('inventaris_penghapusan', 'nomor_surat_persetujuan_bpkad')) {

            Schema::table('inventaris_penghapusan', function (Blueprint $table) {
                //
                $table->dropColumn(['nomor_surat_persetujuan_bpkad']);
            });
            
        }

        if (Schema::hasColumn('penghapusan', 'nomor_surat_persetujuan_bpkad')) {

            Schema::table('penghapusan', function (Blueprint $table) {
                //
                $table->dropColumn(['nomor_surat_persetujuan_bpkad']);
            });
            
        }

        Schema::table('penghapusan', function (Blueprint $table) {
            //
            $table->string('nomor_surat_persetujuan_bpkad', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penghapusan', function (Blueprint $table) {
            //
        });
    }
}
