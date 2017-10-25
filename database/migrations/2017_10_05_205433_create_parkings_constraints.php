<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParkingsConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parkings', function (Blueprint $table) {
            # Foreign Key Constraints
            $table
                ->foreign('vehicle_type_name')
                ->references('vehicle_type_name')
                ->on('vehicles_types')
                ->onDelete('cascade')->onUpdate('cascade');
            $table
                ->foreign('parking_dimension_name')
                ->references('parking_dimension_name')
                ->on('parkings_dimensions')
                ->onDelete('cascade')->onUpdate('cascade');
            $table
                ->foreign('parking_section_name')
                ->references('parking_section_name')
                ->on('parkings_sections')
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
        Schema::table('parkings', function (Blueprint $table) {
            # Foreign Key Constraints
            $table->dropForeign('parkings_vehicle_type_name_foreign');
            $table->dropForeign('parkings_parking_dimension_name_foreign');
            $table->dropForeign('parkings_parking_section_name_foreign');
        });
    }
}
