<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterluasbangunanToDouble extends Migration
{
    public function __construct()
    {
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE detil_bangunan ALTER COLUMN luasbangunan TYPE DOUBLE PRECISION');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE detil_bangunan ALTER COLUMN luasbangunan TYPE integer');
    }
}
