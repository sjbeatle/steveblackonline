<?php
session_start();
require ("config.php");
/************* FIRST CHECK IF THE USER IS LOGGED IN **************/
if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{	
	if (!$_POST['enter'])
	{ // START IF show(s) haven't been selected, display the entry form
		$strSQL = "select * from shows left outer join venue on shows.show_venue_ID = venue.venue_ID WHERE shows.show_date>=CURDATE() order by shows.show_date;"; 
		$qrySQL = mysql_query($strSQL) or die (mysql_error());
?>

<script type="text/javascript">
	function disp_confirm(form)
	{
		var r=confirm("The show(s) will be deleted permanently.\r\nAre you sure you want to proceed?");
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
	<p>Select the show(s) you would like to delete...</p>
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
	 
	 echo "\t<p><input type=\"checkbox\" name=\"delete$id\" value=\"$id\" /> <strong>$strDate:</strong> $strName in $strCity, $strState from $strTimeStart - $strTimeEnd</p>\n";
}
?>

	<p class="submit"><input type="button" name="check" value="Delete Show(s)" onclick="disp_confirm(this.form);" /></p>
</form>
<?php
	} // END IF show(s) haven't been selected, display the entry form.
	else
	{ // START ELSE delete show
		$strSQL = "select * from shows left outer join venue on shows.show_venue_ID = venue.venue_ID WHERE shows.show_date>=CURDATE() order by shows.show_date;"; 
		$qrySQL = mysql_query($strSQL) or die (mysql_error());
		
		while ($row = mysql_fetch_array($qrySQL))
		{
		  $id = $row["show_ID"];
		  $strName = $row["venue_name"];
		  $strCity = $row["venue_city"];
		  $strState = $row["venue_state"];
		  $strDate = $row["show_date_display"];
		  $strTimeStart = $row["show_time_start"];
		  $strTimeEnd = $row["show_time_end"];
			$compare = $_POST["delete$id"];
			
			if ($compare == $id) 
			{
				$strDelete = "DELETE FROM shows WHERE show_ID=$id;";
	 			echo "<p><strong>$strDate:</strong> $strName in $strCity, $strState from $strTimeStart - $strTimeEnd</p>\n";
				$qryDelete = mysql_query($strDelete) or die (mysql_error()); //run delete query
			}
 		}
		$strHTML = "<p>&nbsp;</p>\n";
		$strHTML .= "\n<p><font color=\"green\">The above show(s) have been deleted.</font></p>\n";
		
		echo $strHTML;
		

			/***********************************************************************************
			*                          Start Generating RSS Feed                               *
			***********************************************************************************/
				
			require("rss_shows.php");
						
			/***********************************************************************************
			*                          Finish Generating RSS Feed                              *
			***********************************************************************************/
		
	} // END ELSE delete show
}
else
{
	require ("login.php"); // user is not logged in, send them to the login page
}
?>