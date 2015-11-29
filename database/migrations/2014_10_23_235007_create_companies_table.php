<?php

use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('companies', function ($table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->string('url_logo', 250)->nullable();

            $table->string('type', 20)->enum(['developer', 'customer'])->default('customer');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('companies');
    }
}
