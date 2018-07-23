<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Steve Black - Web Development and Graphic Design - Contact</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<?php $page="contact"; ?>
<script type="text/javascript">
	<!--	
	function sendEmail(strName, strEmail, strPhone, strContact, strType, strOther, strDetails)
	{ 
		if (!strName || !strEmail || !strDetails)
		{
			var strErrorMessage = "<ul>";
			if (!strName) { strErrorMessage = strErrorMessage + "<li><strong>Name</strong> is missing</li>"; }
			if (!strEmail) { strErrorMessage = strErrorMessage + "<li><strong>Email</strong> is missing</li>"; }
			if (!strDetails) { strErrorMessage = strErrorMessage + "<li><strong>Details</strong> are missing</li>"; }
			strErrorMessage = strErrorMessage + "</ul>";
			document.getElementById('error-message').innerHTML = strErrorMessage;
			fireMyPopup('contact-error');
		}
		else
		{
			document.forms[0].submit();
		}
	}

	// Browser safe opacity handling function
	
	function setOpacity( value, strDiv ) {
	 document.getElementById(strDiv).style.opacity = value / 10;
	 document.getElementById(strDiv).style.filter = 'alpha(opacity=' + value * 10 + ')';
	}
	
	function fadeInMyPopup(strDiv) {
	 for( var i = 0 ; i <= 100 ; i++ )
		 setTimeout( 'setOpacity(' + (i / 10) + ',"' + strDiv + '")' , 2 * i );
	}
	
	function fadeOutMyPopup(strDiv) {
	 for( var i = 0 ; i <= 100 ; i++ ) {
		 setTimeout( 'setOpacity(' + (10 - i / 10) + ',"' + strDiv + '")' , 1 * i );
	 }
	
	 setTimeout('closeMyPopup("' + strDiv + '")', 100 );
	}
	
	function closeMyPopup(strDiv) {
	 document.getElementById(strDiv).style.display = "none"
	}
	
	function fireMyPopup(strDiv) {
	 setOpacity( 0, strDiv );
	 document.getElementById(strDiv).style.display = "block";
	 fadeInMyPopup(strDiv);
	}
	-->
</script>
</head> 

<body>
<div id="wrapper">
	<div id="header">
		<div id="border-top"></div>

<?php require("menu.php"); ?>
	</div>
	
	<div id="recent-sites">
		<div id="contact-left">
			<p class="img-header"><img src="images/header_contact.png" width="104" height="20" alt="" /></p>
			<p><span style="color:#fbedbb">Steve Black Web Development &amp; Graphic Design</span> is a home based business. As such, it is required of all potential clients to first contact via e-mail to ensure valid requests before any further contact information is given.</p>
			<p>&nbsp;</p>
			<p>Thank you for understanding. Please use the form to the right to send an e-mail with as much information of your request as you'd like to give:</p>
			<p style="text-align:center;margin-top:15px;"><img src="images/icon_phone.png" height="232" width="231" alt="" /></p>
		</div>
		
		<div id="contact-right">
<?php
if ($_POST['name'])
{
	// Set email variables.
	$your_email = 'steve@steveblackonline.com';
	$msg = $_POST['details'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$contact = $_POST['contact'];
	$type = $_POST['type'];
	$other = $_POST['other'];
	
	
	$contact_msg = "Name: ".$name."\n";
	$contact_msg .= "E-mail: ".$email."\n";
	$contact_msg .= "Phone: ".$phone."\n";
	$contact_msg .= "Best Time to Contact: ".$contact."\n";
	$contact_msg .= "Project Type: ".$type."\n";
	$contact_msg .= "Other Project Type?: ".$other."\n";
	$contact_msg .= "Message:\n".$msg;



	// Email that gets sent to you.
	$name = stripslashes($name);
	if (mail($your_email, "Web Design Contact Form Submitted", stripslashes($contact_msg), "From: $name < $email >"))
	{
?>

			<form id="contactForm" action="" method="post">
				<fieldset>
					<legend class="img-header"><img src="images/header_contact_form.png" width="181" height="21" alt="" /></legend>
					<p>Your information has been submitted!</p>
					<p>&nbsp;</p>
					<p>Thank you for your intereset in</p>
					<p style="text-align:center"><span style="color:#fbedbb">Steve Black Web Development &amp; Graphic Design</span></p>
					<p>&nbsp;</p>
					<p>You can expect a reply to your inquiry within one business day</p>
					<p style="text-align:center"><a href="index.php" class="text-link">Back to Homepage</a></p>
					<p>&nbsp;</p>
				</fieldset>
			</form>
<?
} else {
?>

			<form id="contactForm" action="" method="post">
				<fieldset>
					<legend class="img-header"><img src="images/header_contact_form.png" width="181" height="21" alt="" /></legend>
					<p style="text-align:center">An unknown error has occurred!</p>
					<p>&nbsp;</p>
					<p>Please try again at a later time, or <a href="mailto:steve@steveblackonline.com?subject=WebForm Submittal" class="text-link">e-mail</a> directly</p>
					<p>&nbsp;</p>
				</fieldset>
			</form>
<?
}
} else {
?>
			<form id="contactForm" action="" method="post">
				<fieldset>
					<legend class="img-header"><img src="images/header_contact_form.png" width="181" height="21" alt="" /></legend>
				<div class="odd">
					<label>Name*:</label><input type="text" name="name" style="width:225px;" />
				</div>
				<div>
					<label>E-mail Address*:</label><input type="text" name="email" style="width:225px;" />
				</div>
				<div class="odd">
					<label>Phone Number:</label><input type="text" name="phone" style="width:170px;" />
				</div>
				<div>
					<label>Best Time to Contact:</label>
					<select name="contact">
						<option>-- select --</option>
						<option value="Morning">Morning</option>
						<option value="Afternoon">Afternoon</option>
						<option value="Evening">Evening</option>
					</select>
				</div>
				<div class="odd">
					<label>Project Type:</label>
					<select name="type">
						<option>-- select --</option>
						<option value="Web Design/Development">Web Design/Development</option>
						<option value="Graphic Design">Graphic Design</option>
						<option value="Video Montage">Video Montage</option>
						<option value="Flyer Design">Flyer Design</option>
						<option value="Business Card Design">Business Card Design</option>
						<option value="Card Design">Card Design</option>
						<option value="Logo Design">Logo Design</option>
						<option value="Other">Other</option>
					</select>
				</div>
				<div>
					<label>If other, please specify:</label><input type="text" name="other" style="width:225px;" />
				</div>
				<div class="odd">
					<p>Details*:</p>
					<p><textarea cols="60" rows="5" name="details"></textarea></p>
				</div>
				<div>
					<p style="text-align:right;font-size:10px;">(*) indicates a required field</p>
					<p><a href="javascript:sendEmail(document.forms[0].name.value,document.forms[0].email.value,document.forms[0].phone.value,document.forms[0].contact.value,document.forms[0].type.value,document.forms[0].other.value, document.forms[0].details.value)"><img src="images/btn_submit.png" width="75" height="25" alt="" /></a></p>
				</div>
				<div id="contact-error" style="display:none;">
					<div id="error-toolbar"><a href="javascript:fadeOutMyPopup('contact-error')"><img src="images/btn_x.png" width="16" height="16" alt="close" style="margin:2px;" /></a></div>
					<h1 style="text-align:center;">Error!</h1>
					<div id="error-message"></div>
				</div>
				</fieldset>
			</form>
<?
}
?>
		</div>
		
		<div style="clear:both;"></div>
	</div>
	
	
<?php require("footer.php"); ?>
</div>
</body>
</html>
