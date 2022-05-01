<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigInteger('friend')->unsigned();
            $table->bigInteger('friend_to')->unsigned();

            $table->foreign('friend')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friend_to')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['friend', 'friend_to']);
        });
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
