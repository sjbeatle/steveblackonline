<?
Header('Cache-Control: no-cache');
Header('Pragma: no-cache');

//include the configuration file. fatal error if file doesn't exist
require ("config.php");

//initialize variables
$intID = $_GET['id'];

$strQuery = "delete from LIL_dn_playlist where ID=$intID limit 1;";
$result = mysql_query($strQuery);

if ($result)
{
	print_r("Success");
}
else
{
	print_r("Failure");
}

mysql_close();
?>
