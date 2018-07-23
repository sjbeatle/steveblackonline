<?
Header('Cache-Control: no-cache');
Header('Pragma: no-cache');

//initialize variables
$name = $_GET['name'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$contact = $_GET['contact'];
$type = $_GET['type'];
$othertype = $_GET['othertype'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$vname = $_GET['vname'];
$city = $_GET['city'];
$state = $_GET['state'];
$stime = $_GET['stime'];
$shalf = $_GET['shalf'];
$smeridian = $_GET['smeridian'];
$etime = $_GET['etime'];
$ehalf = $_GET['ehalf'];
$emeridian = $_GET['emeridian'];
$guest = $_GET['guest'];
$strMessage = "Name:".$name."\nEmail:".$email."\nphone:".$phone."\nBest time to contact:".$contact."\nEvent type:".$type."\nOther event type:".$othertype."\nEvent Date:".$month." ".$day.", ".$year."\nVenue:".$vname."\nCity:".$city."\nState:".$state."\nTime Start:".$stime.":".$shalf." ".$smeridian."\nTime End:".$etime.":".$ehalf." ".$emeridian."\nGuest Count:".$guest."\nHow did you hear about us?:".addslashes(urldecode(stripslashes($_GET['referral'])))."\nDetails & Special Requests:".addslashes(urldecode(stripslashes($_GET['details'])));

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "mail.myluckyinlove.com";
$mail->Port = 26;
$mail->Username = "dj@myluckyinlove.com";
$mail->Password = "dj@myluckyinlove.com";
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted

$mail->From = 'stevenjblack@gmail.com';
$mail->FromName = 'Steven Black';
$mail->addReplyTo('stevenjblack@gmail.com', 'Steven Black');

$mail->Subject = 'Contact Form Submission';
$mail->Body    = stripslashes($strMessage);
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


if(!$mail->send()) {
	print_r("0");
	//echo 'Message could not be sent.';
	//echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	print_r("1");
	//echo 'Message has been sent';
}
?>