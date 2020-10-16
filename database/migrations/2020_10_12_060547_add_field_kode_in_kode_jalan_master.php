<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldKodeInKodeJalanMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('m_kode_daerah')){
            Schema::create('m_kode_daerah', function(Blueprint $table)
            {
                $table->bigInteger('id', true);
                $table->string("kode")->nullable();
                $table->string("nama")->nullable();
                $table->date("created_at")->nullable();
                $table->date("updated_at")->nullable();
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
        Schema::drop('m_kode_daerah');
    }
}
