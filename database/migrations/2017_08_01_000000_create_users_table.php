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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->text('password');
            $table->rememberToken();
            $table->timestamps();
            /*# Fields
            $table->bigIncrements('user_id');
            $table->bigInteger('user_type_id');
            $table->bigInteger('user_division_id');
            $table->char('user_firstname', 60);
            $table->char('user_lastname', 60);
            $table->string('user_email');
            $table->string('user_position');
            $table->binary('user_image')->nullable();
            $table->string('user_number_id');
            $table->string('user_number_employee');
            # Keys 
            #$table->primary('user_id');
            $table->unique('user_email');
            $table->unique('user_number_id');
            $table->unique('user_number_employee');
            # Foreign Key Constraints
            #$table->foreign('user_id')->references('user_id')->on('types_users')->onDelete('cascade');
            #$table->foreign('user_id')->references('user_id')->on('roles_users')->onDelete('cascade');
            #$table->foreign('user_id')->references('user_id')->on('vehicles_users')->onDelete('cascade');
            */
        });

        /*DB::table('users')->insert(
            [
                'name' => 'luis cordero',
                'email' => 'luis.cordero@webdiv.co',
                'password' => '$2y$10$lJ7fQktXBwrarVxYw4p/Fe.zuCQ8.UdaMDdJZXvV9mZbwkzHU/EB.',
            ]
        );*/
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
