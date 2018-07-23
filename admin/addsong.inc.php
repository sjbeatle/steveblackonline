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
	if (!$_POST['submit'])
	{ // START Entry Form Display
		$strSQL = "select id, name from artists order by alpha_name;";
		$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the select query
?>

<form name="admin_song_add" method="post" action="">
	<p>Artist:*
	<select id="artist" name="artist" size="1">
	 <option value="">-- Select Artist --</option>
<?php
while ($row = mysql_fetch_array($qrySQL)) {
   $id = $row["id"];
   $strArtistName = $row["name"];
	 
	 echo "\t <option value=\"$id\">$strArtistName</option>\n";
}

?>

	</select>
	</p>

	<p>Title:*
	<input type="text" value="" name="title" style="width:150px;" />
	</p>

	<p class="submit"><input type="submit" name="submit" value="Add Song" /></p>
	<p>&nbsp;</p>
	<p><font size="1">* Denotes required field(s)</font></p>
</form>
<?php
	} // END Entry Form Display
	else
	{ // START ELSE form was submitted
		//initialize variables
		$strArtist = $_POST['artist'];
		$strTitle = $_POST['title'];
		
		/********************************************************
		*                  BEGIN ERROR CHECKING                 *
		********************************************************/		
		if (!$strArtist ||
		!$strTitle)
		{ // START IF there are errors in the entry form
			$strSQL = "select id, name from artists order by alpha_name;";
			$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the select query
?>

<form name="admin_song_add" method="post" action="">
	<p><?php if (!$strArtist) { echo "<font color=\"red\">Artist:*</font>"; }else{ echo "Artist:*"; } ?>
	<select id="artist" name="artist" size="1">
	 <option value="">-- Select Artist --</option>
<?php
while ($row = mysql_fetch_array($qrySQL)) {
	$id = $row["id"];
	$strArtistName = $row["name"];
	 
	if ($strArtist == $id)
	{
		echo "\t <option value=\"$id\" selected=\"selected\">$strArtistName</option>\n";
	}
	else
	{
		echo "\t <option value=\"$id\">$strArtistName</option>\n";
	}		
}

?>

	</select>
	</p>
	<p><?php if (!$strTitle) { echo "<font color=\"red\">Title:*</font>"; }else{ echo "Title:*"; } ?>
	<input type="text" name="title" value="<?php echo stripslashes($strTitle); ?>" style="width:150px;" />
	</p>

	<p class="submit"><input type="submit" name="submit" value="Add Song" /></p>
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
			$strSQL = "SELECT name from artists ";
			$strSQL .= "where id=\"$strArtist\" LIMIT 1;";
			$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
			$row = mysql_fetch_row($qrySQL);
			$strName = $row[0];
			$strSQL = "INSERT INTO songs (artists_id, title) ";
			$strSQL .= "VALUES (\"$strArtist\", \"$strTitle\");";
			$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
			
?>

<p><font color="green">The following song was successfully entered!</font></p>
<div style="padding-left: 20px;">
	<p><strong>Artist:</strong> <?php echo $strName; ?></p>
	<p><strong>Title:</strong> <?php echo stripslashes($strTitle); ?></p>
	<p>&nbsp;</p>
</div>

	<p><a href="index.php?page=addsong">Add Another Song?</a></p>
<?php			
			
			/***********************************************************************************
			*                            End Printing Success!                                 *
			***********************************************************************************/
		} // END ELSE no errors found
	} // END ELSE form was submitted
}
else
{
	require ("login.php"); // user is not logged in, send them to the login page
}
?>