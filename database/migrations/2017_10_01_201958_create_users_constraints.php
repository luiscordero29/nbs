<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            # Foreign Key Constraints
            $table
                ->foreign('user_type_description')
                ->references('user_type_description')
                ->on('users_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreign('user_position_description')
                ->references('user_position_description')
                ->on('users_positions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreign('user_division_description')
                ->references('user_division_description')
                ->on('users_divisions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
            # Foreign Key Constraints
            $table->dropForeign('users_user_type_description_foreign');
            $table->dropForeign('users_user_position_description_foreign');
            $table->dropForeign('users_user_division_description_foreign');
        });
    }
}
