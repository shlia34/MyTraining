<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->string('stage_id', 34)->primary();
            $table->string('name', 20);
            $table->char('part_code', 2);
            $table->char('pof_code', 2);
            $table->integer('sort_num')->unsigned();
            $table->string('memo', 200)->nullable();
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
        Schema::dropIfExists('stages');
    }
}
