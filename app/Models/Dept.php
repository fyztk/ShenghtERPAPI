<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    protected $fillable = [
        'deptname', 'created_id'
    ];

    protected $hidden = [

    ];
}
