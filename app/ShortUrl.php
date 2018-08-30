<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $primaryKey = 'short';
    public $incrementing = false;
    protected $table = 'shorteners';
}
