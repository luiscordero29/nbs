<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    const CREATED_AT = 'booking_created';
    const UPDATED_AT = 'booking_updated';
    
    protected $table = 'booking';
    
    protected $primaryKey = 'booking_id';
}
