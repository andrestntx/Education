<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerResolvedExamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answer_resolved_exam', function($table)
		{
		    $table->integer('resolved_exam_id')->unsigned();
		    $table->foreign('resolved_exam_id')
		      ->references('id')->on('resolved_exams')
		      ->onUpdate('cascade');
	
			$table->integer('answer_id')->unsigned();	    
		    $table->foreign('answer_id')
		      ->references('id')->on('answers')
		      ->onUpdate('cascade');

		    $table->primary(['resolved_exam_id', 'answer_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('answer_resolved_exam');
	}

}
