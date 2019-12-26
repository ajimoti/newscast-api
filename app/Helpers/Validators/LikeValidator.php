<?php

namespace App\Helpers\Validators;

class LikeValidator
{

    public function post()
    {
        return [
            'username'      => 'exists:users,username|required',
            'post_slug'     => 'exists:posts,slug|required'
        ];
    }

    public function comment()
    {
        return [
            'username'      => 'exists:users,username|required',
            'comment_id'     => 'exists:posts,slug|required'
        ];
    }


}
?>
