<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_colors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            # Fields
            $table->bigIncrements('vehicle_color_id');
            $table->char('vehicle_color_name', 60);
            # Fields System
            $table->uuid('vehicle_color_uid');
            $table->dateTime('vehicle_color_created');
            $table->dateTime('vehicle_color_updated');
            # Keys
            $table->unique('vehicle_color_name');
            $table->unique('vehicle_color_uid'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles_colors');
    }
}
