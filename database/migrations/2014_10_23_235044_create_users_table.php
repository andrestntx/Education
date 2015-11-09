<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->string('username', 100)->unique();        
            $table->string('name', 100)->nullable()->unique();
            $table->string('email', 100)->nullable()->unique();
            $table->string('password', 255);

            $table->string('url_photo', 255)->nullable();

			$table->string('type',20)->enum(['superadmin', 'admin', 'registred']);

		    $table->integer('company_id')->unsigned();
		    $table->foreign('company_id')->references('id')->on('companies');

		    $table->rememberToken();
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
		Schema::drop('users');
	}

}
