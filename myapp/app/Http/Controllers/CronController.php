<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GhLog;
use App\Http\EmailHelpers;

class CronController extends Controller
{
    //
    public function banUserWhoFailToPHAfterSuccessfulGH() {
    	//after gh u add to the table date, user set status to 1
    	//modify the table upon phing to reset status

    	//query that table to bring status = 1
    	//if current date > than the date plus 3days
    	//block user
    	$gh_logs = Ghlog::where('status = 1')->get();
    	$now = time();
    	$limit = $now - (3 * 24 * 60 * 60)
    	foreach($gh_logs as $log) {
    		if($log->ghDate > $limit) {
    			//send email reminder
    			$log->user->isBlocked = 1;
    			$log->user->points = 0;
    			$log->user->save();
    		}
    	}
    }
    public function sendEmailReminderBeforeDeadline() {
    	//query table to where status = 1
    	//if current date > than the date plus 1day
    	//send email
    	//if current date > thatn date plus 2 days send email
    	$gh_logs = Ghlog::where('status = 1')->get();
    	$now = time();
    	$onedayplus = $now - (24 * 60 * 60);
    	$twodayplus = $now - (2 * 24 * 60 * 60);
    	foreach($gh_logs as $log) {
    		if($log->ghDate > $onedayplus) {
    			//send email reminder
    			
    		}elseif($gh_logs > $twodayplus) {
    			//sendemailreminder

    		}
    		$email = new EmailHelpers($log->user, true);
    		$email->subject  = 'REMINDER NOTICE TO PH AFTER GHING ';
    		$email->MsgHTML = $this->getBody();
    		return $email->save();
    	}
    }
    public function blockUserWhoFailedToMeetPHDeadline() {
    	//we have to rematch the gh person
    	$gh_logs = Ghlog::where('status = 1')->get();
    	$now = time();
    	$onedayplus = $now - (24 * 60 * 60);
    	$twodayplus = $now - (2 * 24 * 60 * 60);
    	foreach($gh_logs as $log) {
    		if($log->ghDate > $onedayplus) {
    			//send email reminder
    			$email  = new EmailHelpers()
    		}elseif($gh_logs > $twodayplus) {
    			//sendemailreminder
    		}
    	}
    }
    //send email after u have been matched
    //rematch pple/manual matching
    //admin to gh without phing
}
