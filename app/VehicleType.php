<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    const CREATED_AT = 'vehicle_type_created';
    const UPDATED_AT = 'vehicle_type_updated';
    
    protected $table = 'vehicles_types';
    
    protected $primaryKey = 'vehicle_type_id';
}
