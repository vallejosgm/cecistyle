<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	include_once('includes/PHPmailer/src/PHPMailer.php');
	include_once('includes/PHPmailer/src/Exception.php');
	include_once('includes/PHPmailer/src/SMTP.php');
	include_once('includes/PHPmailer/src/PHPMailer.php');
	include_once('includes/PHPmailer/src/Exception.php');
	include_once('includes/PHPmailer/src/SMTP.php');
	require 'includes/phpmailer/src/PHPMailer.php';
	require 'includes/phpmailer/src/Exception.php';
	require 'includes/phpmailer/src/SMTP.php';
	
	function sendmail($to, $fn){
		
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);
		
		    //Server settings
		    #$mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;                     
		    $mail->IsSMTP();              					              
		    $mail->SMTPAuth   = false;   
		    $mail->Port       = 25;  
		    $mail->Host       = 'localhost';   		
		    $mail->Username   = 'info@cecistyle.org';     
		    $mail->Password   = 'UBw8z[f?k[tQ';  

		    #$mail->IsSendMail();

		    #$mail->SMTPSecure = 'tls';          
		    #$mail->SMTPAutoTLS = false;
		                                    
		    
		    //Recipients
		    $mail->From = 'info@cecistyle.org';
		    $mail->FromName = "CeciStyle Alterations";
		    $mail->AddAddress($to);     //Add a recipient
		    #$mail->addAddress('ellen@example.com');               //Name is optional
		    #$mail->addReplyTo('info@example.com', 'Information');
		    #$mail->addCC('cecistylealterations@gmail.com');
		    #$mail->addBCC('bcc@example.com');

		    //Attachments
		    #$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		    //Content
		    #$mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = 'CeciStyle Alterations - Appointment Reminder';
		    $mail->WordWrap = 80;

			$mail->MsgHTML('<p>This is the HTML message body test <b>CeciStyle Alterations!</b></p>');
		    $mail->IsHTML(true);
		    #$mail->Body    = 'This is the HTML message body test <b>Ceci\'Style Alterations!</b>';
		    #$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    if(!$mail->Send()) {
		    	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";	
		    	return false;
		    } else {
		    	echo 'Message has been sent';
		    	return true;
		    }  
		
	}
?>