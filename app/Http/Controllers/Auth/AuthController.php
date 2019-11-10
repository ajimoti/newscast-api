<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {

        $this->validate($request, $this->validator->store());

        $user = $this->user::create([
            'email'     => $request->get('email'),
            'username'  => $request->get('username'),
            'password'  => Hash::make($request->get('password')),
        ]);

        return sendJson("user added successfully", $user);
    }

    public function verify(Request $request)
    {
        $this->validate($request, $this->validator->verify());

        $password   = $request->get('password');
        $username_or_email      = $request->get('username_or_email');

        $user = $this->user::usernameOrEmail($username_or_email)->firstOrFail();

        if($user AND Hash::check($password, $user->password))
        {
            return sendJson("user data gotten", $user);
        }

        return abortJson(404, "User details incorrect");

    }

    public function userById($id)
    {
        $user = $this->user::firstOrFail($id);

        return sendJson("user data gotten", $user);
    }


    public function update(Request $request, $username)
    {
        $user = $this->user->username($username)->firstOrFail();

        $this->validateRequest($request);
        $user->email        = $request->get('email');
        $user->password     = Hash::make($request->get('password'));
        $user->save();

        return sendJson("The user with with id {$username} has been updated", $user);
    }

}
