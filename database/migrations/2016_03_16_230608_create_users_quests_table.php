<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersQuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_quests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quest_id');
            $table->foreign('quest_id')->references('id')->on('quests');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_quests');
    }
}
