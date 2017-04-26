<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessagingTransaction extends Model
{
    protected $table = 'messaging_transactions';
    protected $fillable = array('messagingID', 'userID'
    	, 'readStatus', 'messageFlag');
    public function message() {
    	return $this->belongsTo('App\Messaging', 'messagingID');
    }
    public function user() {
    	return $this->belongsTo('App\User', 'userID');
    }
}
