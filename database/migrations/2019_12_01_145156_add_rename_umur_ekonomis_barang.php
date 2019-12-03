<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRenameUmurEkonomisBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('m_barang', 'umur_ekononomis')) {

            Schema::table('m_barang', function (Blueprint $table) {
                //
                $table->dropColumn(['umur_ekononomis']);
            });
            Schema::table('m_barang', function (Blueprint $table) {
                //
                $table->integer('umur_ekonomis');
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
        Schema::table('m_barang', function (Blueprint $table) {
            //
        });
    }
}
