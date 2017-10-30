<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    const CREATED_AT = 'vehicle_created';
    const UPDATED_AT = 'vehicle_updated';
    
    protected $table = 'vehicles';
    
    protected $primaryKey = 'vehicle_id';

    /**
     * Get the Vehicle record associated with the Test.
     */
    public function vehicle_brand()
    {
        return $this->hasOne('App\VehicleBrand', 'vehicle_brand_uid', 'vehicle_brand_uid');
    }

    /**
     * Get the Vehicle record associated with the Test.
     */
    public function vehicle_type()
    {
        return $this->hasOne('App\VehicleType', 'vehicle_type_uid', 'vehicle_type_uid');
    }

    /**
     * Get the Vehicle record associated with the Test.
     */
    public function vehicle_color()
    {
        return $this->hasOne('App\VehicleColor', 'vehicle_color_uid', 'vehicle_color_uid');
    }

    /**
     * Get the Vehicle record associated with the Test.
     */
    public function user()
    {
        return $this->hasOne('App\User', 'user_uid', 'user_uid');
    }
}
