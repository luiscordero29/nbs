<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    const CREATED_AT = 'vehicle_model_created';
    const UPDATED_AT = 'vehicle_model_updated';
    
    protected $table = 'vehicles_models';
    
    protected $primaryKey = 'vehicle_model_id';

    /**
     * Get the VehicleType record associated with the Test.
     */
    public function vehicle_brand()
    {
        return $this->hasOne('App\VehicleBrand', 'vehicle_brand_uid', 'vehicle_brand_uid');
    }
}
