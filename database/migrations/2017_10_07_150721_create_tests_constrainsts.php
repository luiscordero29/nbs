<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsConstrainsts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tests', function(Blueprint $table) {
            # Foreign Key Constrainsts
            $table
                ->foreign('reward_uid')
                ->references('reward_uid')
                ->on('rewards')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreign('user_uid')
                ->references('user_uid')
                ->on('users')
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
        Schema::table('tests', function(Blueprint $table) {
            # Foreign Key Constrainsts
            $table->dropForeign('tests_reward_uid_foreign');
            $table->dropForeign('tests_user_uid_foreign');
        });
    }
}
