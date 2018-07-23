<?
session_start();
require("config.php");

if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
	$intClientID = $_SESSION['loggedin'];
	require ("client_header.php");
	
	if ($_GET['view']!='all') { $current = "AND LIL_event_info.event_date>=CURDATE()"; }

	$strQueryPrimary = "SELECT LIL_client.ID,
														 LIL_contact_info.first_name,
														 LIL_event_info.event_date,
														 LIL_contact_info.last_name,
														 LIL_event_types.event_type_desc
														 FROM LIL_client,
														 			LIL_contact_info,
																	LIL_event_info,
																	LIL_event_types
														 WHERE LIL_client.ID=LIL_contact_info.client_ID
																	 AND LIL_client.ID=LIL_event_info.client_ID
																	 AND LIL_event_info.event_type_ID=LIL_event_types.event_type_ID
																	 AND LIL_contact_info.primary_contact=1
																	 ".$current."
														 ORDER BY LIL_event_info.event_date;";
	$arrPrimary = mysql_query($strQueryPrimary);
?>

<style type="text/css">
	form {
		display: inline;
	}
	table td {
		border:1px solid #CCCCCC;
		padding:3px 10px;
		text-align:left;
	}
	table tr:hover {
		color:#cc6666;
		cursor:pointer;
	}
	table {
		border:1px solid #CCCCCC;
	}
	div#box table input {
		float:left;
		font-size: 10px;
		color:#666666;
		background-image: url(input_bkg.png);
		background-repeat: repeat-y;
		background-position: right;
		border: 1px solid #cccccc;
		padding:2px;
		cursor:pointer;
	}
</style>
			<h2><img src="../images/lscroll.gif" alt="" /> Administration Only <img src="../images/scroll.gif" alt="" /></h2>
			<h2 style="text-align: left !important;margin-bottom:0px !important;">Admin Actions</h2>
			<ul>
				<li><a href="addClient.php">Add a client</a></li>
				<li><a href="#">Delete a client</a></li>
			</ul>
			<p>&nbsp;</p>
			<h2 style="text-align: left !important;margin-bottom:0px !important;display:inline;">View Client Details</h2>
			<span style="font-size:smaller;">(<? if ($_GET['view']!="all") { echo '<a href="admin.php?view=all">view all</a>'; } else { echo '<a href="admin.php?view=upcoming">view upcoming</a>'; } ?>)</span>
			<table cellpadding="0" cellspacing="0" width="100%">
<?
$i=0;
while ($row = mysql_fetch_array($arrPrimary))
{
	$intID = $row['ID'];
	$strFirstName = $row['first_name'];
	$strLastName = $row['last_name'];
	$dtmEventDate = $row['event_date'];
	$strEventType = $row['event_type_desc'];
	$blnOdd = false;
	if ( $i&1 ) { $blnOdd = false; } else { $blnOdd = true; } 
?>
				<tr<? if ($blnOdd) { echo " class=\"odd\""; } ?> onclick="location.href='viewClient.php?clientID=<? echo $intID; ?>';">
					<td><? echo $dtmEventDate; ?></td>
					<td><? echo $strLastName.", ".$strFirstName; ?></td>
					<td><? echo $strEventType; ?></td>
				</tr>
<?
	$i = $i + 1;
}
?>
			</table>
			<p>&nbsp;</p>
<?
	require("client_footer.php");
}
//if user is not logged in
else
{
echo $_SESSION['loggedin'];
	require("login.php");
}
mysql_close();
?>