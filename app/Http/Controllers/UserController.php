<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return false|string
     */
    public function login()
    {
        $credentials = [
            'email' => 'admin@gmail.com',
            'password' => '123456'
        ];
        if(Auth::attempt($credentials))
        {
            return json_encode("logged in");
        } else {
            return json_encode("unauthorized");
        }
    }

    /**
     * @return false|string
     */
    public function logout()
    {
        if(Auth::check()) {
            Auth::logout();
            return json_encode("user logged out");
        }
        else {
            return json_encode("user does not log in");
        }

    }

    /**
     * @param $userID
     * @return false|string
     */
    public function showPermission($userID)
    {
        $user = User::findOrFail($userID);
        if(is_null($user)) {
            dd("user not found");


        }
        $permissions =  $user->getAllPermissions();
        $permissions_list = array();
        foreach($permissions as $item)
        {
            array_push($permissions_list, $item->name);
        }
        return json_encode($permissions_list);

    }


    public function testPermission()
    {
        dd("User has permission");
    }
}
