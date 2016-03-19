<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pergunta', 255);
            $table->string('resposta1', 255);
            $table->string('resposta2', 255);
            $table->string('resposta3', 255)->nullable();
            $table->string('resposta4', 255)->nullable();
            $table->string('resposta5', 255)->nullable();
            $table->smallInteger('correta'); // (1, 2, 3, 4, 5)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quizzs');
    }
}
