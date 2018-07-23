<?php
session_start();
require ("config.php");

if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
	require("admin_header.php");
	
	//set the variable to be the user's username
	$strUsername = $_SESSION['loggedin'];
	
	//check if the user has submitted the form
	if(isset ($_POST['submit']))
	{
		//declare variables from form
		$strCpass = $_POST['cpass'];
		$md5Cpass = md5 ($strCpass);
		$strNpass1 = $_POST['npass1'];
		$strNpass2 = $_POST['npass2'];

		//if user didn't type old password
		if (strlen ($strCpass) < 1)
		{
			print "<p align=\"center\">You need to enter your current Password</p>";
			print "<p align=\"center\"><a href=\"changepass.php\">Retry?</a></p>";
		}
		//if user didn't type new password
		else if (strlen ($strNpass1) < 1)
		{
			print "<p align=\"center\">You need to enter your new Password</p>";
			print "<p align=\"center\"><a href=\"changepass.php\">Retry?</a></p>";
		}
		//if user didn't confirm new password
		else if (strlen ($strNpass2) < 1)
		{
			print "<p align=\"center\">You need to confirm your new Password</p>";
			print "<p align=\"center\"><a href=\"changepass.php\">Retry?</a></p>";
		}
		//if new pass and confirm pass doesn't match
		else if ($strNpass1 != $strNpass2)
		{
			print "<p align=\"center\">Your new passwords don't match!</p>";
			print "<p align=\"center\"><a href=\"changepass.php\">Retry?</a></p>";
		}
		//so far so good...
		else
		{
			//check the current password = password in db
			$strSQL = "SELECT * FROM ".$mysql_pretext."_USERS where NAME='$strUsername' AND PASSWORD='$md5Cpass'";
			$qrySQL = mysql_query ($strSQL)	or die(mysql_error());
			$arrSQL = mysql_fetch_array ($qrySQL);

			//everything's ok!
			if ($arrSQL)
			{
				$md5Password = md5 ($strNpass1);
				$strUpdatepass = "UPDATE ".$mysql_pretext."_USERS set PASSWORD='$md5Password' where NAME='$strUsername'";
				mysql_query ($strUpdatepass) or die(mysql_error());

				//log the player out
				session_destroy();
				print "<p align=\"center\">Your password has been changed! Please <a href=\"index.php\">log in</a> again.</p>";
			}
			else
			{
				print "<p align=\"center\">Your current password is wrong!</p>";
				print "<p align=\"center\"><a href=\"changepass.php\">Retry?</a></p>";
			}
		}
	}
	else
	{
?>

	<p id="admin_title"><strong>Change Your Password</strong></p>
	<form method="post" action="changepass.php" name="changepass">
		<p>Current Password: <input type="password" name="cpass" size="20"></p>
		<p>New Password:&nbsp;&nbsp;<input type="password" name="npass1" size="20"></p>
		<p>Confirm New Password:<input type="password" name="npass2" size="20"></p>
		<p><input type="submit" value="Continue" name="submit" /></p>
	</form>

<?
	}
	require("admin_footer.php");
}
//if user is not logged in
else
{
	require ("login.php");
}
?>