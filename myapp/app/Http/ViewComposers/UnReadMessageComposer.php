<?php 
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use Auth;
use App\MessagingTransaction;
/**
* 
*/
class UnReadMessageComposer
{
	
	function __construct()
	{
		# code...
	}
	public function compose(View $view) {
		$user = Auth::User();
		$message_counter =  MessagingTransaction::where('userID', $user->id)
            ->where('messageFlag', 'received')->where('readStatus', 0)
            ->count();
		$view->with('message_counter', $message_counter);
	}
}