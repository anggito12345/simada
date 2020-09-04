<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInventarisSensus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasColumn('inventaris_sensus', 'status_approval')) {
            Schema::table('inventaris_sensus', function (Blueprint $table) {
                $table->string('status_approval' , 10);
            });
        }

        if (!Schema::hasColumn('inventaris_sensus', 'created_by')) {
            Schema::table('inventaris_sensus', function (Blueprint $table) {
                $table->integer('created_by');
            });
        }

        if (!Schema::hasColumn('inventaris_sensus', 'status_ubah_satuan')) {
            Schema::table('inventaris_sensus', function (Blueprint $table) {
                $table->integer('status_ubah_satuan');
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
        //
        if (Schema::hasColumn('inventaris_sensus', 'status_approval')) {
            Schema::table('inventaris_sensus', function (Blueprint $table) {
                $table->drop('status_approval' , 10);
            });
        }

        if (Schema::hasColumn('inventaris_sensus', 'created_by')) {
            Schema::table('inventaris_sensus', function (Blueprint $table) {
                $table->drop('created_by');
            });
        }

        if (Schema::hasColumn('inventaris_sensus', 'status_ubah_satuan')) {
            Schema::table('inventaris_sensus', function (Blueprint $table) {
                $table->drop('status_ubah_satuan');
            });
        }
    }
}
