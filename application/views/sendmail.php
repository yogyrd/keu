<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require base_url().'assets/PHPMailer/PHPMailerAutoload.php';

//$email = $_GET["email"];
//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
//$mail->SMTPDebug = 2;
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
//$mail->Host = 'smtp.gmail.com';
//$mail->Host = 'smtp.mail.yahoo.com';
$mail->Host = 'mail.mitramedicare.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
//$mail->Port = 587;
$mail->Port = 465;

//Set the encryption system to use - ssl (deprecated) or tls
//$mail->SMTPSecure = 'tls';
$mail->SMTPSecure = 'ssl';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "it@mitramedicare.com";

//Password to use for SMTP authentication
$mail->Password = "IT6ENU1n3";

//Set who the message is to be sent from
$mail->setFrom('it@mitramedicare.com', 'IT Mitra Medicare');

//Set an alternative reply-to address
//$mail->addReplyTo('it@mitramedicare.com', 'IT Mitra Medicare');

//Set who the message is to be sent to
$mail->addAddress('mitramedicare.it@gmail.com', 'Employee Name');

//Set the subject line
$mail->Subject = 'Tes Email';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(_FILE_));

//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
$mail->IsHTML(true);
$mail->Body='Follow this link for User Activation<br />
    <a href="http://www.xvcode.com/user_activate.php?email='.$_GET["email"].'">activate</a>
<br /><br />';

$mail->Send();

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
echo "<meta http-equiv='refresh' content='0; url=/keu'>";