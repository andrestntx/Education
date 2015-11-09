<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaExamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('area_exam', function($table)
		{
		    $table->integer('exam_id')->unsigned();
		    $table->foreign('exam_id')
		      ->references('id')->on('exams')
		      ->onUpdate('cascade');
	
			$table->integer('area_id')->unsigned();	    
		    $table->foreign('area_id')
		      ->references('id')->on('areas')
		      ->onUpdate('cascade');

		    $table->primary(['exam_id', 'area_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('area_exam');
	}
}
