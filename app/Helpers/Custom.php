<?php
namespace App\Helpers;

use Carbon\Carbon;
use App\Models\User;
use Auth;

class Custom
{
    public static function getDateNow()
    {
        return Carbon::now()->toDateString();
    }
    
    public static function getAllUsers()
    {
        return User::get();
    }
}
