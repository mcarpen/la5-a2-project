<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [ 'body', 'post_id'];

    public function create($array)
    {

    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
