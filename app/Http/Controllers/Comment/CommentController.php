<?php

namespace App\Http\Controllers\Comment;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Validators\CommentValidator;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->user = new User;
        $this->post = new Post;
        $this->comment = new Comment;
        $this->validator = new CommentValidator;
    }

    public function store(Request $request)
    {

        $this->validate($request, $this->validator->store());
        $user = $this->user->username($request->username)->firstOrFail();
        $post = $this->post->slug($request->post_slug)->firstOrFail();

        $comment = new \App\Models\Comment([
            'post_id'   => $post->id,
            'content'   => $request->content,
            'ipaddress' => $request->ipaddress,
            'country_code'   => strtolower($request->country_code),
        ]);

        $result = $user->comments()->save($comment);

        return sendJson("Comment saved successfully", $result);

    }

    public function showById($id)
    {
        $comment   = $this->comment->find($id)->firstOrFail();

        return sendJson("Comment detail successfully gotten", $comment);
    }

}
