<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function($table)
		{
		    $table->increments('id');
		    $table->text('text');

		    $table->integer('question_type_id')->unsigned();	    
		    $table->foreign('question_type_id')
		      ->references('id')->on('question_types')
		      ->onUpdate('cascade');

		    $table->integer('exam_id')->unsigned();	    
		    $table->foreign('exam_id')
		      ->references('id')->on('exams')
		      ->onUpdate('cascade');

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
		Schema::drop('questions');
	}

}
