<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class newNotification extends Model
{
    protected $table = 'newNotifications';

    protected $fillable = [
        'user_id',
        'notification_id',
        'read_status'
    ];
}
