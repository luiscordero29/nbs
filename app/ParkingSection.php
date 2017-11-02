<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingSection extends Model
{
    const CREATED_AT = 'parking_section_created';
    const UPDATED_AT = 'parking_section_updated';
    
    protected $table = 'parkings_sections';
    
    protected $primaryKey = 'parking_section_id';
}
