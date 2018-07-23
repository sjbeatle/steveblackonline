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

<script type="text/javascript">
	function disp_confirm(form)
	{
		var r=confirm("The venue(s) will be deleted permanently.\r\nAre you sure you want to proceed?");
		if (r==true)
		{
			form.submit();
		}
		else
		{
			return false;
		}
	}
</script>
<form name="delete" method="post" action="">
	<input type="hidden" name="enter" value="true" />
	<p>Select the venue(s) you would like to delete...</p>
	<p>&nbsp;</p>
<?php
while ($row = mysql_fetch_array($qrySQL)) {
   $id = $row["venue_ID"];
   $strName = $row["venue_name"];
	 $strStreet = $row["venue_street"];
	 $strCity = $row["venue_city"];
	 $strState = $row["venue_state"];
	 
	 echo "\t<p><input type=\"checkbox\" name=\"delete$id\" value=\"$id\" /> <strong>$strName</strong> $strCity, $strState</p>\n";
}
?>

	<p class="submit"><input type="button" name="check" value="Delete Venue(s)" onclick="disp_confirm(this.form);" /></p>
</form>
<?php
	} // END IF venue hasn't been selected, display the entry form.
/*	else if (!$_POST['update'])
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
	<input type="hidden" name="submit" value="true" />
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
	} */
	else
	{ // START ELSE venue has been added.
		$strSQL = "select * from venue order by venue_ID;";
		$qrySQL = mysql_query($strSQL) or die (mysql_error());
		
		while ($row = mysql_fetch_array($qrySQL))
		{
			$id = $row["venue_ID"];
			$strName = $row["venue_name"];
			$strStreet = $row["venue_street"];
			$strCity = $row["venue_city"];
			$strState = $row["venue_state"];
			$compare = $_POST["delete$id"];
			
			if ($compare == $id) 
			{
				$strDelete = "DELETE FROM venue WHERE venue_ID=$id;";
				echo "<p><strong>$strName</strong> $strCity, $strState</p>\n";
				$qryDelete = mysql_query($strDelete) or die (mysql_error()); //run delete query
			}
 		}
		$strHTML = "<p>&nbsp;</p>\n";
		$strHTML .= "\n<p><font color=\"green\">The above venue(s) have been deleted.</font></p>\n";
		
		echo $strHTML;
	} // END ELSE a News Item has been added
}
else
{
	require ("login.php"); // user is not logged in, send them to the login page
}
?>