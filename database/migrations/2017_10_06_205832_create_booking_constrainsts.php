<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingConstrainsts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking', function (Blueprint $table) {
            # Foreign Key Constraints
            $table
                ->foreign('parking_uid')
                ->references('parking_uid')
                ->on('parkings')
                ->onDelete('cascade')->onUpdate('cascade');
            $table
                ->foreign('vehicle_uid')
                ->references('vehicle_uid')
                ->on('vehicles')
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
        Schema::table('booking', function (Blueprint $table) {
            # Foreign Key Constraints
            $table->dropForeign('booking_parking_uid_foreign');
            $table->dropForeign('booking_vehicle_uid_foreign');
        });
    }
}
