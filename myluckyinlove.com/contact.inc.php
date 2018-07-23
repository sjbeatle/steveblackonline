<?php
// Set email variables.
$your_email = 'dj@myluckyinlove.com';
$your_name = 'Lucky In Love';
$your_link = 'http://www.myluckyinlove.com';

// Begin the sendmail routine.
if ($_POST['submit']) {
$msg = $_POST['details'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$contact = $_POST['contact'];
$type = $_POST['type'];
$other = $_POST['other'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$vname = $_POST['vname'];
$city = $_POST['city'];
$state = $_POST['state'];
$stime = $_POST['stime'];
$shalf = $_POST['shalf'];
$smeridian = $_POST['smeridian'];
$etime = $_POST['etime'];
$ehalf = $_POST['ehalf'];
$emeridian = $_POST['emeridian'];
$guest = $_POST['guest'];
$referral = $_POST['referral'];


$contact_msg = "Name: ".$name."\n";
$contact_msg .= "E-mail: ".$email."\n";
$contact_msg .= "Phone: ".$phone."\n";
$contact_msg .= "Best Time to Contact: ".$contact."\n";
$contact_msg .= "Event Type: ".$type."\n";
$contact_msg .= "Other Event Type?: ".$other."\n";
$contact_msg .= "Event Date: ".$month." ".$day.", ".$year."\n";
$contact_msg .= "Venue Name: ".$vname."\n";
$contact_msg .= "Event City: ".$city."\n";
$contact_msg .= "Event State: ".$state."\n";
$contact_msg .= "Start Time: ".$stime."".$shalf." ".$smeridian."\n";
$contact_msg .= "End Time: ".$etime."".$ehalf." ".$emeridian."\n";
$contact_msg .= "Guest Count: ".$guest."\n";
$contact_msg .= "Message:\n".$msg."\n";
$contact_msg .= "How did you hear about us?".$referral;



// Email that gets sent to you.
$name = stripslashes($name);
mail($your_email, "Lucky in Love Contact Form Submitted", stripslashes($contact_msg), "From: Do Not Reply < $your_email >");

// Print the thank you page.
   print <<<EOF
		<p>&nbsp;</p>
		<p><strong>Your information was sent.</strong></p>
		<p>Thank You, $name. You should be hearing back from us soon!</p>
		<p>Please add "dj@myluckyinlove.com" to your e-mail client's "white-list" to avoid our response ending up in your spam folder.</p>
		<p><a href="index.php">Back to home page</a></p>

EOF;
}
else
{

// Print the contact form page.
   print <<<EOF
			<p>Tell us as much about your event as you'd like:</p>
			<form id="contactForm" action="" method="post">
				<div class="odd">
					<label>Name:</label><input type="text" name="name" size="30" />
				</div>
				<div>
					<label>E-mail Address:</label><input type="text" name="email" size="30" />
				</div>
				<div class="odd">
					<label>Phone Number:</label><input type="text" name="phone" size="20" />
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
					<label>Event Type:</label>
					<select name="type">
						<option>-- select --</option>
						<option value="Wedding">Wedding</option>
						<option value="Engagement">Engagement Party</option>
						<option value="Anniversary">Anniversary</option>
						<option value="Sweet Sixteen">Sweet Sixteen</option>
						<option value="Bar/Bat Mitzvahs">Bar/Bat Mitzvahs</option>
						<option value="Birthday">Birthday</option>
						<option value="Holiday">Holiday Party</option>
						<option value="Prom">Prom</option>
						<option value="School Dance">School Dance</option>
						<option value="Corporate">Corporate Event</option>
						<option value="Retirement">Retirement Party</option>
						<option value="Other">Other</option>
					</select>
				</div>
				<div>
					<label>If other, please specify:</label><input type="text" name="other" size="30" />
				</div>
				<div class="odd">
					<label>Event Date:</label>
					<select name="month">
						<option>-- select --</option>
						<option value="January">January</option>
						<option value="February">February</option>
						<option value="March">March</option>
						<option value="April">April</option>
						<option value="May">May</option>
						<option value="June">June</option>
						<option value="July">July</option>
						<option value="August">August</option>
						<option value="September">September</option>
						<option value="October">October</option>
						<option value="November">November</option>
						<option value="December">December</option>
					</select>
					<select name="day">
						<option>-- select --</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					</select>
					<select name="year">
						<option>-- select --</option>
						<option value="2013">2013</option>
						<option value="2014">2014</option>
						<option value="2015">2015</option>
						<option value="2016">2016</option>
					</select>
				</div>
				<div>
					<label>Venue Name:</label><input type="text" name="vname" size="30" />
				</div>
				<div class="odd">
					<label>Event City:</label><input type="text" name="city" size="30" />
				</div>
				<div>
					<label>Event State:</label><input type="text" name="state" size="10" />
				</div>
				<div class="odd">
					<label>Event Time Start:</label>
					<select name="stime">
						<option>-- select --</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
					<select name="shalf">
						<option>-- select --</option>
						<option value=":00">:00</option>
						<option value=":30">:30</option>
					</select>
					<select name="smeridian">
						<option>-- select --</option>
						<option value="am">am</option>
						<option value="pm">pm</option>
					</select>
				</div>
				<div>
					<label>Event Time End:</label>
					<select name="etime">
						<option>-- select --</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
					<select name="ehalf">
						<option>-- select --</option>
						<option value=":00">:00</option>
						<option value=":30">:30</option>
					</select>
					<select name="emeridian">
						<option>-- select --</option>
						<option value="am">am</option>
						<option value="pm">pm</option>
					</select>
				</div>
				<div class="odd">
					<label>Approximate Number of Guests:</label><input type="text" name="guest" size="10" />
				</div>
				<div>
					<label>How did you hear about us?</label><input type="text" name="referral" size="30" />
				</div>
				<div class="odd">
					<p>Details &amp; Special Requests:</p>
					<p><textarea cols="60" rows="5" name="details"></textarea></p>
					<p><input type="submit"  name="submit" value="Submit Info" /></p>
				</div>
			</form>

EOF;
}
?>