<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function($table)
		{
		    $table->increments('id');
		    $table->text('text');
		    $table->text('observation')->nullable();
		    $table->integer('value')->nullable();
		    $table->boolean('correct')->nullable();

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
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('answers');
	}

}
