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
        });
    }
}
