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

        Schema::table('vehicles', function (Blueprint $table) {
            # Foreign Key Constraints
            $table
                ->foreign('vehicle_color_name')
                ->references('vehicle_color_name')
                ->on('vehicles_colors')
                ->onDelete('cascade')->onUpdate('cascade');
            $table
                ->foreign('vehicle_model_name')
                ->references('vehicle_model_name')
                ->on('vehicles_models')
                ->onDelete('cascade')->onUpdate('cascade');
            $table
                ->foreign('vehicle_type_name')
                ->references('vehicle_type_name')
                ->on('vehicles_types')
                ->onDelete('cascade')->onUpdate('cascade');
            $table
                ->foreign('vehicle_brand_name')
                ->references('vehicle_brand_name')
                ->on('vehicles_brands')
                ->onDelete('cascade')->onUpdate('cascade');
            $table
                ->foreign('user_number_id')
                ->references('user_number_id')
                ->on('users')
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
        Schema::dropIfExists('vehicles');
    }
}
