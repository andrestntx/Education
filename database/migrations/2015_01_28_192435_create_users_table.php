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
		 Schema::create('user', function($table)
        {
            $table->increments('id');
            $table->string('username', 100)->unique();        
            $table->string('name', 100)->nullable()->unique();
            $table->string('email', 100)->nullable()->unique();
            $table->string('password', 255);
			$table->rememberToken();
			$table->timestamps();

			$table->integer('type_id')->unsigned()->nullable();
		    $table->foreign('type_id')->references('id')->on('user_types');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
	}

}
