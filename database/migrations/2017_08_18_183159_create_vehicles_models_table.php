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
            # Fields
            $table->bigIncrements('vehicle_model_id');
            $table->char('vehicle_model_name', 60);
            $table->text('vehicle_model_description')->nullable();
            $table->bigInteger('vehicle_brand_id');
            # Keys 
            #$table->primary('vehicle_model_id');
            $table->unique('vehicle_model_name');
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
