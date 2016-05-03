<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userCategory extends Model
{
    protected $table = 'userCategory';

    protected $fillable = [
        'user_id',
        'category'
    ];
}
