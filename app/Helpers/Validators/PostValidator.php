<?php

namespace App\Helpers\Validators;

class PostValidator
{

    public function store()
    {
        return [
            'title'     => 'required',
            'content'   => 'required',
            'ipaddress'   => 'required',
            'country_code'   => 'required',
        ];
    }

    public function update()
    {
        return [
            'username'  => 'exists:users|required'
        ];
    }

}
