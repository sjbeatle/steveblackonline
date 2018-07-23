<?
Header('Cache-Control: no-cache');
Header('Pragma: no-cache');

//include the configuration file. fatal error if file doesn't exist
require ("config.php");

//initialize variables
$strSong = addslashes(urldecode(stripslashes($_GET['strSong'])));
$strArtist = addslashes(urldecode(stripslashes($_GET['strArtist'])));
$intClientID = $_GET['clientid'];
$strDateModified = date("D F j, Y, g:i a");

$strQuery = "insert into LIL_dn_playlist (song_title, artist, date_modified, client_ID) values (\"$strSong\", \"$strArtist\", \"$strDateModified\", $intClientID);";
$result = mysql_query($strQuery);

if ($result)
{
	$strQuery2 = "select ID from LIL_dn_playlist where song_title=\"$strSong\" and artist=\"$strArtist\" and date_modified=\"$strDateModified\" and client_ID=$intClientID limit 1;";
	$result2 = mysql_query($strQuery2);
	$row = mysql_fetch_row($result2);
	$intID = $row[0];
	if ($intID)
	{
		print_r($intID);
	}
	else
	{
		print_r("Failure");
	}
}
else
{
	print_r("Failure");
}

mysql_close();
?>
