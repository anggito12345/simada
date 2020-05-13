<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAtOnTablePenggunaanKib extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasColumn('m_penggunaan', 'updated_at')) {
            Schema::table('m_penggunaan', function (Blueprint $table) {
                $table->date('updated_at');
            });
        }

        if (!Schema::hasColumn('m_penggunaan', 'created_at')) {
            Schema::table('m_penggunaan', function (Blueprint $table) {
                $table->date('created_at');
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
        if (Schema::hasColumn('m_penggunaan', 'created_at')) {
            Schema::table('m_penggunaan', function (Blueprint $table) {
                $table->dropColumn('created_at');
            });
        }

        if (Schema::hasColumn('m_penggunaan', 'updated_at')) {
            Schema::table('m_penggunaan', function (Blueprint $table) {
                $table->dropColumn('updated_at');
            });
        }

    }
}
