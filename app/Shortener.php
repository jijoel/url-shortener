<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shortener extends Model
{
    protected $primaryKey = 'short';
    public $incrementing = false;
}
