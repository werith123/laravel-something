<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class authController extends Controller
{

    function redirect(){
        return Socialite::driver('google')->redirect();
    }
    function callback(){

        $user = Socialite::driver('google')->user();
        $id = $user->id;
        $name = $user->name;
        $email = $user->email;

        $user = User::updateOrCreate(
            ['email', '=', $email],
            [
                'name', '<>', $name,
                'google_id', '<>', $id
            ]
            );
        
    }

}