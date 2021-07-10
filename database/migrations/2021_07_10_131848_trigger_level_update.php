<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class TriggerLevelUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::beginTransaction();

        try {
            DB::statement("
            CREATE OR REPLACE FUNCTION trigger_proc_level_update()
            RETURNS trigger AS \$emp_stamp\$
            DECLARE
                newroleid integer;
                record_user record;
                cursor_user refcursor;
                query_user varchar(150);
            BEGIN
                RAISE NOTICE 'Start procedure level_update(new_level integer)';
                newroleid := (SELECT id FROM roles where level = NEW.level);

                query_user := 'select * from users where pid_organisasi = $1';

                OPEN cursor_user FOR EXECUTE query_user using NEW.id;

                loop
                    fetch cursor_user into record_user;
                    EXIT WHEN NOT FOUND;

                    UPDATE model_has_roles SET role_id = newroleid WHERE model_id = record_user.id;
                end loop;

                RETURN NEW;
            END
            \$emp_stamp\$ language plpgsql
            ");

            DB::statement("
            DROP TRIGGER level_update ON m_organisasi;
            CREATE TRIGGER level_update
                AFTER UPDATE ON m_organisasi
                FOR EACH ROW
                WHEN (OLD.level IS DISTINCT FROM NEW.level)
                EXECUTE PROCEDURE trigger_proc_level_update();
            ");
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
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
        DB::beginTransaction();

        try {
            DB::statement("
            DROP FUNCTION trigger_proc_level_update()
            ");

            DB::statement("
            DROP TRIGGER level_update ON m_organisasi;
            ");
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
