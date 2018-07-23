<?php
//this function disables errors when header code is not on the 1st line of code.
ob_start();

//include the configuration file. fatal error if file doesn't exist
require ("config.php");

session_start();

//check if the user is logged in. If not logged in, why bother logging them out?
if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
	//destroys the login sessions
	unset ($_SESSION);
	session_destroy();
	require ("admin_header.php");
	$strLogin .= "<h3 id=\"admin_title\">Goodbye!</h3>\n";
	$strLogin .= "<p>You are now logged out.</p>\n";
	$strLogin .= "<p><a href=\"index.php\">Login</a> again, or go to <a href=\"http://www.myluckyinlove.com/jonathan\">Jonathan's</a> homepage.</p>\n";
	echo $strLogin;
	require ("admin_footer.php");
	die();
}
else if (isset ($_POST['login']))
{
	//check if the anti hacking cookie is set or has reached its limit
	if (!isset ($_COOKIE['tries']) || $_COOKIE['tries'] != '0')
	{

		//define all the vars in case the server don't support the use of global vars
		$strUsername = strip_tags ($_POST['username']);
		$strPassword = strip_tags ($_POST['password']);

		//encode the password in the same encoding as that stored in the db
		$md5Password = md5($strPassword);

		//search for the user.
		$sqlSearch_login = "SELECT * FROM ".$mysql_pretext."_USERS WHERE USERNAME='$strUsername' AND PASSWORD='$md5Password'";
		$qrySearch_login = mysql_query ($sqlSearch_login) or die (mysql_error()) ;
		$arrSearch_login = mysql_fetch_array ($qrySearch_login);
		mysql_close();

		if ($arrSearch_login)
		{
			//valid login!
			//start the sessions
			session_start();
			//remove the anti-hacking cookie
			setcookie ('tries', '', time()-60, '/', '', 0);
			$_SESSION['loggedin'] = $arrSearch_login['NAME'];
			$_SESSION['time'] = time();
			header ('Location: http://www.myluckyinlove.com/myluckyinlove/jonathan/admin/');
			exit;
		}
		else
		{
			//invalid login!
			if (isset ($_COOKIE['tries']))
			{
				//reduce the number of tries
				$intTries = $_COOKIE['tries'] - 1;
				print '<p align="center">Invalid username and/or password. <b>'.$intTries.'</b> tries left.</p><p align="center"><a href="'.$_SERVER['HTTP_REFERER'].'">Retry?</a></p>';
				setcookie ('tries', $intTries, time()+900, '/', '', 0);
				die();
			}
			else
			{
				//set the cookie to hold the variable
				print '<p align="center">Invalid username and/or password. <b>3</b> tries left.</p><p align="center"><a href="'.$_SERVER['HTTP_REFERER'].'">Retry?</a></p>';
				setcookie ('tries', 3, time()+900, '/', '', 0);
				die();
			}
		}

	}
	else
	{
		//block the computer from logging in
		print '<p align="center">You have entered invalid data 3 times in a row. Please wait 15 minutes to try again.</p><p align="center"><b>Sorry!</b></p>';
	}
}
//if the user did not click login.
else
{
	require ("admin_header.php");
	$strLogin = "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\" name=\"login\">\n\t";
	$strLogin .= "<h3 id=\"admin_title\">Login</h3>\n\t";
	$strLogin .= "<p>Username:&nbsp; <input type=\"text\" name=\"username\" value=\"\" size=\"20\" /></p>\n\t";
	$strLogin .= "<p>Password:&nbsp;&nbsp;<input type=\"password\" name=\"password\" value=\"\" size=\"20\" /></p>\n\t";
	$strLogin .= "<p><input type=\"submit\" value=\"Login\" name=\"login\" ";
	if ($_COOKIE['tries'] <= 0 && isset ($_COOKIE['tries']))
	{
		$strLogin .= "disabled=\"disabled\" ";
	}
	$strLogin .= "/></p>\n";
	$strLogin .= "</form>\n";
	$strLogin .= "<p>problems? contact the <a href=\"mailto:steve@steveblackonline.com\">webmaster</a></p>\n";
	echo $strLogin;
	require ("admin_footer.php");
}
ob_end_flush();
?>