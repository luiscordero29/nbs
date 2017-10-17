<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    const CREATED_AT = 'reward_created';
    const UPDATED_AT = 'reward_updated';
    protected $table = 'rewards';
    protected $primaryKey = 'reward_id';
    protected $guarded = ['reward_id', 'reward_name', 'reward_ammount', 'reward_description', 'reward_uid', 'reward_created', 'reward_updated'];
}
