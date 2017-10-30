<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            # Fields
            $table->bigIncrements('vehicle_id');
            $table->char('vehicle_code', 8);
            $table->char('vehicle_name', 60)->nullable();
            $table->char('vehicle_year', 4)->nullable();
            $table->binary('vehicle_image')->nullable();
            $table->enum('vehicle_status', ['even', 'odd', 'does not apply']);
            # Foreign Key Constraints
            $table->uuid('user_uid');
            $table->uuid('vehicle_type_uid');
            $table->uuid('vehicle_brand_uid')->nullable();
            $table->uuid('vehicle_model_uid')->nullable();
            $table->uuid('vehicle_color_uid')->nullable();
            # Fields System
            $table->uuid('vehicle_uid');
            $table->dateTime('vehicle_created');
            $table->dateTime('vehicle_updated');
            # Keys
            $table->unique('vehicle_code');
            $table->unique('vehicle_uid');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::dropIfExists('vehicles');
    }
}
