<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProtocolTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_protocol', function($table)
		{
		    $table->integer('protocol_id')->unsigned();
		    $table->foreign('protocol_id')->references('id')->on('protocols')->onUpdate('cascade');
	
			$table->integer('category_id')->unsigned();	    
		    $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');

		    $table->primary(['protocol_id', 'category_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_protocol');
	}

}
