<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\User;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function has_user()
    {
    	$data['user'] = Auth::user();
        $data['user'] = User::where('user_uid', $data['user']->user_uid)->first();
        if ($data['user']->role->role_name != 'user'){
            return false;
        }else{
            return true;
        }
    }

    public static function has_admin()
   	{
    	$data['user'] = Auth::user();
        $data['user'] = User::where('user_uid', $data['user']->user_uid)->first();
        if ($data['user']->role->role_name != 'admin'){
            return false;
        }else{
            return true;
        }
    }
}