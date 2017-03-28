<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessagingTransaction extends Model
{
    protected $table = 'messaging_transactions';
    protected $fillable = array('messagingID', 'senderUserID', 'recipientUserID', 'readStatus', 'messageFlag');
}
