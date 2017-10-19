<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingsDimensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings_dimensions', function( Blueprint $table ) {
            $table->engine = 'InnoDB';
            # Fields
            $table->bigIncrements('parking_dimension_id');
            $table->char('parking_dimension_name', 60);
            $table->char('parking_dimension_size', 30);
            $table->decimal('parking_dimension_long', 5, 2);
            $table->decimal('parking_dimension_height', 5, 2);
            $table->decimal('parking_dimension_width', 5, 2);
            $table->binary('parking_dimension_icon')->nullable();
            #Keys 
            $table->unique('parking_dimension_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parkings_dimensions');
    }
}
