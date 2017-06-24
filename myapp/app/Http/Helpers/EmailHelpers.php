<?php 

//usage
//send email
// $email = new EmailHelpers();
// $email->to = $senders;
// $email->subject = $input['subject'];
// $email->body = $input['body'];
// if($filename && strlen($filename)) {
//     $email->attachemnt = $image;
// }
// $msg = $email->sendMail();

namespace App\Http\Helpers;
use Config;

final class EmailHelpers {
	public $to = array('famurewa_taiwo@yahoo.com', 'maxteetechnologies@gmail.com');
	public $body;
	public $subject;
	public $attachment;
    public $from;
    private $recipient;
    private $sender;
    private $is_admin = false;
    public $debug = true;

    public function __construct($sender=null, $recipient, $is_admin = false) {
        $this->is_admin = $is_admin;
        $this->sender = $sender;
        $this->recipient = $recipient;
    }
	/**
    * @author me
    * @return This returns an array that contains boolean and also the status error as a string
    */
    public function setSubject($subject) {
        $this->subject = $subject;
        return $this;
    }
    public function setBody($body) {
        $this->body = $body;
        return $this;
    }
    public function setFrom($from) {
        $this->from = $from;
        return $this;
    }
    private function initializeMail() {
        $mail = new \PHPMailer;
        $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail = self::getSettings($mail);
        return $mail;
    }
    public function sendMail() {
        $mail = $this->initializeMail();
		$mail->setFrom("admin@kickandfollow.com", "ResearchITLive");
        $mail->subject = $this->subject;    
        $mail->MsgHTML($this->body);
        foreach ($this->to as $sender){
        	$mail->addAddress($sender, "");
        }
        
        if($this->attachment) {
        	// Attach the uploaded file
        	$mail->addAttachment($this->attachment, 'document');
        }
        
        if (!$mail->send()) {
            throw new Exception("Mailer Error: " . $mail->ErrorInfo);
        } else {
            return true;
        }
        return false;
	}
    //admin sending the email
    public function send() {
        $mail = $this->initializeMail();
        $mail->subject = $this->subject;    
        $mail->MsgHTML($this->body);
        if($this->is_admin) {
            //send email to the admin
            $mail->setFrom($this->sender->email, $this->sender->name);
            $mail->addAddress(Config::get('app.EMAILHELPER_USERNAME'), env('EMAILHELPER_ADMIN_NAME'));
        }else{
            $mail->addAddress($this->recipient->email, $this->recipient->name);
            $mail->setFrom(Config::get('app.EMAILHELPER_USERNAME'), env('EMAILHELPER_ADMIN_NAME'));
            dd(Config::get('app.EMAILHELPER_USERNAME'));
        }dd($mail);
        $mail->send();
        return $mail;
    }
	private static function getSettings($mail) {
		// $mail->isSMTP(); // tell to use smtp
        // $mail->SMTPDebug = 3;

        $mail->CharSet = "utf-8"; // set charset to utf8
        $mail->SMTPAuth = true;  // use smpt auth
        $mail->SMTPSecure = 'ssl';//env('EMAILHELPER_SMTP', 'tls'); // or ssl
        $mail->SMTPAutoTLS = false;
        $mail->Host = Config::get('app.EMAILHELPER_HOST');
        $mail->Port = Config::get('app.EMAILHELPER_PORT'); 
        $mail->Username = Config::get('app.EMAILHELPER_USERNAME');
        $mail->Password = Config::get('app.EMAILHELPER_PASSWORD');

        return $mail;
	}
}