<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingDimension extends Model
{
    const CREATED_AT = 'parking_dimension_created';
    const UPDATED_AT = 'parking_dimension_updated';
    
    protected $table = 'parkings_dimensions';
    
    protected $primaryKey = 'parking_dimension_id';
}
