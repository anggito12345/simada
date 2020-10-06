<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnFlagForInventarisImport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasColumn('inventaris', 'import_flag')) {
            //
            Schema::table('inventaris', function (Blueprint $table) {
                $table->string('import_flag', 150)->nullable();
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
        if (Schema::hasColumn('inventaris', 'import_flag')) {
            //
            Schema::table('inventaris', function (Blueprint $table) {
                $table->dropColumn('import_flag');
            });
        }
    }
}
