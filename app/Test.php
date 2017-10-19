<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    const CREATED_AT = 'test_created';
    const UPDATED_AT = 'test_updated';
    
    protected $table = 'tests';
    
    protected $primaryKey = 'test_id';


    /**
     * Get the Reward record associated with the Test.
     */
    public function reward()
    {
        return $this->hasOne('App\Reward', 'reward_uid', 'reward_uid');
    }

    /**
     * Get the User record associated with the Test.
     */
    public function user()
    {
        return $this->hasOne('App\User', 'user_uid', 'user_uid');
    }
}
