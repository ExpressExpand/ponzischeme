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
	public $to = array('famurewa_taiwo@yahoo.com', 'info@researchitlive.com');
	public $body;
	public $subject;
	public $attachment;

	/**
    * @author FAMUREWA TAIWO EZEKIEL
    * @return This returns an array that contains boolean and also the status error as a string
    */
    public function sendMail() {
		$mail = new \PHPMailer;
        $mail->SMTPOptions = array(
		    	'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);
		self::getSettings($mail);

		$mail->setFrom("admin@kickandfollow.com", "ResearchITLive");
        $mail->Subject = $this->subject;    
        $mail->MsgHTML($this->body);
        foreach ($this->to as $sender){
        	$mail->addAddress($sender, "");
        }
        
        if($this->attachment) {
        	// Attach the uploaded file
        	$mail->addAttachment($this->attachment, 'document');
        }
        

        $msg = [];
        if (!$mail->send()) {
            $msg = [false, "Mailer Error: " . $mail->ErrorInfo];
        } else {
            $msg = [true, ''];
        }
        return $msg;
	}
	private static function getSettings($mail) {
		$mail->isSMTP(); // tell to use smtp
    	// $mail->SMTPDebug = 2;
        $mail->CharSet = "utf-8"; // set charset to utf8
        $mail->SMTPAuth = true;  // use smpt auth
        $mail->SMTPSecure = "tls"; // or ssl
        $mail->Host = "mail.kickandfollow.com";
        $mail->Port = 25; // most likely something different for you. This is the mailtrap.io port i use for testing. 
        $mail->Username = "admin@kickandfollow.com";
        $mail->Password = "RaphSegun@123";
        
        return $mail;
	}
}