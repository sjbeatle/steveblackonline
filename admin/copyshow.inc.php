<?php
session_start();
require ("config.php");
/************* FIRST CHECK IF THE USER IS LOGGED IN **************/
if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
?>

<script language="javascript" type="text/javascript">
	function blockVenue() {
		var strVenue = document.getElementById("venue").value;
		if (strVenue == "new")
		{
			document.getElementById("addVenue").style.display = 'block';
		}
		else
		{
			document.getElementById("addVenue").style.display = 'none';
		}

	}
</script>
<?php
	if (!$_POST['enter'])
	{ // START IF show hasn't been selected, display the entry form
		$strSQL = "select * from shows left outer join venue on shows.show_venue_ID = venue.venue_ID WHERE shows.show_date>=CURDATE() order by shows.show_date;";
		$qrySQL = mysql_query($strSQL) or die (mysql_error());
?>

<form name="edit" method="post" action="index.php?page=copyshow">
	<input type="hidden" name="enter" value="true" />
	<p>Select the show you would like to copy...</p>
	<p>&nbsp;</p>
<?php
while ($row = mysql_fetch_array($qrySQL)) {
   $id = $row["show_ID"];
   $strName = $row["venue_name"];
	 $strCity = $row["venue_city"];
	 $strState = $row["venue_state"];
   $strDate = $row["show_date_display"];
   $strTimeStart = $row["show_time_start"];
   $strTimeEnd = $row["show_time_end"];

	 echo "\t<p><input type=\"radio\" name=\"editShow\" value=\"$id\" onclick=\"this.form.submit();\" /> <strong>$strDate:</strong> $strName in $strCity, $strState from $strTimeStart - $strTimeEnd</p>\n";
}
?>
</form>
<?php
	} // END IF show hasn't been selected, display the entry form.
	else if (!$_POST['update'])
	{ // START ELSE form was submitted
		$id = $_POST['editShow'];
		$strSQL = "select show_date, show_venue_ID, show_cover, show_time_start, show_time_end, show_info, show_revenue from shows where show_ID=$id;";
		$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
		$row = mysql_fetch_row($qrySQL);

		//initialize variables
		$dtmDate = $row[0];
		$strVenue = $row[1];
		$strCover = $row[2];
		$strStart = $row[3];
		$strEnd = $row[4];
		$strInfo = $row[5];
		$strRevenue = $row[6];
		//clean the 'info' syntax
		$strInfo = substr($strInfo,3,-4);
		$arrLineReturns = array("</p><p>");
		$strReplace = "\r\n";
		$strInfo = str_replace($arrLineReturns, $strReplace, $strInfo);
		//Break out date and times
		$strYear = substr($dtmDate,0,4);
		$strMonth = substr($dtmDate,5,2);
		$strDay = substr($dtmDate,8,2);
		$strStartM = substr($strStart,-2);
		$strEndM = substr($strEnd,-2);
		$strStart = trim($strStart, " apm");
		$strEnd = trim($strEnd, " apm");
?>

<form name="admin_show_edit" method="post" action="">
	<input type="hidden" name="enter" value="true" />
	<p>Show Date:*</p>
	<select name="month" size="1">
	 <option value="">-- Select Month --</option>
	 <option value="01"<?php if ($strMonth == "01") { echo " selected=\"selected\""; } ?>>January</option>
	 <option value="02"<?php if ($strMonth == "02") { echo " selected=\"selected\""; } ?>>February</option>
	 <option value="03"<?php if ($strMonth == "03") { echo " selected=\"selected\""; } ?>>March</option>
	 <option value="04"<?php if ($strMonth == "04") { echo " selected=\"selected\""; } ?>>April</option>
	 <option value="05"<?php if ($strMonth == "05") { echo " selected=\"selected\""; } ?>>May</option>
	 <option value="06"<?php if ($strMonth == "06") { echo " selected=\"selected\""; } ?>>June</option>
	 <option value="07"<?php if ($strMonth == "07") { echo " selected=\"selected\""; } ?>>July</option>
	 <option value="08"<?php if ($strMonth == "08") { echo " selected=\"selected\""; } ?>>August</option>
	 <option value="09"<?php if ($strMonth == "09") { echo " selected=\"selected\""; } ?>>September</option>
	 <option value="10"<?php if ($strMonth == "10") { echo " selected=\"selected\""; } ?>>October</option>
	 <option value="11"<?php if ($strMonth == "11") { echo " selected=\"selected\""; } ?>>November</option>
	 <option value="12"<?php if ($strMonth == "12") { echo " selected=\"selected\""; } ?>>December</option>
	</select>
	<select name="day" size="1">
	 <option value="">-- Select Day --</option>
	 <option value="01"<?php if ($strDay == "01") { echo " selected=\"selected\""; } ?>>01</option>
	 <option value="02"<?php if ($strDay == "02") { echo " selected=\"selected\""; } ?>>02</option>
	 <option value="03"<?php if ($strDay == "03") { echo " selected=\"selected\""; } ?>>03</option>
	 <option value="04"<?php if ($strDay == "04") { echo " selected=\"selected\""; } ?>>04</option>
	 <option value="05"<?php if ($strDay == "05") { echo " selected=\"selected\""; } ?>>05</option>
	 <option value="06"<?php if ($strDay == "06") { echo " selected=\"selected\""; } ?>>06</option>
	 <option value="07"<?php if ($strDay == "07") { echo " selected=\"selected\""; } ?>>07</option>
	 <option value="08"<?php if ($strDay == "08") { echo " selected=\"selected\""; } ?>>08</option>
	 <option value="09"<?php if ($strDay == "09") { echo " selected=\"selected\""; } ?>>09</option>
	 <option value="10"<?php if ($strDay == "10") { echo " selected=\"selected\""; } ?>>10</option>
	 <option value="11"<?php if ($strDay == "11") { echo " selected=\"selected\""; } ?>>11</option>
	 <option value="12"<?php if ($strDay == "12") { echo " selected=\"selected\""; } ?>>12</option>
	 <option value="13"<?php if ($strDay == "13") { echo " selected=\"selected\""; } ?>>13</option>
	 <option value="14"<?php if ($strDay == "14") { echo " selected=\"selected\""; } ?>>14</option>
	 <option value="15"<?php if ($strDay == "15") { echo " selected=\"selected\""; } ?>>15</option>
	 <option value="16"<?php if ($strDay == "16") { echo " selected=\"selected\""; } ?>>16</option>
	 <option value="17"<?php if ($strDay == "17") { echo " selected=\"selected\""; } ?>>17</option>
	 <option value="18"<?php if ($strDay == "18") { echo " selected=\"selected\""; } ?>>18</option>
	 <option value="19"<?php if ($strDay == "19") { echo " selected=\"selected\""; } ?>>19</option>
	 <option value="20"<?php if ($strDay == "20") { echo " selected=\"selected\""; } ?>>20</option>
	 <option value="21"<?php if ($strDay == "21") { echo " selected=\"selected\""; } ?>>21</option>
	 <option value="22"<?php if ($strDay == "22") { echo " selected=\"selected\""; } ?>>22</option>
	 <option value="23"<?php if ($strDay == "23") { echo " selected=\"selected\""; } ?>>23</option>
	 <option value="24"<?php if ($strDay == "24") { echo " selected=\"selected\""; } ?>>24</option>
	 <option value="25"<?php if ($strDay == "25") { echo " selected=\"selected\""; } ?>>25</option>
	 <option value="26"<?php if ($strDay == "26") { echo " selected=\"selected\""; } ?>>26</option>
	 <option value="27"<?php if ($strDay == "27") { echo " selected=\"selected\""; } ?>>27</option>
	 <option value="28"<?php if ($strDay == "28") { echo " selected=\"selected\""; } ?>>28</option>
	 <option value="29"<?php if ($strDay == "29") { echo " selected=\"selected\""; } ?>>29</option>
	 <option value="30"<?php if ($strDay == "30") { echo " selected=\"selected\""; } ?>>30</option>
	 <option value="31"<?php if ($strDay == "31") { echo " selected=\"selected\""; } ?>>31</option>
	</select>
	<select name="year" size="1">
	 <option value="<?php echo date("Y");?>"<?php if ($strYear == date("Y")) { echo " selected=\"selected\""; } ?>><?php echo date("Y");?></option>
	 <option value="<?php echo date("Y")+1;?>"<?php if ($strYear == (date("Y")+1)) { echo " selected=\"selected\""; } ?>><?php echo date("Y")+1;?></option>
	 <option value="<?php echo date("Y")+2;?>"<?php if ($strYear == (date("Y")+2)) { echo " selected=\"selected\""; } ?>><?php echo date("Y")+2;?></option>
	</select>
	<p>Venue:*</p>
	<select id="venue" name="venue" size="1" onchange="blockVenue();">
	 <option value="">-- Select Venue --</option>
	 <option value="new">-- Add New --</option>
<?php
$strSQL = "select venue_ID, venue_name from venue;";
$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
while ($row = mysql_fetch_array($qrySQL)) {
	$Venue_ID = $row["venue_ID"];
	$Venue_Name = $row["venue_name"];

	if ($strVenue == $Venue_ID)
	{
		echo "\t <option value=\"$Venue_ID\" selected=\"selected\">$Venue_Name</option>\n";
	}
	else
	{
		echo "\t <option value=\"$Venue_ID\">$Venue_Name</option>\n";
	}
}

?>

	</select>
	<p>

	<div id="addVenue">
		<fieldset>
			<legend>New Venue Information</legend>
			<p>Name:*</p>
			<input type="text" name="vName" maxlength="100" value="" size="30" />
			<p>Address:*</p>
			<input type="text" name="vAddress" maxlength="100" value="" size="30" />
			<p>City:*</p>
			<input type="text" name="vCity" maxlength="100" value="" size="30" />
			<p>State:*</p>
			<select name="vState" size="1">
			 <option value="">-- Select State --</option>
			 <option value="CT">CT</option>
			 <option value="NY">NY</option>
			 <option value="NY">RI</option>
			 <option value="NJ">NJ</option>
			 <option value="NH">NH</option>
			 <option value="VT">VT</option>
			 <option value="MA">MA</option>
			</select>
			<p>Zip Code:</p>
			<input type="text" name="vZip" maxlength="5" value="" size="10" />
			<p>Web Addres: <font size="1">(if applicable)</font></p>
			<input type="text" name="vURL" maxlength="100" value="http://" size="30" />
			<p>E-mail: <font size="1">(if applicable)</font></p>
			<input type="text" name="vEmail" maxlength="100" value="" size="30" />
			<p>Phone: <font size="1">(XXX-XXX-XXXX)</font></p>
			<input type="text" name="vPhone" maxlength="100" value="" size="30" />
		</fieldset>
	</div>

	<table>
		<tr>
			<td align="left" valign="top">Start Time:*</td>
			<td align="left" valign="top">End Time:</td>
		</tr>
		<tr>
			<td align="left">
				<select name="start" size="1">
				 <option value="">-- Select Start Time --</option>
				 <option value="12:00"<?php if ($strStart == "12:00") { echo " selected=\"selected\""; } ?>>12:00</option>
				 <option value="12:30"<?php if ($strStart == "12:30") { echo " selected=\"selected\""; } ?>>12:30</option>
				 <option value="1:00"<?php if ($strStart == "1:00") { echo " selected=\"selected\""; } ?>>1:00</option>
				 <option value="1:30"<?php if ($strStart == "1:30") { echo " selected=\"selected\""; } ?>>1:30</option>
				 <option value="2:00"<?php if ($strStart == "2:00") { echo " selected=\"selected\""; } ?>>2:00</option>
				 <option value="2:30"<?php if ($strStart == "2:30") { echo " selected=\"selected\""; } ?>>2:30</option>
				 <option value="3:00"<?php if ($strStart == "3:00") { echo " selected=\"selected\""; } ?>>3:00</option>
				 <option value="3:30"<?php if ($strStart == "3:30") { echo " selected=\"selected\""; } ?>>3:30</option>
				 <option value="4:00"<?php if ($strStart == "4:00") { echo " selected=\"selected\""; } ?>>4:00</option>
				 <option value="4:30"<?php if ($strStart == "4:30") { echo " selected=\"selected\""; } ?>>4:30</option>
				 <option value="5:00"<?php if ($strStart == "5:00") { echo " selected=\"selected\""; } ?>>5:00</option>
				 <option value="5:30"<?php if ($strStart == "5:30") { echo " selected=\"selected\""; } ?>>5:30</option>
				 <option value="6:00"<?php if ($strStart == "6:00") { echo " selected=\"selected\""; } ?>>6:00</option>
				 <option value="6:30"<?php if ($strStart == "6:30") { echo " selected=\"selected\""; } ?>>6:30</option>
				 <option value="7:00"<?php if ($strStart == "7:00") { echo " selected=\"selected\""; } ?>>7:00</option>
				 <option value="7:30"<?php if ($strStart == "7:30") { echo " selected=\"selected\""; } ?>>7:30</option>
				 <option value="8:00"<?php if ($strStart == "8:00") { echo " selected=\"selected\""; } ?>>8:00</option>
				 <option value="8:30"<?php if ($strStart == "8:30") { echo " selected=\"selected\""; } ?>>8:30</option>
				 <option value="9:00"<?php if ($strStart == "9:00") { echo " selected=\"selected\""; } ?>>9:00</option>
				 <option value="9:30"<?php if ($strStart == "9:30") { echo " selected=\"selected\""; } ?>>9:30</option>
				 <option value="10:00"<?php if ($strStart == "10:00") { echo " selected=\"selected\""; } ?>>10:00</option>
				 <option value="10:30"<?php if ($strStart == "10:30") { echo " selected=\"selected\""; } ?>>10:30</option>
				 <option value="11:00"<?php if ($strStart == "11:00") { echo " selected=\"selected\""; } ?>>11:00</option>
				 <option value="11:30"<?php if ($strStart == "11:30") { echo " selected=\"selected\""; } ?>>11:30</option>
				</select>
				<select name="startM" size="1">
				 <option value="">-- AM/PM --</option>
				 <option value="am"<?php if ($strStartM == "am") { echo " selected=\"selected\""; } ?>>am</option>
				 <option value="pm"<?php if ($strStartM == "pm") { echo " selected=\"selected\""; } ?>>pm</option>
				</select>
				&nbsp;&nbsp;
			</td>
			<td align="left">
				<select name="end" size="1">
				 <option value="">-- Select End Time --</option>
				 <option value="12:00"<?php if ($strEnd == "12:00") { echo " selected=\"selected\""; } ?>>12:00</option>
				 <option value="12:30"<?php if ($strEnd == "12:30") { echo " selected=\"selected\""; } ?>>12:30</option>
				 <option value="1:00"<?php if ($strEnd == "1:00") { echo " selected=\"selected\""; } ?>>1:00</option>
				 <option value="1:30"<?php if ($strEnd == "1:30") { echo " selected=\"selected\""; } ?>>1:30</option>
				 <option value="2:00"<?php if ($strEnd == "2:00") { echo " selected=\"selected\""; } ?>>2:00</option>
				 <option value="2:30"<?php if ($strEnd == "2:30") { echo " selected=\"selected\""; } ?>>2:30</option>
				 <option value="3:00"<?php if ($strEnd == "3:00") { echo " selected=\"selected\""; } ?>>3:00</option>
				 <option value="3:30"<?php if ($strEnd == "3:30") { echo " selected=\"selected\""; } ?>>3:30</option>
				 <option value="4:00"<?php if ($strEnd == "4:00") { echo " selected=\"selected\""; } ?>>4:00</option>
				 <option value="4:30"<?php if ($strEnd == "4:30") { echo " selected=\"selected\""; } ?>>4:30</option>
				 <option value="5:00"<?php if ($strEnd == "5:00") { echo " selected=\"selected\""; } ?>>5:00</option>
				 <option value="5:30"<?php if ($strEnd == "5:30") { echo " selected=\"selected\""; } ?>>5:30</option>
				 <option value="6:00"<?php if ($strEnd == "6:00") { echo " selected=\"selected\""; } ?>>6:00</option>
				 <option value="6:30"<?php if ($strEnd == "6:30") { echo " selected=\"selected\""; } ?>>6:30</option>
				 <option value="7:00"<?php if ($strEnd == "7:00") { echo " selected=\"selected\""; } ?>>7:00</option>
				 <option value="7:30"<?php if ($strEnd == "7:30") { echo " selected=\"selected\""; } ?>>7:30</option>
				 <option value="8:00"<?php if ($strEnd == "8:00") { echo " selected=\"selected\""; } ?>>8:00</option>
				 <option value="8:30"<?php if ($strEnd == "8:30") { echo " selected=\"selected\""; } ?>>8:30</option>
				 <option value="9:00"<?php if ($strEnd == "9:00") { echo " selected=\"selected\""; } ?>>9:00</option>
				 <option value="9:30"<?php if ($strEnd == "9:30") { echo " selected=\"selected\""; } ?>>9:30</option>
				 <option value="10:00"<?php if ($strEnd == "10:00") { echo " selected=\"selected\""; } ?>>10:00</option>
				 <option value="10:30"<?php if ($strEnd == "10:30") { echo " selected=\"selected\""; } ?>>10:30</option>
				 <option value="11:00"<?php if ($strEnd == "11:00") { echo " selected=\"selected\""; } ?>>11:00</option>
				 <option value="11:30"<?php if ($strEnd == "11:30") { echo " selected=\"selected\""; } ?>>11:30</option>
				</select>
				<select name="endM" size="1">
				 <option value="">-- AM/PM --</option>
				 <option value="am"<?php if ($strEndM == "am") { echo " selected=\"selected\""; } ?>>am</option>
				 <option value="pm"<?php if ($strEndM == "pm") { echo " selected=\"selected\""; } ?>>pm</option>
				</select>
			</td>
		</tr>
	</table>
	</p>
	<p>Cover Charge?</p>
	<input type="text" value="<?php echo stripslashes($strCover); ?>" name="cover" size="10" />
	<p>Revenue: <font size="1" color="#666666">(Note: This is for reporting purposes only, it will not be shown on your web page, ever)</font></p>
	$ <input type="text" value="<?php echo stripslashes($strRevenue); ?>" name="revenue" size="10" />
	<p>Miscellaneous Show Information:</p>
	<textarea name="info" rows="5" cols="60"><?php echo stripslashes($strInfo); ?></textarea>
	<p class="submit"><input type="submit" name="update" value="Add this Show" /></p>
	<p>&nbsp;</p>
	<p><font size="1">* Denotes required field(s)</font></p>
</form>
<?php
	}
	else
	{
		//initialize variables
		$id = $_POST['id'];
		$strVenue = $_POST['venue'];
		$strStart = $_POST['start'];
		$strStartM = $_POST['startM'];
		$strEnd = $_POST['end'];
		$strEndM = $_POST['endM'];
		$strCover = $_POST['cover'];
		$strRevenue = $_POST['revenue'];
		//clean the 'info' syntax
		$strInfo = $_POST["info"];
		$strInfo = trim($strInfo);
		$arrLineReturns = array("\r\n", "\n", "\r");
		$strReplace = "</p><p>";
		$strInfo = "<p>".str_replace($arrLineReturns, $strReplace, $strInfo)."</p>";
		//populate Date variables
		$strDisplayDate = "";
		$dtmDate = "";
		if ($_POST['year'] && $_POST['month'] && $_POST['day'])
		{
			$dtmDate = $_POST['year']."/".$_POST['month']."/".$_POST['day'];
			$strDisplayDate = date("m-d-y", mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
		}
		//set boolean variables for error checking
		$blnInvalidDate = false;
		if ($dtmDate < date("Y/m/d")) { $blnInvalidDate = true; }
		$blnNewVenue = false;
		if ($strVenue == "new")
		{
			$blnNewVenue = true;
			$strName = $_POST['vName'];
			$strName = str_replace("&","&amp;",$strName);
			$strAddress = $_POST['vAddress'];
			$strCity = $_POST['vCity'];
			$strState = $_POST['vState'];
			$strZip = $_POST['vZip'];
			$strURL = $_POST['vURL'];
			if (stripslashes($strURL) == "http://") { $strURL = ""; }
			$strEmail = $_POST['vEmail'];
			$strPhone = $_POST['vPhone'];
		}

		/********************************************************
		*                  BEGIN ERROR CHECKING                 *
		********************************************************/
		if (!$strVenue ||
		!$strStart ||
		!$strStartM ||
		($strEnd && !$strEndM) ||
		!$_POST["day"] ||
		!$_POST["month"] ||
		!$_POST["year"] ||
		(($blnNewVenue == true) && !$strName) ||
		(($blnNewVenue == true) && !$strAddress) ||
		(($blnNewVenue == true) && !$strCity) ||
		(($blnNewVenue == true) && !$strState) ||
		$blnInvalidDate)
		{ // START IF there are errors in the entry form
			$strSQL = "select venue_ID, venue_name from venue order by venue_name;";
			$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
?>

<form name="admin_show_add" method="post" action="">
	<input type="hidden" name="enter" value="true" />
	<p><?php if (!$_POST["day"] || !$_POST["month"] || !$_POST["year"] || $blnInvalidDate) { echo "<font color=\"red\">Show Date:*</font>"; }else{ echo "Show Date:*"; } if ($_POST["day"] && $_POST["month"] && $_POST["year"] && $blnInvalidDate) { echo "<p><font color=\"red\">You entered a past date! Please enter future dates only.</font></p>"; } ?></p>
	<select name="month" size="1">
	 <option value="">-- Select Month --</option>
	 <option value="01"<?php if ($_POST["month"] == "01") { echo " selected=\"selected\""; } ?>>January</option>
	 <option value="02"<?php if ($_POST["month"] == "02") { echo " selected=\"selected\""; } ?>>February</option>
	 <option value="03"<?php if ($_POST["month"] == "03") { echo " selected=\"selected\""; } ?>>March</option>
	 <option value="04"<?php if ($_POST["month"] == "04") { echo " selected=\"selected\""; } ?>>April</option>
	 <option value="05"<?php if ($_POST["month"] == "05") { echo " selected=\"selected\""; } ?>>May</option>
	 <option value="06"<?php if ($_POST["month"] == "06") { echo " selected=\"selected\""; } ?>>June</option>
	 <option value="07"<?php if ($_POST["month"] == "07") { echo " selected=\"selected\""; } ?>>July</option>
	 <option value="08"<?php if ($_POST["month"] == "08") { echo " selected=\"selected\""; } ?>>August</option>
	 <option value="09"<?php if ($_POST["month"] == "09") { echo " selected=\"selected\""; } ?>>September</option>
	 <option value="10"<?php if ($_POST["month"] == "10") { echo " selected=\"selected\""; } ?>>October</option>
	 <option value="11"<?php if ($_POST["month"] == "11") { echo " selected=\"selected\""; } ?>>November</option>
	 <option value="12"<?php if ($_POST["month"] == "12") { echo " selected=\"selected\""; } ?>>December</option>
	</select>
	<select name="day" size="1">
	 <option value="">-- Select Day --</option>
	 <option value="01"<?php if ($_POST["day"] == "01") { echo " selected=\"selected\""; } ?>>01</option>
	 <option value="02"<?php if ($_POST["day"] == "02") { echo " selected=\"selected\""; } ?>>02</option>
	 <option value="03"<?php if ($_POST["day"] == "03") { echo " selected=\"selected\""; } ?>>03</option>
	 <option value="04"<?php if ($_POST["day"] == "04") { echo " selected=\"selected\""; } ?>>04</option>
	 <option value="05"<?php if ($_POST["day"] == "05") { echo " selected=\"selected\""; } ?>>05</option>
	 <option value="06"<?php if ($_POST["day"] == "06") { echo " selected=\"selected\""; } ?>>06</option>
	 <option value="07"<?php if ($_POST["day"] == "07") { echo " selected=\"selected\""; } ?>>07</option>
	 <option value="08"<?php if ($_POST["day"] == "08") { echo " selected=\"selected\""; } ?>>08</option>
	 <option value="09"<?php if ($_POST["day"] == "09") { echo " selected=\"selected\""; } ?>>09</option>
	 <option value="10"<?php if ($_POST["day"] == "10") { echo " selected=\"selected\""; } ?>>10</option>
	 <option value="11"<?php if ($_POST["day"] == "11") { echo " selected=\"selected\""; } ?>>11</option>
	 <option value="12"<?php if ($_POST["day"] == "12") { echo " selected=\"selected\""; } ?>>12</option>
	 <option value="13"<?php if ($_POST["day"] == "13") { echo " selected=\"selected\""; } ?>>13</option>
	 <option value="14"<?php if ($_POST["day"] == "14") { echo " selected=\"selected\""; } ?>>14</option>
	 <option value="15"<?php if ($_POST["day"] == "15") { echo " selected=\"selected\""; } ?>>15</option>
	 <option value="16"<?php if ($_POST["day"] == "16") { echo " selected=\"selected\""; } ?>>16</option>
	 <option value="17"<?php if ($_POST["day"] == "17") { echo " selected=\"selected\""; } ?>>17</option>
	 <option value="18"<?php if ($_POST["day"] == "18") { echo " selected=\"selected\""; } ?>>18</option>
	 <option value="19"<?php if ($_POST["day"] == "19") { echo " selected=\"selected\""; } ?>>19</option>
	 <option value="20"<?php if ($_POST["day"] == "20") { echo " selected=\"selected\""; } ?>>20</option>
	 <option value="21"<?php if ($_POST["day"] == "21") { echo " selected=\"selected\""; } ?>>21</option>
	 <option value="22"<?php if ($_POST["day"] == "22") { echo " selected=\"selected\""; } ?>>22</option>
	 <option value="23"<?php if ($_POST["day"] == "23") { echo " selected=\"selected\""; } ?>>23</option>
	 <option value="24"<?php if ($_POST["day"] == "24") { echo " selected=\"selected\""; } ?>>24</option>
	 <option value="25"<?php if ($_POST["day"] == "25") { echo " selected=\"selected\""; } ?>>25</option>
	 <option value="26"<?php if ($_POST["day"] == "26") { echo " selected=\"selected\""; } ?>>26</option>
	 <option value="27"<?php if ($_POST["day"] == "27") { echo " selected=\"selected\""; } ?>>27</option>
	 <option value="28"<?php if ($_POST["day"] == "28") { echo " selected=\"selected\""; } ?>>28</option>
	 <option value="29"<?php if ($_POST["day"] == "29") { echo " selected=\"selected\""; } ?>>29</option>
	 <option value="30"<?php if ($_POST["day"] == "30") { echo " selected=\"selected\""; } ?>>30</option>
	 <option value="31"<?php if ($_POST["day"] == "31") { echo " selected=\"selected\""; } ?>>31</option>
	</select>
	<select name="year" size="1">
	 <option value="<?php echo date("Y");?>"<?php if ($_POST["year"] == date("Y")) { echo " selected=\"selected\""; } ?>><?php echo date("Y");?></option>
	 <option value="<?php echo date("Y")+1;?>"<?php if ($_POST["year"] == (date("Y")+1)) { echo " selected=\"selected\""; } ?>><?php echo date("Y")+1;?></option>
	 <option value="<?php echo date("Y")+2;?>"<?php if ($_POST["year"] == (date("Y")+2)) { echo " selected=\"selected\""; } ?>><?php echo date("Y")+2;?></option>
	</select>
	<p><?php if (!$strVenue) { echo "<font color=\"red\">Venue:*</font>"; }else{ echo "Venue:*"; } ?></p>
	<select id="venue" name="venue" size="1" onchange="blockVenue();">
	 <option value="">-- Select Venue --</option>
	 <option value="new"<?php if ($strVenue == "new") { echo " selected=\"selected\""; } ?>>-- Add New --</option>
<?php
while ($row = mysql_fetch_array($qrySQL)) {
	$id = $row["venue_ID"];
	$strVenueName = $row["venue_name"];

	if ($strVenue == $id)
	{
		echo "\t <option value=\"$id\" selected=\"selected\">$strVenueName</option>\n";
	}
	else
	{
		echo "\t <option value=\"$id\">$strVenueName</option>\n";
	}
}

?>

	</select>
	<p>

	<div id="addVenue"<?php if ($strVenue == "new") { echo " style=\"display:block;\""; } ?>>
		<fieldset>
			<legend>New Venue Information</legend>
			<p><?php if ($strVenue == "new" && !$strName) { echo "<font color=\"red\">Name:*</font>"; }else{ echo "Name:*"; } ?></p>
			<input type="text" name="vName" maxlength="100" value="<?php echo stripslashes($strName); ?>" size="30" />
			<p><?php if ($strVenue == "new" && !$strAddress) { echo "<font color=\"red\">Address:*</font>"; }else{ echo "Address:*"; } ?></p>
			<input type="text" name="vAddress" maxlength="100" value="<?php echo stripslashes($strAddress); ?>" size="30" />
			<p><?php if ($strVenue == "new" && !$strCity) { echo "<font color=\"red\">City:*</font>"; }else{ echo "City:*"; } ?></p>
			<input type="text" name="vCity" maxlength="100" value="<?php echo stripslashes($strCity); ?>" size="30" />
			<p><?php if ($strVenue == "new" && !$strState) { echo "<font color=\"red\">State:*</font>"; }else{ echo "State:*"; } ?></p>
			<select name="vState" size="1">
			 <option value="">-- Select State --</option>
			 <option value="CT"<?php if ($strState == "CT") { echo " selected=\"selected\""; } ?>>CT</option>
			 <option value="NY"<?php if ($strState == "NY") { echo " selected=\"selected\""; } ?>>NY</option>
			 <option value="NY"<?php if ($strState == "RI") { echo " selected=\"selected\""; } ?>>RI</option>
			 <option value="NJ"<?php if ($strState == "NJ") { echo " selected=\"selected\""; } ?>>NJ</option>
			 <option value="NH"<?php if ($strState == "NH") { echo " selected=\"selected\""; } ?>>NH</option>
			 <option value="VT"<?php if ($strState == "VT") { echo " selected=\"selected\""; } ?>>VT</option>
			 <option value="MA"<?php if ($strState == "MA") { echo " selected=\"selected\""; } ?>>MA</option>
			</select>
			<p>Zip Code:</p>
			<input type="text" name="vZip" maxlength="5" value="<?php echo $strZip; ?>" size="10" />
			<p>Web Addres: <font size="1">(if applicable)</font></p>
			<input type="text" name="vURL" maxlength="100" value="<?php echo stripslashes($strURL); ?>" size="30" />
			<p>E-mail: <font size="1">(if applicable)</font></p>
			<input type="text" name="vEmail" maxlength="100" value="<?php echo stripslashes($strEmail); ?>" size="30" />
			<p>Phone: <font size="1">(XXX-XXX-XXXX)</font></p>
			<input type="text" name="vPhone" maxlength="100" value="<?php echo stripslashes($strPhone); ?>" size="30" />
		</fieldset>
	</div>

	<table>
		<tr>
			<td align="left" valign="top"><?php if (!$strStart) { echo "<font color=\"red\">Start Time:*</font>"; }else{ echo "Start Time:*"; } if (!$strStartM) { echo "<p><font color=\"red\">You forgot to indicate AM or PM!</font></p>"; } ?></td>
			<td align="left" valign="top">End Time:<?php if ($strEnd && !$strEndM) { echo "<p><font color=\"red\">You entered an End Time without indicating AM or PM!</font></p>"; } ?></td>
		</tr>
		<tr>
			<td align="left">
				<select name="start" size="1">
				 <option value="">-- Select Start Time --</option>
				 <option value="12:00"<?php if ($strStart == "12:00") { echo " selected=\"selected\""; } ?>>12:00</option>
				 <option value="12:30"<?php if ($strStart == "12:30") { echo " selected=\"selected\""; } ?>>12:30</option>
				 <option value="1:00"<?php if ($strStart == "1:00") { echo " selected=\"selected\""; } ?>>1:00</option>
				 <option value="1:30"<?php if ($strStart == "1:30") { echo " selected=\"selected\""; } ?>>1:30</option>
				 <option value="2:00"<?php if ($strStart == "2:00") { echo " selected=\"selected\""; } ?>>2:00</option>
				 <option value="2:30"<?php if ($strStart == "2:30") { echo " selected=\"selected\""; } ?>>2:30</option>
				 <option value="3:00"<?php if ($strStart == "3:00") { echo " selected=\"selected\""; } ?>>3:00</option>
				 <option value="3:30"<?php if ($strStart == "3:30") { echo " selected=\"selected\""; } ?>>3:30</option>
				 <option value="4:00"<?php if ($strStart == "4:00") { echo " selected=\"selected\""; } ?>>4:00</option>
				 <option value="4:30"<?php if ($strStart == "4:30") { echo " selected=\"selected\""; } ?>>4:30</option>
				 <option value="5:00"<?php if ($strStart == "5:00") { echo " selected=\"selected\""; } ?>>5:00</option>
				 <option value="5:30"<?php if ($strStart == "5:30") { echo " selected=\"selected\""; } ?>>5:30</option>
				 <option value="6:00"<?php if ($strStart == "6:00") { echo " selected=\"selected\""; } ?>>6:00</option>
				 <option value="6:30"<?php if ($strStart == "6:30") { echo " selected=\"selected\""; } ?>>6:30</option>
				 <option value="7:00"<?php if ($strStart == "7:00") { echo " selected=\"selected\""; } ?>>7:00</option>
				 <option value="7:30"<?php if ($strStart == "7:30") { echo " selected=\"selected\""; } ?>>7:30</option>
				 <option value="8:00"<?php if ($strStart == "8:00") { echo " selected=\"selected\""; } ?>>8:00</option>
				 <option value="8:30"<?php if ($strStart == "8:30") { echo " selected=\"selected\""; } ?>>8:30</option>
				 <option value="9:00"<?php if ($strStart == "9:00") { echo " selected=\"selected\""; } ?>>9:00</option>
				 <option value="9:30"<?php if ($strStart == "9:30") { echo " selected=\"selected\""; } ?>>9:30</option>
				 <option value="10:00"<?php if ($strStart == "10:00") { echo " selected=\"selected\""; } ?>>10:00</option>
				 <option value="10:30"<?php if ($strStart == "10:30") { echo " selected=\"selected\""; } ?>>10:30</option>
				 <option value="11:00"<?php if ($strStart == "11:00") { echo " selected=\"selected\""; } ?>>11:00</option>
				 <option value="11:30"<?php if ($strStart == "11:30") { echo " selected=\"selected\""; } ?>>11:30</option>
				</select>
				<select name="startM" size="1">
				 <option value="">-- AM/PM --</option>
				 <option value="am"<?php if ($strStartM == "am") { echo " selected=\"selected\""; } ?>>am</option>
				 <option value="pm"<?php if ($strStartM == "pm") { echo " selected=\"selected\""; } ?>>pm</option>
				</select>
				&nbsp;&nbsp;
			</td>
			<td align="left">
				<select name="end" size="1">
				 <option value="">-- Select End Time --</option>
				 <option value="12:00"<?php if ($strEnd == "12:00") { echo " selected=\"selected\""; } ?>>12:00</option>
				 <option value="12:30"<?php if ($strEnd == "12:30") { echo " selected=\"selected\""; } ?>>12:30</option>
				 <option value="1:00"<?php if ($strEnd == "1:00") { echo " selected=\"selected\""; } ?>>1:00</option>
				 <option value="1:30"<?php if ($strEnd == "1:30") { echo " selected=\"selected\""; } ?>>1:30</option>
				 <option value="2:00"<?php if ($strEnd == "2:00") { echo " selected=\"selected\""; } ?>>2:00</option>
				 <option value="2:30"<?php if ($strEnd == "2:30") { echo " selected=\"selected\""; } ?>>2:30</option>
				 <option value="3:00"<?php if ($strEnd == "3:00") { echo " selected=\"selected\""; } ?>>3:00</option>
				 <option value="3:30"<?php if ($strEnd == "3:30") { echo " selected=\"selected\""; } ?>>3:30</option>
				 <option value="4:00"<?php if ($strEnd == "4:00") { echo " selected=\"selected\""; } ?>>4:00</option>
				 <option value="4:30"<?php if ($strEnd == "4:30") { echo " selected=\"selected\""; } ?>>4:30</option>
				 <option value="5:00"<?php if ($strEnd == "5:00") { echo " selected=\"selected\""; } ?>>5:00</option>
				 <option value="5:30"<?php if ($strEnd == "5:30") { echo " selected=\"selected\""; } ?>>5:30</option>
				 <option value="6:00"<?php if ($strEnd == "6:00") { echo " selected=\"selected\""; } ?>>6:00</option>
				 <option value="6:30"<?php if ($strEnd == "6:30") { echo " selected=\"selected\""; } ?>>6:30</option>
				 <option value="7:00"<?php if ($strEnd == "7:00") { echo " selected=\"selected\""; } ?>>7:00</option>
				 <option value="7:30"<?php if ($strEnd == "7:30") { echo " selected=\"selected\""; } ?>>7:30</option>
				 <option value="8:00"<?php if ($strEnd == "8:00") { echo " selected=\"selected\""; } ?>>8:00</option>
				 <option value="8:30"<?php if ($strEnd == "8:30") { echo " selected=\"selected\""; } ?>>8:30</option>
				 <option value="9:00"<?php if ($strEnd == "9:00") { echo " selected=\"selected\""; } ?>>9:00</option>
				 <option value="9:30"<?php if ($strEnd == "9:30") { echo " selected=\"selected\""; } ?>>9:30</option>
				 <option value="10:00"<?php if ($strEnd == "10:00") { echo " selected=\"selected\""; } ?>>10:00</option>
				 <option value="10:30"<?php if ($strEnd == "10:30") { echo " selected=\"selected\""; } ?>>10:30</option>
				 <option value="11:00"<?php if ($strEnd == "11:00") { echo " selected=\"selected\""; } ?>>11:00</option>
				 <option value="11:30"<?php if ($strEnd == "11:30") { echo " selected=\"selected\""; } ?>>11:30</option>
				</select>
				<select name="endM" size="1">
				 <option value="">-- AM/PM --</option>
				 <option value="am"<?php if ($strEndM == "am") { echo " selected=\"selected\""; } ?>>am</option>
				 <option value="pm"<?php if ($strEndM == "pm") { echo " selected=\"selected\""; } ?>>pm</option>
				</select>
			</td>
		</tr>
	</table>
	</p>
	<p>Cover Charge?</p>
	<input type="text" value="<?php echo stripslashes($strCover); ?>" name="cover" size="10" />
	<p>Revenue: <font size="1" color="#666666">(Note: This is for reporting purposes only, it will not be shown on your web page, ever)</font></p>
	$ <input type="text" value="<?php echo stripslashes($strRevenue); ?>" name="revenue" size="10" />
	<p>Miscellaneous Show Information:</p>
	<textarea name="info" rows="5" cols="60"><?php echo stripslashes($_POST["info"]); ?></textarea>
	<p class="submit"><input type="submit" name="update" value="Add this Show" /></p>
	<p>&nbsp;</p>
	<p><font size="1">* Denotes required field(s)</font></p>
</form>
<?php

		} // END IF there are errors in the entry form
		/********************************************************
		*                   END ERROR CHECKING                  *
		********************************************************/
		else
		{ // START ELSE no errors found
			/***********************************************************************************
			*                          Start Printing Success!                                 *
			***********************************************************************************/
			if ($blnNewVenue)
			{
				$strSQL = "INSERT INTO venue (venue_name, venue_street, venue_city, venue_state, venue_zip, venue_url, venue_email, venue_phone) ";
				$strSQL .= "VALUES (\"$strName\", \"$strAddress\", \"$strCity\", \"$strState\", \"$strZip\", \"$strURL\", \"$strEmail\", \"$strPhone\");";
				$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query

				$strSQL = "SELECT venue_ID, venue_name from venue ";
				$strSQL .= "where venue_name=\"$strName\" and venue_street=\"$strAddress\" and venue_city=\"$strCity\" and venue_state=\"$strState\" LIMIT 1;";
				$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
				$row = mysql_fetch_row($qrySQL);
				$strVenue = $row[0];
				$strName = $row[1];
			}
			else
			{
				$strSQL = "SELECT venue_name from venue ";
				$strSQL .= "where venue_ID=\"$strVenue\" LIMIT 1;";
				$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
				$row = mysql_fetch_row($qrySQL);
				$strName = $row[0];
			}

			$strStart = $strStart." ".$strStartM;
			$strEnd = $strEnd." ".$strEndM;
			$strSQL = "INSERT INTO shows
													(show_date, show_date_display, show_venue_ID, show_cover, show_time_start, show_time_end, show_info, show_revenue)
													values
													(\"$dtmDate\", \"$strDisplayDate\", \"$strVenue\", \"$strCover\", \"$strStart\", \"$strEnd\", \"$strInfo\", \"$strRevenue\");";
			$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query

?>

<p><font color="green">The following show was successfully added!</font></p>
<p>&nbsp;</p>
<p><strong>Date:</strong> <?php echo $strDisplayDate; ?></p>
<p><strong>Venue:</strong> <?php echo $strName; ?></p>
<p><strong>Cover:</strong> <?php echo $strCover; ?></p>
<p><strong>Start Time:</strong> <?php echo $strStart; ?></p>
<p><strong>End Time:</strong> <?php echo $strEnd; ?></p>
<p><strong>Info:</strong> <?php echo stripslashes($strInfo); ?></p>
<p><strong>Revenue:</strong> <?php echo $strRevenue; ?></p>
<p>&nbsp;</p>
<?php
			if ($blnNewVenue)
			{
?>

<div id="addVenue" style="display:block;">
	<fieldset>
		<legend>**New Venue Added**</legend>
		<p><strong>Name:</strong> <?php echo $strName; ?></p>
		<p><strong>Address:</strong> <?php echo $strAddress; ?></p>
		<p><strong>City:</strong> <?php echo $strCity; ?></p>
		<p><strong>State:</strong> <?php echo $strState; ?></p>
		<p><strong>Zip Code:</strong> <?php echo $strZip; ?></p>
		<p><strong>Web Addres:</strong> <?php echo $strURL; ?></p>
		<p><strong>E-mail:</strong> <?php echo $strEmail; ?></p>
		<p><strong>Phone:</strong> <?php echo $strPhone; ?></p>
	</fieldset>
</div>
<?php
			}
			/***********************************************************************************
			*                            End Printing Success!                                 *
			***********************************************************************************/


			/***********************************************************************************
			*                          Start Generating RSS Feed                               *
			***********************************************************************************/

			require("rss_shows.php");

			/***********************************************************************************
			*                          Finish Generating RSS Feed                              *
			***********************************************************************************/

		} // END ELSE no errors found
	} // END ELSE form was submitted
}
else
{
	require ("login.php"); // user is not logged in, send them to the login page
}
?>
