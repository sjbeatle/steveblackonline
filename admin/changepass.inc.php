<?php
session_start();
require ("config.php");

if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{	
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
			print "\n\t\t\t\t\t<p>You need to enter your current Password</p>";
			print "\n\t\t\t\t\t<p><a href=\"changepass.inc.php?page=changepass\">Retry?</a></p>\n";
		}
		//if user didn't type new password
		else if (strlen ($strNpass1) < 1)
		{
			print "\n\t\t\t\t\t<p>You need to enter your new Password</p>";
			print "\n\t\t\t\t\t<p><a href=\"changepass.inc.php?page=changepass\">Retry?</a></p>\n";
		}
		//if user didn't confirm new password
		else if (strlen ($strNpass2) < 1)
		{
			print "\n\t\t\t\t\t<p>You need to confirm your new Password</p>";
			print "\n\t\t\t\t\t<p><a href=\"changepass.inc.php?page=changepass\">Retry?</a></p>\n";
		}
		//if new pass and confirm pass doesn't match
		else if ($strNpass1 != $strNpass2)
		{
			print "\n\t\t\t\t\t<p>Your new passwords don't match!</p>";
			print "\n\t\t\t\t\t<p><a href=\"changepass.inc.php?page=changepass\">Retry?</a></p>\n";
		}
		//so far so good...
		else
		{
			//check the current password = password in db
			$strSQL = "SELECT * FROM users where NAME='$strUsername' AND PASSWORD='$md5Cpass'";
			$qrySQL = mysql_query ($strSQL)	or die(mysql_error());
			$arrSQL = mysql_fetch_array ($qrySQL);

			//everything's ok!
			if ($arrSQL)
			{
				$md5Password = md5 ($strNpass1);
				$strUpdatepass = "UPDATE users set PASSWORD='$md5Password' where NAME='$strUsername'";
				mysql_query ($strUpdatepass) or die(mysql_error());

				//log the player out
				session_destroy();
				print "\n\t\t\t\t\t<p>Your password has been changed! Please <a href=\"index.php\">log in</a> again.</p>\n";
			}
			else
			{
				print "\n\t\t\t\t\t<p>Your current password is incorrect!</p>";
				print "\n\t\t\t\t\t<p><a href=\"changepass.inc.php?page=changepass\">Retry?</a></p>\n";
			}
		}
	}
	else
	{
?>

					<form method="post" action="changepass.inc.php?page=changepass" name="changepass">
						<table>
							<tr>
								<td>Current Password: </td>
								<td> <input type="password" name="cpass" size="20"></td>
							</tr>
							<tr>
								<td>New Password: </td>
								<td> <input type="password" name="npass1" size="20"></td>
							</tr>
							<tr>
								<td>Confirm New Password: </td>
								<td> <input type="password" name="npass2" size="20"></td>
							</tr>
							<tr>
								<td colspan="2" align="right"><input type="submit" value="Continue" name="submit" /></td>
							</tr>
						</table>
					</form>
<?
	}
	mysql_close();
}
//if user is not logged in
else
{
	require ("login.php");
}
?>