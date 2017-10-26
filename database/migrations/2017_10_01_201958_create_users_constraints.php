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
                ->foreign('user_type_uid')
                ->references('user_type_uid')
                ->on('users_types')
                ->onDelete(DB::raw('set null'))
                ->onUpdate('cascade');
            $table
                ->foreign('user_position_uid')
                ->references('user_position_uid')
                ->on('users_positions')
                ->onDelete(DB::raw('set null'))
                ->onUpdate('cascade');
            $table
                ->foreign('user_division_uid')
                ->references('user_division_uid')
                ->on('users_divisions')
                ->onDelete(DB::raw('set null'))
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
            $table->dropForeign('users_user_type_uid_foreign');
            $table->dropForeign('users_user_position_uid_foreign');
            $table->dropForeign('users_user_division_uid_foreign');
        });
    }
}
