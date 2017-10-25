<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    const CREATED_AT = 'user_type_created';
    const UPDATED_AT = 'user_type_updated';
    
    protected $table = 'users_types';
    
    protected $primaryKey = 'user_type_id';
}
