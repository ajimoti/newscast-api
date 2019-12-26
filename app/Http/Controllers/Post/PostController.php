<?php

namespace App\Http\Controllers\Post;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Validators\PostValidator;

class PostController extends Controller
{

    public function __construct()
    {
        $this->user = new User;
        $this->post = new Post;
        $this->validator = new PostValidator;
    }

    public function store(Request $request)
    {
        $slug = defaultSlug($request->title);

        $this->validate($request, $this->validator->store());

        $user = $this->user->detail();

        $post = new \App\Models\Post([
            'slug'      => $slug,
            'title'     => $request->title,
            'content'   => $request->content,
            'ipaddress' => $request->ipaddress,
            'country'   => strtolower($request->country_code),
        ]);

        $result = $user->posts()->save($post);

        return sendJson("post saved successfully", $result);
    }

    public function show($slug)
    {
        $post   = $this->post->slug($slug)->firstOrFail();

        return sendJson("Post detail successfully gotten", $post);
    }

    public function update(Request $request, $slug)
    {
        $this->validate($request, $this->validator->update());

        $user = $this->user->detail();

        $post           = $this->post->slug($slug)->user($user->id)->firstOrFail();
        $post->title    = $request->title;
        $post->content  = $request->content;
        $post->save();

        return sendJson("Post update successful", $post);
    }

}
