<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function( Blueprint $table ) {
            $table->engine = 'InnoDB';
            # Fields
            $table->bigIncrements('parking_id');
            $table->char('parking_name', 60);
            $table->text('parking_description')->nullable();
            $table->binary('parking_photo')->nullable();
            # Foreign Key Constraints
            $table->uuid('vehicle_type_uid');
            $table->uuid('parking_section_uid');
            $table->uuid('parking_dimension_uid')->nullable();
            # Fields System
            $table->uuid('parking_uid');
            $table->dateTime('parking_created');
            $table->dateTime('parking_updated');
            # Keys
            $table->unique('parking_name');  
            $table->unique('parking_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parkings');
    }
}
