<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUserIdGeneratedProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generated_protocols', function (Blueprint $table) {
            //$table->dropForeign('generated_protocols_user_id_foreign');
            //$table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generated_protocols', function (Blueprint $table) {
            //$table->integer('user_id')->unsigned()->nullable();
            //$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }
}
