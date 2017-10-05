<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles_brands', function (Blueprint $table) {
            # Foreign Key Constraints
            $table->foreign('vehicle_type_name')
                ->references('vehicle_type_name')
                ->on('vehicles_types')
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
        Schema::table('vehicles_brands', function (Blueprint $table) {
            # Foreign Key Constraints
            $table->dropForeign('vehicles_brands_vehicle_type_name_foreign');
        });
    }
}
