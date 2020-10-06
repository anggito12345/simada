<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('inventaris')) {
            Schema::table('inventaris', function(Blueprint $table) {
                $table->string('nama_populer')->nullable();
            });
        }

        //
        if(Schema::hasTable('detil_tanah')) {
            Schema::table('detil_tanah', function(Blueprint $table) {
                $table->integer('nilai_hub')->nullable();
                $table->string('tipe')->nullable();
            });
        }

        if(Schema::hasTable('detil_jalan')) {
            Schema::table('detil_jalan', function(Blueprint $table) {
                $table->integer('nilai_hub')->nullable();
                $table->string('tipe')->nullable();
                $table->string('kode_jalan')->nullable();
            });
        }

        if(Schema::hasTable('detil_bangunan')) {
            Schema::table('detil_bangunan', function(Blueprint $table) {
                $table->integer('nilai_hub')->nullable();
                $table->string('tipe')->nullable();
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
        if(Schema::hasTable('inventaris')) {
            Schema::table('inventaris', function(Blueprint $table) {
                $table->dropColumn('nama_populer');
            });
        }

        //
        if(Schema::hasTable('detil_tanah')) {
            Schema::table('detil_tanah', function(Blueprint $table) {
                $table->dropColumn('nilai_hub');
                $table->dropColumn('tipe');
            });
        }

        if(Schema::hasTable('detil_jalan')) {
            Schema::table('detil_jalan', function(Blueprint $table) {
                $table->dropColumn('nilai_hub');
                $table->dropColumn('tipe');
                $table->dropColumn('kode_jalan');
            });
        }

        if(Schema::hasTable('detil_bangunan')) {
            Schema::table('detil_bangunan', function(Blueprint $table) {
                $table->dropColumn('nilai_hub');
                $table->dropColumn('tipe');
            });
        }
    }
}
