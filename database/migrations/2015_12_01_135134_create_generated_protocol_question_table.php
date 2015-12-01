<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneratedProtocolQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generated_protocol_question', function (Blueprint $table) {

            $table->integer('protocol_id')->unsigned();
            $table->foreign('protocol_id')
              ->references('id')->on('generated_protocols')
              ->onUpdate('cascade');

            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')
              ->references('id')->on('questions')
              ->onUpdate('cascade');

            $table->text('answer');

            $table->primary(['protocol_id', 'question_id']);
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
        Schema::drop('generated_protocol_question');
    }
}
