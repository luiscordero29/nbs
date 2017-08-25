<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            # Make
            #$table->increments('id');
            #$table->string('name');
            $table->char('email',160)->unique();
            $table->text('password');
            $table->rememberToken();
            $table->timestamps();
            # Fields
            $table->bigIncrements('user_id');
            $table->char('user_type_description', 60);
            $table->char('user_division_description', 60);
            $table->char('user_position_description', 60);
            $table->char('user_rol_name', 60);
            $table->char('user_firstname', 60);
            $table->char('user_lastname', 60);
            $table->binary('user_image')->nullable();
            $table->char('user_number_id',60);
            $table->char('user_number_employee',60);
            # Keys 
            $table->unique('user_number_id');
            $table->unique('user_number_employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
