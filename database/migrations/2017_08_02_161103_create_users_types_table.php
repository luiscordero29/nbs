<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_types', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            # Fields
            $table->bigIncrements('user_type_id');
            $table->char('user_type_description', 60);
            # Fields System
            $table->uuid('user_type_uid');
            $table->dateTime('user_type_created');
            $table->dateTime('user_type_updated');
            # Keys
            $table->unique('user_type_description');  
            $table->unique('user_type_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        Schema::dropIfExists('users_types');
    }
}
