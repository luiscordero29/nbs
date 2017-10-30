<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleColor extends Model
{
    const CREATED_AT = 'vehicle_color_created';
    const UPDATED_AT = 'vehicle_color_updated';
    
    protected $table = 'vehicles_colors';
    
    protected $primaryKey = 'vehicle_color_id';
}
