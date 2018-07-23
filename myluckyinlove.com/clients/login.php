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
	require ("client_header.php");
	$strLogin .= "<h2><img src=\"http://www.myluckyinlove.com/images/lscroll.gif\" alt=\"\" /> Logged Out <img src=\"http://www.myluckyinlove.com/images/scroll.gif\" alt=\"\" /></h2>\n";
	$strLogin .= "<p>You are now logged out.</p>\n";
	$strLogin .= "<p><a href=\"index.php\">Log in</a> again?\n";
	echo $strLogin;
	require ("client_footer.php");
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
		$sqlSearch_login = "SELECT * FROM LIL_client WHERE username='$strUsername' AND password='$md5Password'";
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
			$_SESSION['loggedin'] = $arrSearch_login['ID'];
			$_SESSION['time'] = time();
			if ($_SESSION['loggedin']==1)
			{
				header ('Location: http://clients.myluckyinlove.com/admin.php');
			}
			else
			{
				header ('Location: http://clients.myluckyinlove.com');
			}
			exit;
		}
		else
		{
			//invalid login!
			if (isset ($_COOKIE['tries']))
			{
				//reduce the number of tries
				$intTries = $_COOKIE['tries'] - 1;
				require ("client_header.php");
				print '<h2><img src="http://www.myluckyinlove.com/images/lscroll.gif" alt="" /> Error! <img src="http://www.myluckyinlove.com/images/scroll.gif" alt="" /></h2><p align="center">Invalid username and/or password. <b>'.$intTries.'</b> tries left.</p><p align="center"><a href="'.$_SERVER['HTTP_REFERER'].'">Retry?</a></p>';
				require ("client_footer.php");
				setcookie ('tries', $intTries, time()+900, '/', '', 0);
				die();
			}
			else
			{
				//set the cookie to hold the variable
				require ("client_header.php");
				print '<h2><img src="http://www.myluckyinlove.com/images/lscroll.gif" alt="" /> Error! <img src="http://www.myluckyinlove.com/images/scroll.gif" alt="" /></h2><p align="center">Invalid username and/or password. <b>3</b> tries left.</p><p align="center"><a href="'.$_SERVER['HTTP_REFERER'].'">Retry?</a></p>';
				require ("client_header.php");
				setcookie ('tries', 3, time()+900, '/', '', 0);
				die();
			}
		}

	}
	else
	{
		//block the computer from logging in
		require ("client_header.php");
		print '<p align="center">You have entered invalid data 3 times in a row. Please contact the webmaster to reset your username and password.</p><p align="center"><b>We apologize for any inconvenience.</b></p>';
		require ("client_header.php");
	}
}
//if the user did not click login.
else
{
	require ("client_header.php");
	$strLogin = "<h2><img src=\"http://www.myluckyinlove.com/images/lscroll.gif\" alt=\"\" /> Log In <img src=\"http://www.myluckyinlove.com/images/scroll.gif\" alt=\"\" /></h2>\n";
	$strLogin .= "<p>Welcome to <em>Your</em> Lucky in Love! Sign in below to access the pages listed in the left-hand navigation. Please take your time, and enjoy the client-end of our website. If you have any questions about anything, feel free to let us know!</p><p><strong>Note:</strong> Please pardon our appearance as we work to develop this portion of our site. We will keep you notified of any updates as they occur via e-mail. Thanks!</p>";
	$strLogin .= "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\" name=\"login\">\n\t";
	$strLogin .= "<table><tr><td>Username:&nbsp;</td><td><input type=\"text\" name=\"username\" value=\"\" size=\"20\" /></td></tr>\n\t";
	$strLogin .= "<tr><td colspan=\"2\" align=\"right\">&nbsp;</td></tr>\n\t";
	$strLogin .= "<tr><td>Password:&nbsp;&nbsp;</td><td><input type=\"password\" name=\"password\" value=\"\" size=\"20\" /></td></tr>\n\t";
	$strLogin .= "<tr><td colspan=\"2\" align=\"right\">&nbsp;</td></tr>\n\t";
	$strLogin .= "<tr><td colspan=\"2\" align=\"right\"><input type=\"submit\" value=\"Login\" name=\"login\" ";
	if ($_COOKIE['tries'] <= 0 && isset ($_COOKIE['tries']))
	{
		$strLogin .= "disabled=\"disabled\" ";
	}
	$strLogin .= "/></td></tr></table>\n";
	$strLogin .= "</form>\n";
	$strLogin .= "<p>problems? contact the <a href=\"mailto:dj@myluckyinlove.com\">webmaster</a></p>\n";
	echo $strLogin;
	require ("client_footer.php");
}
ob_end_flush();
?>