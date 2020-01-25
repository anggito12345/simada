<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKoreksiDetilsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koreksi_detil', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idkoreksi');
            $table->integer('pidinventaris')->nullable();
            $table->bigInteger('harga_satuan_lama')->nullable();
            $table->bigInteger('harga_satuan_baru')->nullable();
            $table->date('updated_at')->nullable();
            $table->date('created_at')->nullable();

            $table->foreign('idkoreksi', 'koreksi_detil_koreksi')->references('id')->on('koreksi')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pidinventaris', 'koreksi_detil_inventaris')->references('id')->on('inventaris')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('koreksi_detil');
    }
}
