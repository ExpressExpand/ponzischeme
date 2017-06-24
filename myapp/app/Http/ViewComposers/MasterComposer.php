<?php 
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;
use App\MessagingTransaction;
use App\Http\Helpers\AnalyticReports;
use Illuminate\Http\Request;
use App\Http\Helpers\AnalyticReports;
/**
* 
*/
class MasterComposer
{
	
	function __construct()
	{
		# code...
	}
	public function compose(View $view) {
		//show the analytics
        $analytics = AnalyticReports::saveStats(request());dd($analytics);
		$view->with(compact('analytics'));
	}
}