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
            $table->char('vehicle_type_name', 60);
            $table->char('vehicle_brand_name', 60)->nullable();
            $table->char('vehicle_model_name', 60)->nullable();
            $table->char('vehicle_name', 60)->nullable();
            $table->char('vehicle_year', 4)->nullable();
            $table->char('vehicle_color_name', 60)->nullable();
            $table->char('user_number_id',60);
            $table->binary('vehicle_image')->nullable();
            $table->enum('vehicle_status', ['even', 'odd', 'does not apply']);
            #Keys 
            $table->unique('vehicle_code');  
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
