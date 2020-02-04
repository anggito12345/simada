<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusColumnOnReklasDetilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('reklas_detil', 'status')) {
            Schema::table('reklas_detil', function (Blueprint $table) {
                $table->dropColumn(['status']);
            });
        }

        Schema::table('reklas_detil', function (Blueprint $table) {
            $table->string('status', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('reklas_detil', 'status')) {
            Schema::table('reklas_detil', function (Blueprint $table) {
                $table->dropColumn(['status']);
            });
        }
    }
}
