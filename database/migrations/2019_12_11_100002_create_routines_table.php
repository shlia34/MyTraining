<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->string('id', 34)->primary();
            $table->string('user_id', 34);
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('exercise_id', 34);
            $table->foreign('exercise_id')->references('id')->on('exercises');
            $table->integer('sort_no')->unsigned();
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
        Schema::dropIfExists('routines');
    }
}
