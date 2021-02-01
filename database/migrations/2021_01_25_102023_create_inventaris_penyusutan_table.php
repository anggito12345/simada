<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventarisPenyusutanTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_penyusutan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('deskripsi', 150);
            $table->double('beban_penyusutan_perbulan');
            $table->integer('masa_manfaat_sd_akhir_tahun');
            $table->bigInteger('inventaris_id');
            $table->double('penyusutan_sd_tahun_sebelumnya');
            $table->date('running_penyesutan');
            $table->integer('running_sd_bulan');
            $table->double('penyusutan_tahun_sekarang');
            $table->double('penyusutan_sd_tahun_sekarang');
            $table->timestamps();
            $table->softDeletes();
            
        });

        Schema::table('inventaris_penyusutan', function (Blueprint $table) {
            $table->foreign('inventaris_id')->references('id')->on('inventaris')->onDelete('CASCADE')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventaris_penyusutan', function (Blueprint $table) {
            $table->dropForeign('inventaris_penyusutan_inventaris_id_foreign');
        });

        Schema::drop('inventaris_penyusutan');
    }
}
