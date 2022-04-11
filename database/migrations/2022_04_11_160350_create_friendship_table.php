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
        Schema::create('friendship', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('first_friend')->unsigned();
            $table->bigInteger('second_friend')->unsigned();

            $table->foreign('first_friend')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('second_friend')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['first_friend', 'second_friend']);
        });

        DB::statement('ALTER TABLE `friendship` ADD CONSTRAINT `chk_friendship_consistency` CHECK (`first_friend` < `second_friend`);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friendship');
    }
};
