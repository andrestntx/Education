<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 100);
		    $table->text('description')->nullable();	    

		    $table->integer('company_id')->unsigned();	    
		    $table->foreign('company_id')
		      ->references('id')->on('companies')
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
		Schema::drop('roles');
	}

}
