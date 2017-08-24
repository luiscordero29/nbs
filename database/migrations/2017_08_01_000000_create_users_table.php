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
            $table->string('email')->unique();
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
            $table->string('user_number_id');
            $table->string('user_number_employee');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_user_type_description_foreign');
            $table->dropIndex('users_user_position_description_foreign');
            $table->dropIndex('users_user_division_description_foreign');
            $table->dropIndex('users_user_rol_name_foreign');
        }); 

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['user_type_description']);
            $table->dropIndex(['user_position_description']);
            $table->dropIndex(['user_division_description']);
            $table->dropIndex(['user_rol_name']);
        }); 

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex('vehicles_user_number_id_foreign');
        }); 

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex(['user_number_id']);
        });

        Schema::dropIfExists('users');
    }
}
