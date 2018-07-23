<?php
session_start();
require ("config.php");
/************* FIRST CHECK IF THE USER IS LOGGED IN **************/
if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{	
	if (!$_POST['enter'])
	{ // START IF venue hasn't been selected, display the entry form
		$strSQL = "select * from venue order by venue_name;";
		$qrySQL = mysql_query($strSQL) or die (mysql_error());
?>

<form name="edit" method="post" action="index.php?page=editvenue">
	<input type="hidden" name="enter" value="true" />
	<p>Select the venue you would like to edit...</p>
	<p>&nbsp;</p>
<?php
while ($row = mysql_fetch_array($qrySQL)) {
   $id = $row["venue_ID"];
   $strName = $row["venue_name"];
	 $strStreet = $row["venue_street"];
	 $strCity = $row["venue_city"];
	 $strState = $row["venue_state"];
	 
	 echo "\t<p><input type=\"radio\" name=\"editVenue\" value=\"$id\" onclick=\"this.form.submit();\" /> <strong>$strName</strong> $strCity, $strState</p>\n";
}
?>
</form>
<?php
	} // END IF venue hasn't been selected, display the entry form.
	else if (!$_POST['update'])
	{ // START ELSE venue has been selected.
		$id = $_POST['editVenue'];
		$strSQL = "select venue_name, venue_street, venue_city, venue_state, venue_zip, venue_url, venue_email, venue_phone from venue where venue_ID=$id;";
		$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
		$row = mysql_fetch_row($qrySQL);
		
		//initialize variables
		$strName = $row[0];
		$strAddress = $row[1];
		$strCity = $row[2];
		$strState = $row[3];
		$strZip = $row[4];
		$strURL = $row[5];
		$strEmail = $row[6];
		$strPhone = $row[7];
?>

<form name="admin_venue_edit" method="post" action="">
	<input type="hidden" name="enter" value="true" />
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<p>Name:*</p>
	<input type="text" name="vName" maxlength="100" value="<?php echo stripslashes($strName); ?>" size="30" />
	<p>Address:*</p>
	<input type="text" name="vAddress" maxlength="100" value="<?php echo stripslashes($strAddress); ?>" size="30" />
	<p>City:*</p>
	<input type="text" name="vCity" maxlength="100" value="<?php echo stripslashes($strCity); ?>" size="30" />
	<p>State:*</p>
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
	<p class="submit"><input type="submit" name="update" value="Update this Venue" /></p>
	<p>&nbsp;</p>
	<p><font size="1">* Denotes required field(s)</font></p>
</form>
<?php
	}
	else
	{
		//initialize variables
		$id = $_POST['id'];
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
		
		/***********************************
		*         CHECK FOR ERRORS         *
		***********************************/
		if (!$strName || !$strAddress || !$strCity || !$strState)
		{
?>

<form name="admin_venue_add" method="post" action="">
	<input type="hidden" name="enter" value="true" />
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<p><font color="red">Error! Some fields are missing or entered incorrectly.</font></p>
	<p><?php if (!$strName) { echo "<font color=\"red\">Name:*</font>"; }else{ echo "Name:*"; } ?></p>
	<input type="text" name="vName" maxlength="100" value="<?php echo stripslashes($strName); ?>" size="30" />
	<p><?php if (!$strAddress) { echo "<font color=\"red\">Address:*</font>"; }else{ echo "Address:*"; } ?></p>
	<input type="text" name="vAddress" maxlength="100" value="<?php echo stripslashes($strAddress); ?>" size="30" />
	<p><?php if (!$strCity) { echo "<font color=\"red\">City:*</font>"; }else{ echo "City:*"; } ?></p>
	<input type="text" name="vCity" maxlength="100" value="<?php echo stripslashes($strCity); ?>" size="30" />
	<p><?php if (!$strState) { echo "<font color=\"red\">State:*</font>"; }else{ echo "State:*"; } ?></p>
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
	<p class="submit"><input type="submit" name="update" value="Update this Venue" /></p>
	<p>&nbsp;</p>
	<p><font size="1">* Denotes required field(s)</font></p>
</form>
<?php
		}
		else
		{ // START ELSE no errors found
			/***********************************************************************************
			*                          Start Printing Success!                                 *
			***********************************************************************************/
			$strSQL = "update venue set
													venue_name=\"$strName\", 
													venue_street=\"$strAddress\", 
													venue_city=\"$strCity\", 
													venue_state=\"$strState\", 
													venue_zip=\"$strZip\", 
													venue_url=\"$strURL\", 
													venue_email=\"$strEmail\", 
													venue_phone=\"$strPhone\"
													where venue_ID=$id;";
			$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
			
			$strHTML = "\n<p><font color=\"green\">The following venue was successfully updated!</font></p>\n";
			$strHTML .= "<p>&nbsp;</p>\n";
			$strHTML .= "<p><strong>Name:</strong> ".stripslashes($strName)."</p>\n";
			$strHTML .= "<p><strong>Street:</strong> ".stripslashes($strAddress)."</p>\n";
			$strHTML .= "<p><strong>City:</strong> ".stripslashes($strCity)."</p>\n";
			$strHTML .= "<p><strong>State:</strong> ".stripslashes($strState)."</p>\n";
			$strHTML .= "<p><strong>Zip:</strong> $strZip</p>\n";
			$strHTML .= "<p><strong>Web Address:</strong> ".stripslashes($strURL)."</p>\n";
			$strHTML .= "<p><strong>E-mail:</strong> ".stripslashes($strEmail)."</p>\n";
			$strHTML .= "<p><strong>Phone:</strong> ".stripslashes($strPhone)."</p>\n";
			
			echo $strHTML;
			/***********************************************************************************
			*                            End Printing Success!                                 *
			***********************************************************************************/
			
			

			/***********************************************************************************
			*                          Start Generating RSS Feed                               *
			***********************************************************************************/
				
			$strRSS = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>\n";
			$strRSS .= "<rss version=\"2.0\">\n\n";
			$strRSS .= "<channel>\n\t";
			$strRSS .= "<title>Travis Winkley</title>\n\t";
			$strRSS .= "<link>http://www.traviswinkley.com</link>\n\t";
			$strRSS .= "<description>Solo, Acoustic Singer/Songwriter</description>\n\t";
			$strRSS .= "<copyright>2009 Travis Winkley. All rights reserved.</copyright>\n\t";
			$strRSS .= "<language>en-us</language>\n\t";
			
			$sqlRSS = "select * from shows left outer join venue on shows.show_venue_ID = venue.venue_ID WHERE shows.show_date>=CURDATE() order by shows.show_date limit 5;"; 
			$sqlRSS_main = mysql_query($sqlRSS) or die (mysql_error());
			 
			while ($row = mysql_fetch_array($sqlRSS_main)) {
				$idRSS = $row["show_ID"];
				$strNameRSS = $row["venue_name"];
				$strCityRSS = $row["venue_city"];
				$strStateRSS = $row["venue_state"];
				$strDateRSS = $row["show_date_display"];
				$strTimeStartRSS = $row["show_time_start"];
				$strTimeEndRSS = $row["show_time_end"];
					
				$strRSS .= "\n\t<item>\n\t\t";
				$strRSS .= "<title>".$strDateRSS.": ".$strNameRSS."</title>\n\t\t";
				$strRSS .= "<link>http://www.traviswinkley.com/shows.php?id=".$idRSS."</link>\n\t\t";
				$strRSS .= "<description>$strCityRSS, $strStateRSS $strTimeStartRSS - $strTimeEndRSS</description>\n\t";
				$strRSS .= "</item>\n";
			}
			
			$strRSS .= "</channel>\n\n";
			$strRSS .= "</rss>";
			
			$myFile = "/Applications/xampp/xamppfiles/htdocs/Travis Winkley/rss/rss.xml";
			$fh = fopen($myFile, 'w') or die("can't open file");
			fwrite($fh, $strRSS);
			fclose($fh);
						
			/***********************************************************************************
			*                          Finish Generating RSS Feed                              *
			***********************************************************************************/
		} // END ELSE no errors found
	} // END ELSE a News Item has been added
}
else
{
	require ("login.php"); // user is not logged in, send them to the login page
}
?>