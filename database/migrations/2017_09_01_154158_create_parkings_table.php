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
            $table->char('vehicle_type_name', 60);
            $table->char('parking_section_name', 60);
            $table->text('parking_description')->nullable();
            $table->char('parking_dimension_name', 60)->nullable();
            $table->binary('parking_photo')->nullable();
            #Keys 
            $table->unique('parking_name');
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
