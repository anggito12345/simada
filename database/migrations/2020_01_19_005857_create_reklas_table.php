<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReklasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reklas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nosurat')->nullable();
            $table->date('tglsurat')->nullable();
            $table->string('nosurat_persetujuan')->nullable();
            $table->date('tglsurat_persetujuan')->nullable();
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
        Schema::drop('reklas');
    }
}
