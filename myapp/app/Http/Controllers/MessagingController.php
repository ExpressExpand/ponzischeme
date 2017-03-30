<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Messaging;
use Auth;
use App\User;
use App\Http\Requests\MessagingRequest;
use App\MessagingTransaction;
use Session;

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
    public function compose(Request $request) {
        return view('messaging/compose');
    }
     public function sendMessage(MessagingRequest $request) {
        $user = Auth::User();
        $inputs = $request->all();
        //get all the users
        $users = User::where('isBlocked', 0)->get();
        $messaging = Messaging::create($inputs);
        //get the transactions
        foreach($users as $u) {
            if($u->hasRole(['admin', 'superadmin'])) {
                $transaction = new MessagingTransaction();
                $transaction->messagingID = $messaging->id;
                $transaction->userID = $u->id;
                $transaction->messageFlag = 'received';
                $transaction->save();    
            }
            
        }
        $transaction = new MessagingTransaction();
        $transaction->messagingID = $messaging->id;
        $transaction->userID = $user->id;
        $transaction->messageFlag = 'sent';
        $transaction->save();

        Session::flash('flash_message', 'Successul. The support team will get back to you');
        return redirect()->back();
    }
}
