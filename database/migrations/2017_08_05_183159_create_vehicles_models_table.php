<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_models', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            # Fields
            $table->bigIncrements('vehicle_model_id');
            $table->char('vehicle_model_name', 60);
            $table->text('vehicle_model_description')->nullable();
            # Foreign Key Constraints
            $table->uuid('vehicle_brand_uid')->nullable();
            # Fields System
            $table->uuid('vehicle_model_uid');
            $table->dateTime('vehicle_model_created');
            $table->dateTime('vehicle_model_updated');
            # Keys
            $table->unique('vehicle_model_name');  
            $table->unique('vehicle_model_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles_models');
    }
}
