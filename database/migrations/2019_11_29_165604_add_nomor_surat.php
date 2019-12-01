<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNomorSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('inventaris_penghapusan', function (Blueprint $table) {
            //
            $table->dropColumn(['nomor_surat_persetujuan_bpkad']);
        });

        Schema::table('inventaris_penghapusan', function (Blueprint $table) {
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
        Schema::table('inventari_penghapusan', function (Blueprint $table) {
            //
        });
    }
}
