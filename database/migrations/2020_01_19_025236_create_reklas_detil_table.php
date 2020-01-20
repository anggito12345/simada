<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReklasDetilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reklas_detil', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('idreklas');
            $table->integer('pidinventaris')->nullable();
            $table->integer('pidbarang_tujuan')->nullable();
            $table->date('updated_at')->nullable();
            $table->date('created_at')->nullable();
            
            $table->foreign('idreklas', 'reklas_detil_reklas')->references('id')->on('reklas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pidinventaris', 'reklas_detil_inventaris')->references('id')->on('inventaris')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('pidbarang_tujuan', 'reklas_detil_inventaris_tujuan')->references('id')->on('m_barang')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reklas_detil');
    }
}
