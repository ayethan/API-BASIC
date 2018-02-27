<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegister;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\User;

class UserRegisterController extends Controller
{
    public function register(UserRegister $request)	
    {
    	$user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return new UserResource($user);

    }
}
