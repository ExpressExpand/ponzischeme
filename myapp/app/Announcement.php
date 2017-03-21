<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    public function author() {
    	return $this->belongsTo('App\user', 'userID');
    }
}
