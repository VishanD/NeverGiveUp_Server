<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    protected $table = 'Posts';

    protected $fillable = [
        'upvotes',
        'downvotes',
        'user_id',
        'category',
        'postContent'
    ];
}
