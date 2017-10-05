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
            $table->engine = 'InnoDB';
            # Fields
            $table->bigIncrements('booking_id');
            $table->date('booking_date');
            $table->char('parking_name', 60);
            $table->char('vehicle_code', 8);
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
