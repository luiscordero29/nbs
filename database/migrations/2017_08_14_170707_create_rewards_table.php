<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            # Fields 
            $table->bigIncrements('reward_id');
            $table->char('reward_name', 60);
            $table->text('reward_description')->nullable();
            $table->boolean('reward_status');
            $table->BigInteger('reward_ammount');
            # Fields System
            $table->uuid('reward_uid');
            $table->dateTime('reward_created');
            $table->dateTime('reward_updated');
            # Keys
            $table->unique('reward_name');
            $table->unique('reward_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards');
    }
}
