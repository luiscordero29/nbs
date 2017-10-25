<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        Schema::table('vehicles', function (Blueprint $table) {
            # Foreign Key Constraints
            $table->dropForeign('vehicles_vehicle_color_name_foreign');
            $table->dropForeign('vehicles_vehicle_model_name_foreign');
            $table->dropForeign('vehicles_vehicle_type_name_foreign');
            $table->dropForeign('vehicles_vehicle_brand_name_foreign');
            $table->dropForeign('vehicles_user_number_id_foreign');
        });
    }
}
