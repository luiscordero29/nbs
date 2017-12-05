<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            # Fields
            $table->bigIncrements('role_id');
            $table->char('role_name', 60);
            $table->string('role_description')->nullable();
            # Fields System
            $table->uuid('role_uid');
            $table->dateTime('role_created');
            $table->dateTime('role_updated');
            # Keys
            $table->unique('role_name');  
            $table->unique('role_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
