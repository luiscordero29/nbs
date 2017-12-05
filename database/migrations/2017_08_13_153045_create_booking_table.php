<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function( Blueprint $table ) {
            # Fields
            $table->bigIncrements('booking_id');
            $table->date('booking_date');
            # Foreign Key Constraints
            $table->uuid('vehicle_uid');
            $table->uuid('parking_uid');
            # Fields System
            $table->uuid('booking_uid');
            $table->dateTime('booking_created');
            $table->dateTime('booking_updated');
            # Keys
            $table->unique('booking_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking');
    }
}
