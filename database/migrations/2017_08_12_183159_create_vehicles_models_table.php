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
            $table->char('vehicle_brand_name', 60);
            # Keys 
            $table->unique('vehicle_model_name');
        });

        Schema::table('vehicles_models', function (Blueprint $table) {
            # Foreign Key Constraints
            $table->foreign('vehicle_brand_name')->references('vehicle_brand_name')->on('vehicles_brands')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex('vehicles_vehicle_model_name_foreign');
        }); 

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex(['vehicle_model_name']);
        }); 

        Schema::dropIfExists('vehicles_models');
    }
}
