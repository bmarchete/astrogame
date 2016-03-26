<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProgresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_progres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            
            $table->string('user_id')->unsigned();
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
        Schema::drop('user_progres');
    }
}
