<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    const CREATED_AT = 'parking_created';
    const UPDATED_AT = 'parking_updated';
    
    protected $table = 'parkings';
    
    protected $primaryKey = 'parking_id';

    /**
     * Get the ParkingDimension record associated with the Test.
     */
    public function parking_dimension()
    {
        return $this->hasOne('App\ParkingDimension', 'parking_dimension_uid', 'parking_dimension_uid');
    }

    /**
     * Get the ParkingSection record associated with the Test.
     */
    public function parking_section()
    {
        return $this->hasOne('App\ParkingSection', 'parking_section_uid', 'parking_section_uid');
    }

    /**
     * Get the VehicleType record associated with the Test.
     */
    public function vehicle_type()
    {
        return $this->hasOne('App\VehicleType', 'vehicle_type_uid', 'vehicle_type_uid');
    }
}
