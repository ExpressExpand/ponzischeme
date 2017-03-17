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

final class EmailHelpers {
	public $to = array('famurewa_taiwo@yahoo.com', 'maxteetechnologies@gmail.com');
	public $body;
	public $subject;
	public $attachment;
    public $from;

	/**
    * @author FAMUREWA TAIWO EZEKIEL
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
	private static function getSettings($mail) {
		$mail->isSMTP(); // tell to use smtp
    	// $mail->SMTPDebug = 2;
        $mail->CharSet = "utf-8"; // set charset to utf8
        $mail->SMTPAuth = true;  // use smpt auth
        $mail->SMTPSecure = "tls";//env('EMAILHELPER_SMTP'); // or ssl
        $mail->Host = "mail.kickandfollow.com";//env('EMAILHELPER_HOST');
        $mail->Port = 25; // most likely something different for you. This is the mailtrap.io port i use for testing. 
        $mail->Username = "admin@kickandfollow.com";//env('EMAILHELPER_USERNAME');
        $mail->Password = "RaphSegun@123";//env('EMAILHELPER_PASSWORD');
        
        return $mail;
	}
}