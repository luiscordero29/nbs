<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles_models', function (Blueprint $table) {
            # Foreign Key Constraints
            $table->foreign('vehicle_brand_name')
                ->references('vehicle_brand_name')
                ->on('vehicles_brands')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles_models', function (Blueprint $table) {
            # Foreign Key Constraints
            $table->dropForeign('vehicles_models_vehicle_brand_name_foreign');
        });
    }
}
