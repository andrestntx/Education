<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_exam', function($table)
		{
		    $table->integer('exam_id')->unsigned();
		    $table->foreign('exam_id')
		      ->references('id')->on('exams')
		      ->onUpdate('cascade');
	
			$table->integer('role_id')->unsigned();	    
		    $table->foreign('role_id')
		      ->references('id')->on('roles')
		      ->onUpdate('cascade');

		    $table->primary(['exam_id', 'role_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('role_exam');
	}

}
