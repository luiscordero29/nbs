<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_colors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            # Fields
            $table->bigIncrements('color_id');
            $table->char('color_name', 60);
            #Keys 
            $table->unique('color_name');  
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
            $table->dropIndex('vehicles_color_name_foreign');
        }); 

        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropIndex(['color_name']);
        }); 

        Schema::dropIfExists('vehicles_colors');
    }
}
