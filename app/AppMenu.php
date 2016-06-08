<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppMenu extends Model
{
    protected $table = 'AppMenu';
    protected $fillable = ['menuname','applicationcode'];
}
