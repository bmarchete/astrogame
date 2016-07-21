<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->smallInteger('type')->default(1); // (1 = campanha / 2 = diária / 3 = semanal / 4 = mensal / 5 = exploração livre)
            $table->text('description');
            $table->text('objetivos');
            $table->text('recompensas');
            $table->integer('xp_reward');
            $table->integer('money_reward');
            $table->integer('min_level')->default(1);
            $table->integer('max_level')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quests');
    }
}
