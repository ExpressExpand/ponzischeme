<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messaging extends Model
{
    protected $table = 'messaging';
    protected $fillable = array('subject', 'body');
}
