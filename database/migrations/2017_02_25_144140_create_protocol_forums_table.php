<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocol_forums', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('protocol_id')->unsigned();
            $table->foreign('protocol_id')
              ->references('id')->on('protocols')
              ->onUpdate('cascade');

            $table->text('comment');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
              ->references('id')->on('users')
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
        Schema::drop('protocol_forums');
    }
}
