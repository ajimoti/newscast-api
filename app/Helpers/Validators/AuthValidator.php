<?php

namespace App\Helpers\Validators;

class AuthValidator
{

    public function store()
    {
        return [
            'password'  => 'required|min:6',
            'email'     => 'required|email|unique:users',
            'username'  => 'unique:users'
        ];
    }

    public function verify()
    {
        return [
            'username_or_email' => 'required',
            'password'  => 'required|min:6'
        ];
    }

    public function update()
    {
        return [
            'password'  => 'required|min:6',
            'email'     => 'required|email|unique:users',
            'username'  => 'unique:users'
        ];
    }

}
