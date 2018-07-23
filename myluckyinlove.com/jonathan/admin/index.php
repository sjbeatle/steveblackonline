<?
session_start();
require("config.php");

if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
	require ("admin_header.php");
	$strHTML .= "<h3 id=\"admin_title\">Welcome!</h3>\n";
	$strHTML .= "<p>Hi, ".$_SESSION['loggedin']."!\n";
	$strHTML .= "<p>Let's get started, and pick an option!</p>\n";
	echo $strHTML;
	require("admin_footer.php");
}
//if user is not logged in
else
{
echo $_SESSION['loggedin'];
	require("login.php");
}
?>