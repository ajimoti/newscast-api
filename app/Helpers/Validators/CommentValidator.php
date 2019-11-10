<?php

namespace App\Helpers\Validators;

class CommentValidator
{
    public function store()
    {
        return [
            'username'      => 'exists:users,username|required',
            'post_slug'     => 'exists:posts,slug|required',
            'content'       => 'string|required',
            'ipaddress'     => 'ip|required',
            'country_code'   => 'string|required',
        ];
    }

}
