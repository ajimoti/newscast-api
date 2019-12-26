<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'country', 'ipaddress', 'slug', 'views', 'comments', 'likes',
        'shares'
    ];

     /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'user_id'
    ];


    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // All scopes start from here.
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

}
