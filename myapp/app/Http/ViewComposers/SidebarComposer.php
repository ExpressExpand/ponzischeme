<?php 
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use Auth;
use App\MessagingTransaction;
use App\Http\Helpers\AnalyticReports;

/**
* 
*/
class SidebarComposer
{
	
	function __construct()
	{
		# code...
	}
	public function compose(View $view) {
		//show the analytics
        AnalyticReports::saveStats($request);

		$user = Auth::User();
		//get the message
		$messages = array();
    	$messages = MessagingTransaction::where(
    		['userID'=> $user->id, 'messageFlag'=> 'received'])->where('readStatus', 0)
    		->take(5)->latest()->get();
		$view->with(compact('user', 'messages'));
	}
}