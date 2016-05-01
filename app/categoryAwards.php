<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoryAwards extends Model
{
    protected $table = 'CategoryAwards';

    protected $fillable = [
        'award_id',
        'category'
    ];
}
