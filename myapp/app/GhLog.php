<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GhLog extends Model
{
    protected $table = 'gh_logs';
    protected $fillable = array('userID', 'ghDate', 'status');

    public function user() {
    	return $this->belongsTo('App\User', 'userID');
    }
    public function setGhDateAttribute() {
    	$this->getDate = time();
    }
    public function setStatusAttribute() {
    	$this->status = 1;
    }
    public function getGhDateAttribute($value) {
    	
    }

}
