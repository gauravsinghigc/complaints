<?php

//mailer starter
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/vendor/phpmailer/phpmailer/src/SMTP.php';

require __DIR__ . '/vendor/autoload.php';

//Send Mails
function SENDMAILS($Subject, $Title, $Sendto, $MAIL_MSG, $die = false)
{

  if (CONTROL_MAILS == true) {
    $mail = new PHPMailer(true);

    //Server settings
    if ($die == true) {
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
    }

    $mail->isSMTP();                                             //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                    //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
    $mail->Username   = 'noreply@navix.in';                     //SMTP username
    $mail->Password   = 'Navix@1800';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('noreply@navix.in', APP_NAME);
    $mail->addAddress("$Sendto");                                 //Add a recipient
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addBCC(DEVELOPER_SUPPORT_MAIL_ID);

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body = '
    <body>
    <style>
    .otp-section {padding: 0.5rem 0.5rem !important;font-size: 2.5rem !important;letter-spacing: 5px !important;box-shadow: 0px 0px 1px grey !important;border-radius: 1rem  !important;background-color: #ffffff00 !important;font-weight: 600 !important;}
    </style>
    <div style="padding: 1rem !important; background-color: rgb(245, 244, 244) !important; font-family: Verdana, Geneva, Tahoma, sans-serif !important; border-radius:20px !important;box-shadow:0px 0px 7px grey !important; font-weight:300 !important; color:#333 !important;">
    <h2 style="margin-bottom: 1px !important;background-image: repeating-linear-gradient(45deg, #0000001c, transparent 1px);padding: 0.5rem;border-radius: 42px;padding-left: 1rem;font-size: 16px!important;color: #3a3939!important;font-weight: 600;">
    <img src="https://www.pinclipart.com/picdir/big/185-1850576_png-file-white-bell-notification-icon-transparent-clipart.png" style="width: 1rem !important;margin-top: 1px !important;padding-top: 0.5%;">
    </h2>
    <div style="padding:1rem !important;">
    <img src="' . MAIN_LOGO . '" style="width:30%;">
      <h1 style="font-weight:400 !important;">' . APP_NAME . '</h1>
      <h3 style="color:black !important; font-weight:400 !important;">' . $Title . '</h3>
      <p style="text-decoration:none !important; color: grey !important;font-size:13px;font-weight:300 !important;">' . $MAIL_MSG . '</p>
      <br><br><br>
     <p>
        <span>TEAM ' . APP_NAME . '</span><br>
        <span style="color:grey !important; font-size:13px;font-weight:300 !important;">' . SECURE(PRIMARY_ADDRESS, "d") . '</span><br>
        <span style="text-decoration:none !important; color: grey !important;font-size:13px;font-weight:300 !important;">' . PRIMARY_EMAIL . '</span>
        <span style="text-decoration:none !important; color: grey !important;font-size:13px;font-weight:300 !important;">| ' . PRIMARY_PHONE . '</span><br>
        <span style="text-decoration:none !important; color: grey !important;font-size:13px;font-weight:300 !important;">| ' . DOMAIN . '</span>
      </p>
      <br>
    </div>
   <p style="font-size:11px !important; color:grey !important; font-weight:300 !important;">
      <b>Note: </b> This is an auto generated mail. do not reply this. if you find something incorrect then forward this at ' . REPLY_TO . '
   </p>
</body>';

    //send response
    if ($mail->send() == true) {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
}
