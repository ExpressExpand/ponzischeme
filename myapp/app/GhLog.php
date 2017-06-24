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
    // public function setGhDateAttribute() {
    // 	$this->ghDate = time();
    // }
    public function getGhDateAttribute($value) {
    	
    }

}
