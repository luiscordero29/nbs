<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDivision extends Model
{
    const CREATED_AT = 'user_division_created';
    const UPDATED_AT = 'user_division_updated';
    
    protected $table = 'users_divisions';
    
    protected $primaryKey = 'user_division_id';
}
