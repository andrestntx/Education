<?php

use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('answers', function ($table) {
            $table->increments('id');
            $table->text('text');
            $table->text('observation')->nullable();
            $table->integer('value')->nullable();
            $table->boolean('correct')->default(false)->nullable();

            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')
              ->references('id')->on('questions')
              ->onUpdate('cascade')
              ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('answers');
    }
}
