<?php 
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;
use App\Http\Helpers\AnalyticReports;
use Illuminate\Http\Request;

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
        $analytics = AnalyticReports::saveStats(request());
		$view->with(compact('analytics'));
	}
}