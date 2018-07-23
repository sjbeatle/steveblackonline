<?php
session_start();
require ("config.php");
/************* FIRST CHECK IF THE USER IS LOGGED IN **************/
if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{	
	if (!$_POST['submit'])
	{ // START IF venue hasn't been submitted, display the entry form
?>

<form name="admin_venue_add" method="post" action="">
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
	<p class="submit"><input type="submit" name="submit" value="Add Venue" /></p>
	<p>&nbsp;</p>
	<p><font size="1">* Denotes required field(s)</font></p>
</form>
<?php
	} // END IF venue hasn't been added, display the entry form.
	else
	{ // START ELSE venue has been added.
		//initialize variables
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
	<input type="text" name="vURL" maxlength="100" value="<?php echo stripslashes($strURL); ?>" size="50" />
	<p>E-mail: <font size="1">(if applicable)</font></p>
	<input type="text" name="vEmail" maxlength="100" value="<?php echo stripslashes($strEmail); ?>" size="30" />
	<p>Phone: <font size="1">(XXX-XXX-XXXX)</font></p>
	<input type="text" name="vPhone" maxlength="100" value="<?php echo stripslashes($strPhone); ?>" size="30" />
	<p class="submit"><input type="submit" name="submit" value="Add Venue" /></p>
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
			$strSQL = "INSERT INTO venue (venue_name, venue_street, venue_city, venue_state, venue_zip, venue_url, venue_email, venue_phone) ";
			$strSQL .= "VALUES (\"$strName\", \"$strAddress\", \"$strCity\", \"$strState\", \"$strZip\", \"$strURL\", \"$strEmail\", \"$strPhone\");";
			$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
			
			$strHTML = "\n<p><font color=\"green\">The following venue was successfully entered!</font></p>\n";
			$strHTML .= "<p>&nbsp;</p>\n";
			$strHTML .= "<p><strong>Name:</strong> ".stripslashes($strName)."</p>\n";
			$strHTML .= "<p><strong>Street:</strong> ".stripslashes($strAddress)."</p>\n";
			$strHTML .= "<p><strong>City:</strong> ".stripslashes($strCity)."</p>\n";
			$strHTML .= "<p><strong>State:</strong> ".stripslashes($strState)."</p>\n";
			$strHTML .= "<p><strong>Zip:</strong> $strZip</p>\n";
			$strHTML .= "<p><strong>Web Address:</strong> ".stripslashes($strURL)."</p>\n";
			$strHTML .= "<p><strong>E-mail:</strong> ".stripslashes($strEmail)."</p>\n";
			$strHTML .= "<p><strong>Phone:</strong> ".stripslashes($strPhone)."</p>\n";
			$strHTML .= "<p>&nbsp;</p>\n";
			$strHTML .= "<p><a href=\"index.php?page=addvenue\">Add Another Venue?</a></p>\n";
			
			echo $strHTML;
			/***********************************************************************************
			*                            End Printing Success!                                 *
			***********************************************************************************/
		} // END ELSE no errors found
	} // END ELSE a News Item has been added
}
else
{
	require ("login.php"); // user is not logged in, send them to the login page
}
?>