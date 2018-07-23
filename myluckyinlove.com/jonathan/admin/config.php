<?php
if (eregi ("config.php",$_SERVER['PHP_SELF'])) die ("<font color=\"red\">FATAL ERROR. TERMINATING PROGRAM</font>");

// START MySQL Details //
$mysql_username = "stevebl1_steve"; // your database username
$mysql_password = "boss3000"; // your database password
$mysql_dbname = "stevebl1_stevebase"; // name of your database
$mysql_host = "localhost"; // your host, default is localhost
$mysql_pretext = "LOGIN"; // the pretext you wish to have before the table

$db = mysql_connect($mysql_host, $mysql_username, $mysql_password)
	or die("<font color=\"red\">ERROR:" . mysql_error() ."</font>");
if(!$db)
	die("<font color=\"red\">ERROR:" . mysql_error() ."</font>");
if(!mysql_select_db($mysql_dbname,$db))
 	die("<font color=\"red\">ERROR:" . mysql_error() ."</font>");
// END MySQL DETAILS //
?>