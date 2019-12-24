<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedByColumnOnPemeliharanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('pemeliharaan', 'created_by')) {
            Schema::table('pemeliharaan', function (Blueprint $table) {
                $table->dropColumn(['created_by']);
            });
        }

        Schema::table('pemeliharaan', function (Blueprint $table) {
            $table->integer('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('pemeliharaan', 'created_by')) {
            Schema::table('pemeliharaan', function (Blueprint $table) {
                $table->dropColumn(['created_by']);
            });
        }
    }
}
