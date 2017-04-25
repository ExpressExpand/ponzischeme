<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GhLog;
use App\Http\Helpers\EmailHelpers;
use App\DonationTransaction;
use App\DonationHelp;

class CronController extends Controller
{
    //
    public static function banUserWhoFailToPHAfterSuccessfulGH() {
    	//after gh u add to the table date, user set status to 1
    	//modify the table upon phing to reset status

    	//query that table to bring status = 1
    	//if current date > than the date plus 3days
    	//block user
    	$gh_logs = GhLog::where('status = 1')->get();
    	$now = time();
    	$limit = $now - (3 * 24 * 60 * 60);
    	foreach($gh_logs as $log) {
            if($log->user->hasRole('superadmin') || $log->user->hasRole('admin')) {
                continue;
            }
    		if($log->ghDate > $limit) {
    			//send email reminder
    			$log->user->isBlocked = 1;
    			$log->user->points = 0;
    			$log->user->save();

                echo $user->name . ' has been blocked';
    		}
    	}
        exit;
    }
    public static function sendEmailReminderBeforeDeadline() {
    	//query table to where status = 1
    	//if current date > than the date plus 1day
    	//send email
    	//if current date > thatn date plus 2 days send email
    	$gh_logs = GhLog::where('status = 1')->get();
        $now = time();
        $onedayplus = $now - (24 * 60 * 60);
        $twodayplus = $now - (2 * 24 * 60 * 60);
        $limit = $now - (3 * 24 * 60 * 60);
        foreach($gh_logs as $log) {
            if($log->ghDate > $onedayplus) {
                //send email reminder
                $email  = new EmailHelpers(null, $log->user, false);
                $email->subject = 'REMINDER NOTICE TO PROVIDE HELP';
                $email->setBody(self::getBody($log->user, $limit));
                $email->send();
                echo $user->name . 'has been sent a reminder for one day after ph';
            }elseif($gh_logs > $twodayplus) {
                //sendemailreminder
                $email  = new EmailHelpers(null, $log->user, false);
                $email->subject = 'REMINDER NOTICE TO PROVIDE HELP';
                $email->setBody(self::getBody($log->user, $limit));
                $email->send();
                echo $user->name . 'has been sent a reminder for two days after ph';
            }
        }
        exit;
    }
    public static function blockUserWhoFailedToMeetPHDeadline() {
    	//we have to rematch the gh person
    	$transactions = DonationTransaction::whereRaw('FROM_UNIXTIME(penaltyDate) < curdate()')
            ->where('receiverConfirmed', 0)->get();
        foreach($transactions as $transaction) {
            $transaction->donation->user->points = 0;
            $transaction->donation->user->isBlocked = 1;
            $transaction->donation->user->save();
        }
    }
    public static function getBody($user, $limit) {
        $body = spritnf('
            <h2>Hello %s,</h2>
            <p>This is to remind you that you need to provide help on http://easypayworldwide.com on or 
            before %s
             for your account to remain active.</p>
            <p>Your account will be suspended if you fail to provide help. Please note, this is so 
        in order to have a sustainable system</p><br />                
        <p>Regards,</p>
        <p>Mgt.</p>'
        , $user->name
        , date('M d, Y h:i:sa', $limit);
        return $body;
    }
    
    //rematch pple/manual matching
    //admin to gh without phing
}
