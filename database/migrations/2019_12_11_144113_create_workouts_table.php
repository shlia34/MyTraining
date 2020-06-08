<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->string('id', 34)->primary();
            $table->string('menu_id',34);
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');;
            $table->float('weight', 4, 1);
            $table->char('rep',2);
            $table->boolean('is_max');
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
        Schema::dropIfExists('workouts');
    }
}
