<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 100);
		    $table->string('url_logo', 250)->nullable();

		    $table->integer('type_id')->unsigned()->default(2);
		    $table->foreign('type_id')->references('id')->on('company_types');

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
		Schema::drop('companies');
	}

}

