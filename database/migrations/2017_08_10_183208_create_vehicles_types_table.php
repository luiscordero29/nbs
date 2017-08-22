<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_types', function (Blueprint $table) {
            # Fields
            $table->bigIncrements('vehicle_type_id');
            $table->char('vehicle_type_name', 60);
            $table->text('vehicle_type_description')->nullable();
            $table->binary('vehicle_type_icon')->nullable();
            # Keys 
            $table->unique('vehicle_type_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles_types');
    }
}
