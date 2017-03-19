<?php 
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use Auth;
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
		$user = Auth::User();
		$view->with('user', $user);
	}
}