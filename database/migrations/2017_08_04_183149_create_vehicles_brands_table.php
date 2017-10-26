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
            $table->engine = 'InnoDB';
            # Fields
            $table->bigIncrements('vehicle_brand_id');
            $table->char('vehicle_brand_name', 60);
            $table->text('vehicle_brand_description')->nullable();
            $table->binary('vehicle_brand_logo')->nullable();
            $table->char('vehicle_type_name', 60);
            # Keys 
            $table->unique('vehicle_brand_name');
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
