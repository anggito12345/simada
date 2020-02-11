<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreateColumnPenghapusanStep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('penghapusan', 'nomor_berita_acara')) {
            Schema::table('penghapusan', function (Blueprint $table) {
                $table->dropColumn(['nomor_berita_acara']);
                $table->dropColumn(['tglba']);
                $table->dropColumn(['tglsp']);
            });
        }

        Schema::table('penghapusan', function (Blueprint $table) {
            $table->string('nomor_berita_acara')->nullable();
            $table->date('tglba')->nullable();
            $table->date('tglsp')->nullable();
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
