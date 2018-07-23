<?
session_start();
require("config.php");

if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
	require ("client_header.php");
?>

<style type="text/css">
	table td {
		padding:3px 10px;
		text-align:left;
		vertical-align:top;
	}
	div#box div input {
		float:left;
		height: 13px;
		font-size: 10px;
		color:#666666;
		width:220px;
		background-image: url(input_bkg.png);
		background-repeat: repeat-y;
		background-position: right;
		border: 1px solid #cccccc;
		padding:2px;
	}
</style>

<script language="javascript">
	function validateForm()
	{
		var un=document.getElementById("username").value;
		var pw=document.getElementById("password").value;
		if (un=="" || pw=="")
		{
			alert("Please make sure you have a username and password entered.");
		}
		else
		{
			document.addClient.submit();
		}
	}
</script>
			<h2><img src="../images/lscroll.gif" alt="" /> Administration Only <img src="../images/scroll.gif" alt="" /></h2>
<?
	if (!$_POST['valid'])
	{
?>
			<h2 style="text-align: left !important;margin-bottom:0px !important;">Add a Client</h2>
			<h2 style="text-align: left !important;margin-bottom:0px !important;">Contact Information</h2>
			<form name="addClient" method="post" action="addClient.php">
				<fieldset>
					<legend>Login Credentials</legend>
					<div style="float:left;width:80px;margin-left:10px;"><img src="images/success-icon.png" width="80" height="60" border="0" /></div>
					<div style="float:right;width:475px;">
						<div class="odd">
							<label>User Name:</label>
							<input type="text" id="username" name="username" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Password:</label>
							<input type="text" id="password" name="password" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Primary Contact</legend>
					<div style="float:left;width:80px;margin-left:10px;"><img src="images/primary.png" width="80" height="123" border="0" /></div>
					<div style="float:right;width:475px;">
						<div class="odd">
							<label>First Name:</label>
							<input type="text" name="first_name_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Middle Name:</label>
							<input type="text" name="middle_name_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Last Name:</label>
							<input type="text" name="last_name_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Address Line 1:</label>
							<input type="text" name="address_1_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Address Line 2:</label>
							<input type="text" name="address_2_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>City:</label>
							<input type="text" name="city_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>State:</label>
							<input type="text" name="state_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Zip Code:</label>
							<input type="text" name="zip_code_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Day Phone:</label>
							<input type="text" name="day_phone_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Evening Phone:</label>
							<input type="text" name="evening_phone_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Cell Phone:</label>
							<input type="text" name="cell_phone_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Email:</label>
							<input type="text" name="e_mail_1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
					</div>
				</fieldset>
				
				<fieldset>
					<legend>Secondary Contact</legend>
					<div style="float:left;width:80px;margin-left:10px;"><img src="images/secondary.png" width="80" height="123" border="0" /></div>
					<div style="float:right;width:475px;">
						<div class="odd">
							<label>First Name:</label>
							<input type="text" name="first_name_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Middle Name:</label>
							<input type="text" name="middle_name_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Last Name:</label>
							<input type="text" name="last_name_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Address Line 1:</label>
							<input type="text" name="address_1_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Address Line 2:</label>
							<input type="text" name="address_2_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>City:</label>
							<input type="text" name="city_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>State:</label>
							<input type="text" name="state_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Zip Code:</label>
							<input type="text" name="zip_code_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Day Phone:</label>
							<input type="text" name="day_phone_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Evening Phone:</label>
							<input type="text" name="evening_phone_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Cell Phone:</label>
							<input type="text" name="cell_phone_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Email:</label>
							<input type="text" name="e_mail_0" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Event Details</legend>
					<div style="float:left;width:80px;margin-left:10px;"><img src="images/event-details-icon.png" width="80" height="80" border="0" /></div>
					<div style="float:right;width:475px;">
						<div class="odd">
							<label>Event Type:</label>
							<select name="event_type">
								<option value="">Select Event Type...</option>
<?

	$strQueryEventType = "SELECT event_type_ID,
														 event_type_desc
														 FROM LIL_event_types;";
	$arrEventType = mysql_query($strQueryEventType);
	
	while ($row = mysql_fetch_array($arrEventType))
	{
		$intID = $row['event_type_ID'];
		$strDescription = $row['event_type_desc'];
?>
								<option value="<? echo $intID; ?>"><? echo $strDescription; ?></option>
<?
	}

?>
							</select>
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Event Date:</label>
							<select name="event_month">
								<option value="">Month...</option>
								<option value="01">Jan - 01</option>
								<option value="02">Feb - 02</option>
								<option value="03">Mar - 03</option>
								<option value="04">Apr - 04</option>
								<option value="05">May - 05</option>
								<option value="06">Jun - 06</option>
								<option value="07">Jul - 07</option>
								<option value="08">Aug - 08</option>
								<option value="09">Sep - 09</option>
								<option value="10">Oct - 10</option>
								<option value="11">Nov - 11</option>
								<option value="12">Dec - 12</option>
							</select>
							<select name="event_day">
								<option value="">Day...</option>
								<option value="01">01</option>
								<option value="02">02</option>
								<option value="03">03</option>
								<option value="04">04</option>
								<option value="05">05</option>
								<option value="06">06</option>
								<option value="07">07</option>
								<option value="08">08</option>
								<option value="09">09</option>
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
							<select name="event_year">
								<option value="">Year...</option>
								<option value="2015">2015</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
							</select>
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Event Time Start:</label>
							<select name="event_start_hour">
								<option value="">Hour...</option>
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
							<select name="event_start_minute">
								<option value="">Minute...</option>
								<option value="00">00</option>
								<option value="05">05</option>
								<option value="10">10</option>
								<option value="15">15</option>
								<option value="20">20</option>
								<option value="25">25</option>
								<option value="30">30</option>
								<option value="35">35</option>
								<option value="40">40</option>
								<option value="45">45</option>
								<option value="50">50</option>
								<option value="55">55</option>
							</select>
							<select name="event_start_ampm">
								<option value="">AM/PM...</option>
								<option value="PM">PM</option>
								<option value="AM">AM</option>
							</select>
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Event Time End:</label>
							<select name="event_end_hour">
								<option value="">Hour...</option>
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
							<select name="event_end_minute">
								<option value="">Minute...</option>
								<option value="00">00</option>
								<option value="05">05</option>
								<option value="10">10</option>
								<option value="15">15</option>
								<option value="20">20</option>
								<option value="25">25</option>
								<option value="30">30</option>
								<option value="35">35</option>
								<option value="40">40</option>
								<option value="45">45</option>
								<option value="50">50</option>
								<option value="55">55</option>
							</select>
							<select name="event_end_ampm">
								<option value="">AM/PM...</option>
								<option value="PM">PM</option>
								<option value="AM">AM</option>
							</select>
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Venue:</label>
							<input type="text" name="event_venue" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Address Line 1:</label>
							<input type="text" name="event_venue_address1" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Address Line 2:</label>
							<input type="text" name="event_venue_address2" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>City:</label>
							<input type="text" name="event_city" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>State:</label>
							<input type="text" name="event_state" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Phone:</label>
							<input type="text" name="event_phone" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Contact:</label>
							<input type="text" name="event_contact" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="">
							<label>Email:</label>
							<input type="text" name="event_email" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
	
						<div class="odd">
							<label>Guest Count:</label>
							<input type="text" name="event_guest_count" value="" />
							<div style="height:0px;clear:both;padding:0px;"></div>
						</div>
					</div>
				</fieldset>
				<div style="margin-top:15px;"><input type="submit" name="submitform" value="Add Client" onclick="validateForm();return false;" style="width:70px;height:auto;" /></div>
				<div style="height:0px;clear:both;padding:0px;"></div>
				<input type="hidden" name="valid" value="true" />
			</form>
<?
	} //END:if (!$_POST['valid'])
	else
	{
		//initialize variables
		$username								=$_POST["username"];
		$password								=$_POST["password"];
		$md5Password 						= md5($password);
		$first_name_1						=$_POST["first_name_1"];
		$middle_name_1					=$_POST["middle_name_1"];
		$last_name_1						=$_POST["last_name_1"];
		$address_1_1						=$_POST["address_1_1"];
		$address_2_1						=$_POST["address_2_1"];
		$city_1									=$_POST["city_1"];
		$state_1								=$_POST["state_1"];
		$zip_code_1							=$_POST["zip_code_1"];
		$day_phone_1						=$_POST["day_phone_1"];
		$evening_phone_1				=$_POST["evening_phone_1"];
		$cell_phone_1						=$_POST["cell_phone_1"];
		$e_mail_1								=$_POST["e_mail_1"];
		$first_name_0						=$_POST["first_name_0"];
		$middle_name_0					=$_POST["middle_name_0"];
		$last_name_0						=$_POST["last_name_0"];
		$address_1_0						=$_POST["address_1_0"];
		$address_2_0						=$_POST["address_2_0"];
		$city_0									=$_POST["city_0"];
		$state_0								=$_POST["state_0"];
		$zip_code_0							=$_POST["zip_code_0"];
		$day_phone_0						=$_POST["day_phone_0"];
		$evening_phone_0				=$_POST["evening_phone_0"];
		$cell_phone_0						=$_POST["cell_phone_0"];
		$e_mail_0								=$_POST["e_mail_0"];
		$event_type							=$_POST["event_type"];
		$event_month						=$_POST["event_month"];
		$event_day							=$_POST["event_day"];
		$event_year							=$_POST["event_year"];
		$event_date							=$_POST["event_year"]."-".$_POST["event_month"]."-".$_POST["event_day"];
		$event_start_hour				=$_POST["event_start_hour"];
		$event_start_minute			=$_POST["event_start_minute"];
		$event_start_ampm				=$_POST["event_start_ampm"];
		$event_start_time				=$_POST["event_start_hour"].":".$_POST["event_start_minute"]." ".$_POST["event_start_ampm"];
		$event_end_hour					=$_POST["event_end_hour"];
		$event_end_minute				=$_POST["event_end_minute"];
		$event_end_ampm					=$_POST["event_end_ampm"];
		$event_end_time					=$_POST["event_end_hour"].":".$_POST["event_end_minute"]." ".$_POST["event_end_ampm"];
		$event_venue						=$_POST["event_venue"];
		$event_venue_address1		=$_POST["event_venue_address1"];
		$event_venue_address2		=$_POST["event_venue_address2"];
		$event_city							=$_POST["event_city"];
		$event_state						=$_POST["event_state"];
		$event_phone						=$_POST["event_phone"];
		$event_contact					=$_POST["event_contact"];
		$event_email						=$_POST["event_email"];
		$event_guest_count			=$_POST["event_guest_count"];
		$date										=date("D F j, Y, g:i a");
		$clientID								="";
		

		$strInsertClient = "INSERT INTO LIL_client
															 (username, password)
															 VALUES ('$username', '$md5Password');";
		If (mysql_query($strInsertClient))
		{
			$strQueryClientID = "SELECT ID
																 FROM LIL_client
																 WHERE username='$username'
																 AND password='$md5Password'
																 LIMIT 1;";
			$clientID=mysql_result(mysql_query($strQueryClientID),0);
			
			$strInsertContact = "INSERT INTO LIL_contact_info
													 				VALUES ($clientID,
																	1,
																	'$first_name_1',
																	'$last_name_1',
																	'$address_1_1',
																	'$address_2_1',
																	'$city_1',
																	'$state_1',
																	'$zip_code_1',
																	'$day_phone_1',
																	'$evening_phone_1',
																	'$cell_phone_1',
																	'$e_mail_1',
																	'$middle_name_1',
																	'$date'),
																	($clientID,
																	0,
																	'$first_name_0',
																	'$last_name_0',
																	'$address_1_0',
																	'$address_2_0',
																	'$city_0',
																	'$state_0',
																	'$zip_code_0',
																	'$day_phone_0',
																	'$evening_phone_0',
																	'$cell_phone_0',
																	'$e_mail_0',
																	'$middle_name_0',
																	'$date');";
			If (mysql_query($strInsertContact))
			{
				$strInsertEventInfo = "INSERT INTO LIL_event_info
																		VALUES ($clientID,
																		$event_type,
																		'$event_date',
																		'$event_start_time',
																		'$event_end_time',
																		'$event_venue',
																		'$event_venue_address1',
																		'$event_venue_address2',
																		'$event_city',
																		'$event_state',
																		'$event_phone',
																		'$event_contact',
																		'$event_email',
																		'$event_guest_count');";
				If (mysql_query($strInsertEventInfo))
				{
?>
<script language="javascript">
	location.href='admin.php?newclient=1&fname=<? echo $first_name_1; ?>&lname=<? echo $last_name_1; ?>';
</script>
<?
				}
				else
				{
					echo "ERROR: Event info not created!";
				}
			}
			else
			{
				echo "ERROR: Contact info not created!";
			}
		}
		else
		{
			echo "ERROR: Client not created!";
		}
		
	}
	require("client_footer.php");
}
//if user is not logged in
else
{
echo $_SESSION['loggedin'];
	require("login.php");
}
mysql_close();
?>