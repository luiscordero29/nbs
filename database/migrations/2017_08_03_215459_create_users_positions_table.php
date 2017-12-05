<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_positions', function (Blueprint $table) {
            # Fields
            $table->bigIncrements('user_position_id');
            $table->char('user_position_description', 60);
            # Fields System
            $table->uuid('user_position_uid');
            $table->dateTime('user_position_created');
            $table->dateTime('user_position_updated');
            # Keys
            $table->unique('user_position_description');  
            $table->unique('user_position_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_positions');
    }
}
