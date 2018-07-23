<?
$strSQL = "SELECT ID, DESCRIPTION, DATE, NAME FROM BB_JOURNAL ORDER BY DATE DESC LIMIT 5;";
$arrJournal = mysql_query($strSQL) or die (mysql_error());

$id = $_GET["id"];
if (!$id)
{
	$strSQL = "SELECT ID FROM BB_JOURNAL ORDER BY DATE;";
	$arrID = mysql_query($strSQL) or die (mysql_error());
	while ($row = mysql_fetch_array($arrID))
	{
		$id = $row["ID"];
	}
}

while ($row = mysql_fetch_array($arrJournal))
{
	$journalID = $row["ID"];
	$description = $row["DESCRIPTION"];
	$name = $row["NAME"];
	if ($name == "Jillian")
	{
		$name = "<img src=\"images/jillian.gif\" alt=\"\" border=\"0\" />";
	}
	else
	{
		$name = "<img src=\"images/steven.gif\" alt=\"\" border=\"0\" />";
	}
	$date = strtotime($row["DATE"]);
	$date = date("M d Y", $date);
	if ($journalID == $id)
	{
		echo "<p><em>".$description."</em></p><p>Entered by: ".$name."</p><p>Entered on: <b>".$date."</b></p><p>&nbsp;</p>\n";
	}
	else
	{
		echo "<p><em><a href=\"journal.php?id=".$journalID."\">".$description."</a></em></p><p>Entered by: ".$name."</p><p>Entered on: <b>".$date."</b></p><p>&nbsp;</p>\n";
	}
}
echo "<p><a href=\"archives.php?type=journal\">archives</a></p>\n";
?>