<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_brands', function (Blueprint $table) {
            # Fields
            $table->bigIncrements('vehicle_brand_id');
            $table->char('vehicle_brand_name', 60);
            $table->text('vehicle_brand_description')->nullable();
            $table->binary('vehicle_brand_logo')->nullable();
            # Foreign Key Constraints
            $table->uuid('vehicle_type_uid')->nullable();
            # Fields System
            $table->uuid('vehicle_brand_uid');
            $table->dateTime('vehicle_brand_created');
            $table->dateTime('vehicle_brand_updated');
            # Keys
            $table->unique('vehicle_brand_name');  
            $table->unique('vehicle_brand_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles_brands');
    }
}
