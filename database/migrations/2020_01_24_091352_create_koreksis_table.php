<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKoreksisTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koreksi', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tglkoreksi')->nullable();
            $table->string('draft', '1')->nullable();
            $table->integer('created_by')->nullable();
            $table->date('updated_at')->nullable();
            $table->date('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('koreksi');
    }
}
