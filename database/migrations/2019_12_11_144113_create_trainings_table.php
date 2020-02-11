<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //todo weightとrepを数字に変えた方がよかったのではないか
        Schema::create('trainings', function (Blueprint $table) {
            $table->string('training_id', 34)->primary();
            $table->string('event_id',34);
            $table->foreign('event_id')->references('event_id')->on('events');
            $table->char('stage_code', 5);
            $table->float('weight', 4, 1);
            $table->char('rep',2);
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
        Schema::dropIfExists('trainings');
    }
}
