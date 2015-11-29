<?php

use Illuminate\Database\Migrations\Migration;

class CreateAnswerExamTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('answer_exam', function ($table) {
            $table->integer('exam_id')->unsigned();
            $table->foreign('exam_id')
              ->references('id')->on('exams')
              ->onUpdate('cascade');

            $table->integer('answer_id')->unsigned();
            $table->foreign('answer_id')
              ->references('id')->on('answers')
              ->onUpdate('cascade');

            $table->primary(['exam_id', 'answer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('answer_exam');
    }
}
