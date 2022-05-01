<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
        ALTER TABLE `friendship` ADD CONSTRAINT `fr_self_chk` CHECK (`friend` != `friend_to`);
SQL;

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sql = <<<SQL
        ALTER TABLE `friendship` DROP CONSTRAINT `fr_self_chk`;
SQL;
        DB::statement($sql);
    }
};
