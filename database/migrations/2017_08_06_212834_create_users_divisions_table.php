<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_divisions', function (Blueprint $table) {
            # Fields
            $table->bigIncrements('user_division_id');
            $table->char('user_division_description', 60);
            # Fields System
            $table->uuid('user_division_uid');
            $table->dateTime('user_division_created');
            $table->dateTime('user_division_updated');
            # Keys
            $table->unique('user_division_description');  
            $table->unique('user_division_uid'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_divisions');
    }
}
