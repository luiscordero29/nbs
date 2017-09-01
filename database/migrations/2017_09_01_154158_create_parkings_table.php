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
            $table->text('parking_description');
            $table->char('vehicle_type_name', 60);
            $table->char('parking_dimension_name', 60);
            $table->char('parking_section_name', 60);
            $table->binary('parking_photo')->nullable();
            #Keys 
            $table->unique('parking_name');
        });

        Schema::table('parkings', function (Blueprint $table) {
            # Foreign Key Constraints
            $table
                ->foreign('vehicle_type_name')
                ->references('vehicle_type_name')
                ->on('vehicles_types')
                ->onDelete('no action')->onUpdate('cascade');
            $table
                ->foreign('parking_dimension_name')
                ->references('parking_dimension_name')
                ->on('parkings_dimensions')
                ->onDelete('no action')->onUpdate('cascade');
            $table
                ->foreign('parking_section_name')
                ->references('parking_section_name')
                ->on('parkings_sections')
                ->onDelete('no action')->onUpdate('cascade');
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
