<?php
		$mailerHost 		= MAILER_HOST;
		$mailerPort 		= MAILER_PORT;
		$mailerUser 		= MAILER_USER;
		$mailerPass 		= MAILER_PASS;
		$mailerSMTPSecure 	= MAILER_SMTPSecure;
		$mailerEmails 		= MAILER_EMAILS;
		$mailerCCEmails 	= MAILER_CC_EMAILS;
		$sendCC				= false;

		$to 	= ($recievers == null) ? $mailerEmails : $recievers;
		
		require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
		$mail = new PHPMailer(true);                                        // Passing `true` enables exceptions
		try {
			$mail->isSMTP();                                                // Set mailer to use SMTP
			$mail->SMTPDebug    = 0;                                        // (2)Enable, (0)Disable verbose debug output
			$mail->Host         = $mailerHost;                              // Specify main and backup SMTP servers
			$mail->SMTPAuth     = true;                                     // Enable SMTP authentication
			$mail->Username     = $mailerUser;                              // SMTP username
			$mail->Password     = $mailerPass;                              // SMTP password
			$mail->SMTPSecure   = $mailerSMTPSecure;                        // Enable TLS encryption, `ssl` also accepted
			$mail->Port         = $mailerPort;                              // TCP port to connect to
			
			// Load Recipients
			$mail->addCC('rambirhbti@gmail.com', 'Rambir Singh');

			// Load Cc Recipients
			if($sendCC==true){
				if(is_array($mailerCCEmails) && count($mailerCCEmails)>0){
					foreach ($mailerCCEmails as $key=>$value){
						$mail->addCC($value[0], $value[1]);
					}
				}
			}
			
			
			// Load Email Content & Body
			$mail->isHTML(true);
			$mail->setFrom($mailerUser, $mailTitle);
			$mail->Subject  = $mailSubject;
			$mail->Body     = $mailBody;
			$res = $mail->send();
			
			$mail->SmtpClose();
		} catch (Exception $e) {
			$res = $mail->ErrorInfo;
		}

		echo $res;
?>