<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIsSensusInventarisTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(Schema::hasTable('inventaris')) {
            Schema::table('inventaris', function(Blueprint $table) {
                DB::statement('ALTER TABLE inventaris ALTER COLUMN
                        is_sensus TYPE integer USING (is_sensus::integer)');
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
        if(Schema::hasTable('inventaris')) {
            Schema::table('inventaris', function(Blueprint $table) {
                $table->string('is_sensus')->nullable()->change();
            });
        }
    }
}
