<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Messaging;
use App\Auth;
use App\Http\Requests\MessagingRequest;

class MessagingController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }
    public function inbox() {
    	$user = Auth::User();
    	//get all the inbox messages
    	$messages = MessagingTransaction::where(['recipientID' => $user->id, 'messageFlag' => 'received']);
    	return view('messaging/inbox', compact('messages'));
    }
    public function outbox() {
    	$user = Auth::User();
    	$messages = MessagingTransaction::where(['recipientID' => $user->id, 'messageFlag' => 'sent']);
    	return view('messaging/outbox', compact('user'));
    }
    public function compose(MessagingRequest $request) {
        dd($request);
    }
}
