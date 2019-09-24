<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class Dashboard extends Model
{
    public static function usersCount()
    {
        $usersCount = User::where('isAdmin',NULL)->count();

        return $usersCount;
    }
}
