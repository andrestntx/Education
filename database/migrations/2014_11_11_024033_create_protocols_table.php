<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('protocols', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 100);
		    $table->string('description', 250)->nullable();
		    $table->string('url_doc', 250)->nullable();
		    $table->boolean('aviable')->default(false)->nullable();
		    
		    $table->timestamps();

		    $table->integer('user_id')->unsigned();
		    $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
		      ;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('protocols');
	}

}
