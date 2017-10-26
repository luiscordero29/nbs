<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    const CREATED_AT = 'user_position_created';
    const UPDATED_AT = 'user_position_updated';
    
    protected $table = 'users_positions';
    
    protected $primaryKey = 'user_position_id';
}
