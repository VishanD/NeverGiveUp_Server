<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class app_users extends Model
{
    protected $table = "app_users";

    protected $fillable = [
        'name',
        'email',
        'date_of_birth',
        'password',
        'profile_picture',
        'fb_profile_id',
    ];

    /*protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];*/
}
