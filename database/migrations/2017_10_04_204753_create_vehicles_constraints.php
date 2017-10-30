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
                ->foreign('vehicle_color_uid')
                ->references('vehicle_color_uid')
                ->on('vehicles_colors')
                ->onDelete('cascade')->onUpdate('cascade');
            $table
                ->foreign('vehicle_model_uid')
                ->references('vehicle_model_uid')
                ->on('vehicles_models')
                ->onDelete('cascade')->onUpdate('cascade');
            $table
                ->foreign('vehicle_type_uid')
                ->references('vehicle_type_uid')
                ->on('vehicles_types')
                ->onDelete('cascade')->onUpdate('cascade');
            $table
                ->foreign('vehicle_brand_uid')
                ->references('vehicle_brand_uid')
                ->on('vehicles_brands')
                ->onDelete('cascade')->onUpdate('cascade');
            $table
                ->foreign('user_uid')
                ->references('user_uid')
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
            $table->dropForeign('vehicles_vehicle_color_uid_foreign');
            $table->dropForeign('vehicles_vehicle_model_uid_foreign');
            $table->dropForeign('vehicles_vehicle_type_uid_foreign');
            $table->dropForeign('vehicles_vehicle_brand_uid_foreign');
            $table->dropForeign('vehicles_user_uid_foreign');
        });
    }
}
