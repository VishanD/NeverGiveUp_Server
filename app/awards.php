<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class awards extends Model
{
    protected $table = "awards";

    protected $fillable = [
        'title',
        'description',
        'no_of_comments',
        'no_of_up_votes',
        'no_of_downvotes',
        'no_of_posts',
        'image'
    ];
}
