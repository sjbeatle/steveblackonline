<?
Header('Cache-Control: no-cache');
Header('Pragma: no-cache');

//include the configuration file. fatal error if file doesn't exist
require ("config.php");

//initialize variables
$strValue = addslashes(urldecode(stripslashes($_GET['value'])));
if ($strValue == "click here to add") { $strValue = ""; }
$strTable = $_GET['table'];
$strField = $_GET['field'];
$intClientID = $_GET['clientid'];
$blnPrimary = $_GET['primary'];
$strDateModified = date("D F j, Y, g:i a");

$strQuery = "update $strTable set $strField=\"$strValue\", date_modified=\"$strDateModified\" where client_ID=$intClientID and primary_contact=$blnPrimary limit 1;";

if (mysql_query($strQuery))
{
	print_r("Success".$blnPrimary);
}
else
{
	print_r("Failure".$blnPrimary);
}

mysql_close();
?>
