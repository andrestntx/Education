<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservationFormatUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observation_format_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('applied');
            $table->string('observation')->nullable();

            $table->integer('observation_format_id')->unsigned();
            $table->foreign('observation_format_id')->references('id')->on('observation_formats')->onUpdate('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');

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
        Schema::drop('observation_format_user');
    }
}
