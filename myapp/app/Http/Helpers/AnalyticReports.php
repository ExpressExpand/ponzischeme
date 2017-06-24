<?php 
namespace App\Http\Helpers;

use App\Analytic;
use Illuminate\Http\Request;

final class AnalyticReports {

	public static function saveStats(Request $request) {
		$analytics = new Analytic();
        $ip = $request->ip();

        if($ip == false || $ip == '127.0.0.1') {

        }else{
        	$data = file_get_contents('http://geoip.nekudo.com/api/'.$ip);
	        // $data = file_get_contents('http://freegeoip.net/json/'.$ip);
	        
	        $location = json_decode(html_entity_decode($data));
	        $analytics = Analytic::where(['ip' => $ip, 'path' => $request->url()])->first();
	        if(!$analytics) {
	        	$analytics = new Analytic();
	        }
	        $analytics->ip = $ip;
	        $analytics->country = $location->country->name;
	        $analytics->code = $location->country->code;
	        $analytics->city = $location->city;
	        $analytics->path = $request->url();
	        $analytics->latitude =$location->location->latitude;
	        $analytics->longitude = $location->location->longitude;
	        //save into the database
	        $analytics->save();
        }

	}
}