<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerObservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_observation', function (Blueprint $table) {
            $table->integer('observation_id')->unsigned();
            $table->foreign('observation_id')
              ->references('id')->on('observation_format_user')
              ->onUpdate('cascade');

            $table->integer('answer_id')->unsigned();
            $table->foreign('answer_id')
              ->references('id')->on('answers')
              ->onUpdate('cascade');

            $table->primary(['observation_id', 'answer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answer_observation');
    }
}
