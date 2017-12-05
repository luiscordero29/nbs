<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            # Fields 
            $table->bigIncrements('test_id');
            $table->BigInteger('test_ammount');
            $table->date('test_date');
            $table->boolean('test_status');
            # Foreign Key Constraints
            $table->uuid('reward_uid');
            $table->uuid('user_uid');
            # Fields System
            $table->uuid('test_uid');
            $table->dateTime('test_created');
            $table->dateTime('test_updated');
            # Keys
            $table->unique('test_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
