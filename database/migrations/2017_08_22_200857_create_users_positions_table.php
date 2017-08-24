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
            $table->engine = 'InnoDB';
            # Fields
            $table->bigIncrements('user_position_id');
            $table->char('user_position_description', 60);
            #Keys 
            $table->unique('user_position_description');  
        });

        Schema::table('users', function (Blueprint $table) {
            # Foreign Key Constraints
            $table
                ->foreign('user_position_description')
                ->references('user_position_description')
                ->on('users_positions')
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
        Schema::dropIfExists('users_positions');
    }
}
