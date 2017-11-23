<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const CREATED_AT = 'role_created';
    const UPDATED_AT = 'role_updated';
    
    protected $table = 'roles';
    
    protected $primaryKey = 'role_id';
}
