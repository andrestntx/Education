<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('links', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 45);
		    $table->text('description')->nullable();
		    $table->text('url');

		    $table->integer('protocol_id')->unsigned();	    
		    $table->foreign('protocol_id')
		      ->references('id')->on('protocols')
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
		Schema::drop('links');
	}

}
