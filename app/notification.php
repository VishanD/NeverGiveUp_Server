<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $table = 'Notifications';

    protected $fillable = [
        'message',
        'category'
    ];
}
