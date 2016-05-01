<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'Category';

    // fillable is not needed as only one column is present
}
