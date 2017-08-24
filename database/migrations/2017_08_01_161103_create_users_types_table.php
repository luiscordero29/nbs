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
            #Keys 
            $table->unique('user_type_description');  
        });

        Schema::table('users', function (Blueprint $table) {
            # Foreign Key Constraints
            $table
                ->foreign('user_type_description')
                ->references('user_type_description')
                ->on('users_types')
                ->onDelete('cascade')->onUpdate('cascade');
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
