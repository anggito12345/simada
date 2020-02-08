<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypePenanggungJawab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasColumn('penghapusan', 'penanggung_jawab')) {
            Schema::table('penghapusan', function (Blueprint $table) {
                $table->string('penanggung_jawab', 100);
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
        if (Schema::hasColumn('penghapusan', 'penanggung_jawab')) {
            Schema::table('penghapusan', function (Blueprint $table) {
                $table->integer(['penanggung_jawab']);
            });
        }
    }
}
