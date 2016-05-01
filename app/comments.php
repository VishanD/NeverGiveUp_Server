<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $table = 'Comments';

    protected $fillable = [
        'comment_text',
        'pid',
        'user_id'
    ];
}
