<?
$strSQL = "SELECT * FROM BB_JOURNAL WHERE ID=\"$id\" LIMIT 1;";
$arrContent = mysql_query($strSQL) or die (mysql_error());
while ($row = mysql_fetch_array($arrContent))
{
	$journalID = $row["ID"];
	$description = $row["DESCRIPTION"];
	$entry = $row["ENTRY"];
	$name = $row["NAME"];
	$date = strtotime($row["DATE"]);
	$date = date("M d Y", $date);
	
	$strOutput = "<div id=\"journal_title\">\n";
	$strOutput .= "<div><img src=\"images/journal_title_top.gif\" alt=\"\" border=\"0\" /></div>\n";
	$strOutput .= "<div id=\"journal_title_middle\">\n";
	$strOutput .= "<p id=\"journal_title_text\"><strong>".$description."</strong></p>\n";
	$strOutput .= "</div>\n";
	$strOutput .= "<div><img src=\"images/journal_title_bottom.gif\" alt=\"\" border=\"0\" /></div>\n";
	$strOutput .= "</div>\n";
	$strOutput .= "<p>&nbsp;</p>\n";
	$strOutput .= "<div id=\"journal_entry\">".$entry."</div>";
	echo $strOutput;
}
?>