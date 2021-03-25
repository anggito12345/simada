<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostgisColumnEachDetilInventaris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('ALTER TABLE detil_tanah ADD COLUMN geom geometry(Polygon,4326);');
        DB::statement('ALTER TABLE detil_konstruksi ADD COLUMN geom geometry(Polygon,4326);');
        DB::statement('ALTER TABLE detil_bangunan ADD COLUMN geom geometry(Polygon,4326);');
        DB::statement('ALTER TABLE detil_jalan ADD COLUMN geom geometry(Polygon,4326);');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::statement('ALTER TABLE detil_tanah DROP COLUMN geom;');
        DB::statement('ALTER TABLE detil_konstruksi DROP COLUMN geom;');
        DB::statement('ALTER TABLE detil_bangunan DROP COLUMN geom;');
        DB::statement('ALTER TABLE detil_jalan DROP COLUMN geom;');
    }
}
