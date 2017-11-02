<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingsSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings_sections', function( Blueprint $table ) {
            $table->engine = 'InnoDB';
            # Fields
            $table->bigIncrements('parking_section_id');
            $table->char('parking_section_name', 60);
            # Fields System
            $table->uuid('parking_section_uid');
            $table->dateTime('parking_section_created');
            $table->dateTime('parking_section_updated');
            # Keys
            $table->unique('parking_section_name');  
            $table->unique('parking_section_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parkings_sections');
    }
}
