<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const CREATED_AT = 'user_created';
    const UPDATED_AT = 'user_updated';

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_firstname', 
        'user_lastname', 
        'user_email', 
        'password',
    ];

    protected $guarded = [
        'email', 
        'password', 
        'user_type_description', 
        'user_division_description', 
        'user_position_description', 
        'user_rol_name', 
        'user_firstname', 
        'user_lastname',
        'user_image',
        'user_number_id',
        'user_number_employee',
        'user_uid',
        'user_created',
        'user_updated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ]; 
}
