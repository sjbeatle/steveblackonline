<?php
//if (eregi ("config.php",$_SERVER['PHP_SELF'])) die ("<font color=\"red\">FATAL ERROR. TERMINATING PROGRAM</font>");

// START MySQL Details //
$mysql_username = "stevebl1_steve"; // your database username
$mysql_password = "boss3000"; // your database password
$mysql_dbname = "stevebl1_stevebase"; // name of your database
$mysql_host = "localhost"; // your host, default is localhost

$db = mysql_connect($mysql_host, $mysql_username, $mysql_password)
	or die("<font color=\"red\">ERROR:" . mysql_error() ."</font>");
if(!$db)
	die("<font color=\"red\">ERROR:" . mysql_error() ."</font>");
if(!mysql_select_db($mysql_dbname,$db))
 	die("<font color=\"red\">ERROR:" . mysql_error() ."</font>");
// END MySQL DETAILS //

/*
$sqlLoginTable = "CREATE TABLE $mysql_dbname.users (";
$sqlLoginTable .= "ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
$sqlLoginTable .= "USERNAME VARCHAR(255) NOT NULL, ";
$sqlLoginTable .= "PASSWORD VARCHAR(255) NOT NULL, ";
$sqlLoginTable .= "NAME VARCHAR(255) NOT NULL, ";
$sqlLoginTable .= "EMAIL VARCHAR(255) NOT NULL";
$sqlLoginTable .= ")";

// CREATE user TABLE
$qryLoginTable = mysql_query ($sqlLoginTable)	or die(mysql_error());

// CREATE DUMMY ENTRY
$sqlDummy = "INSERT INTO users (";
$sqlDummy .= "ID, ";
$sqlDummy .= "USERNAME, ";
$sqlDummy .= "PASSWORD, ";
$sqlDummy .= "NAME, ";
$sqlDummy .= "EMAIL";
$sqlDummy .= ")";
$sqlDummy .= "VALUES (";
$sqlDummy .= "NULL , \"steveblack\", \"".md5("steveblack")."\", \"Steve Black\", \"steve@steveblackonline.com\"";
$sqlDummy .= ");";

$qryDummy = mysql_query ($sqlDummy)	or die(mysql_error());
*/

?>