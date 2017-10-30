<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleBrand extends Model
{
    const CREATED_AT = 'vehicle_brand_created';
    const UPDATED_AT = 'vehicle_brand_updated';
    
    protected $table = 'vehicles_brands';
    
    protected $primaryKey = 'vehicle_brand_id';

    /**
     * Get the VehicleType record associated with the Test.
     */
    public function vehicle_type()
    {
        return $this->hasOne('App\VehicleType', 'vehicle_type_uid', 'vehicle_type_uid');
    }
}
