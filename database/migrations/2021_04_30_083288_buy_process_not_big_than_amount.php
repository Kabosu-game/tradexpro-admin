<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuyProcessNotBigThanAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config('database.default') === 'sqlite') {
            // SQLite trigger syntax
            DB::unprepared('CREATE TRIGGER buy_process_not_big_than_amount
                          BEFORE UPDATE ON buys
                          FOR EACH ROW
                          WHEN NEW.processed > OLD.amount
                          BEGIN
                              SELECT RAISE(ABORT, \'Process Not Bigger than Amount\');
                          END;');
        } else {
            // MySQL trigger syntax
            DB::unprepared('CREATE TRIGGER buy_process_not_big_than_amount
                          BEFORE UPDATE ON buys
                          FOR EACH ROW
                          BEGIN
                            declare msg varchar(128);
                            if new.processed > OLD.amount then
                              set msg = concat(\'Process Not Bigger than Amount\');
                              signal sqlstate \'45000\' set message_text = msg;
                            end if;
                          END;');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS buy_process_not_big_than_amount');
    }
}
