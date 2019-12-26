<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Validators\AuthValidator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->user = new User;
        $this->validator = new AuthValidator;
    }

    public function register(Request $request)
    {

        $this->validate($request, $this->validator->register());

        $user = $this->user::create([
            'email'     => $request->get('email'),
            'username'  => $request->get('username'),
            'password'  => Hash::make($request->get('password')),
        ]);

        /**Take note of this: Your user authentication access token is generated here **/
        $token  =  $user->createToken(env('APP_NAME'))->accessToken;

        return sendJson("Account created successfully!", [
            'user'      => $user,
            'token'     => $token,
        ]);
    }

    public function authenticatedUser()
    {
        return sendJson("User detail", $this->user->detail());

    }

}
