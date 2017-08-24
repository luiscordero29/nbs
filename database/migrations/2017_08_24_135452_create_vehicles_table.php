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
            $table->char('vehicle_name', 60);
            $table->char('vehicle_code', 8);
            $table->char('vehicle_year', 4);
            $table->binary('vehicle_image')->nullable();
            $table->enum('vehicle_status', ['yes', 'no']);
            $table->char('vehicle_model_name', 60);
            $table->char('color_name', 60);
            $table->string('user_number_id');
            #Keys 
            $table->unique('vehicle_code');  
        });

        Schema::table('vehicles', function (Blueprint $table) {
            # Foreign Key Constraints
            $table
                ->foreign('color_name')
                ->references('color_name')
                ->on('vehicles_colors')
                ->onDelete('no action')->onUpdate('cascade');
            $table
                ->foreign('vehicle_model_name')
                ->references('vehicle_model_name')
                ->on('vehicles_models')
                ->onDelete('no action')->onUpdate('cascade');
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
