<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\User;

class UserServiceProvider extends ServiceProvider
{
    public static function create($data){
        $user = new User($data);
        $user->password = \Hash::make($data["password"]);
        $user->save();

        return $user;
    }

    public static function edit(User $user,$data){
        $user->fill($data);

        if(isset($data["password"]) && $data["password"]){
            $user->password = \Hash::make($data["password"]);
        }
        $user->save();
    }   
}
