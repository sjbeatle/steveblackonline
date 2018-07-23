<?
$strSQL = "SELECT * FROM BB_POLLS WHERE ACTIVATE=TRUE ORDER BY ID DESC;";
$arrPoll = mysql_query($strSQL) or die (mysql_error());

while ($rowPoll = mysql_fetch_array($arrPoll)) {
   $pollid = $rowPoll["ID"];
   $question = $rowPoll["QUESTION"];
   $strSQL = "SELECT * FROM BB_POLLS_ITEMS WHERE POLL_ID=$pollid ORDER BY POSITION;";
   $arrPollItems = mysql_query($strSQL) or die (mysql_error());
   $check = $_COOKIE["poll"];

   if ($check != $pollid && $_POST["pollid"] != $pollid) {
echo "
<!-- BEGIN POLL -->
<form action=\"\" method=\"post\">
<table class=\"poll\" cellspacing=\"0\" cellpadding=\"4\">
  <tr>
   <td align=\"left\"><font face=\"Verdana\" size=\"1\"><b>".$question."</b></font>
   </td>
  </tr>

  <tr>
   <td align=\"left\">
   ";

     while ($rowPollItems = mysql_fetch_array($arrPollItems)) {
   	$option = $rowPollItems["ANSWER"];
echo "<input type=\"radio\" name=\"option\" value=\"".$option."\"><font face=\"Verdana\" size=\"1\">".$option."</font><br />
   ";
     }

echo "</td>
  </tr>

  <tr>
   <td align=\"center\" colspan=\"2\">
   <input type=\"submit\" name=\"submit\" value=\"Submit\" />
   </td>
  </tr>

  <input type=\"hidden\" name=\"pollid\" value=\"".$pollid."\"/>
</table>
</form>
<!-- END POLL -->

";
   } else {

   //initialize variables
   if($_POST["pollid"])
   {
	$id = $_POST["pollid"];
	$option = $_POST["option"];
	$strSQL = "SELECT SCORE FROM BB_POLLS_ITEMS WHERE POLL_ID=$id AND ANSWER=\"".stripslashes($option)."\";";
	$arrResult = mysql_query($strSQL) or die (mysql_error());
	while ($row = mysql_fetch_array($arrResult)) {
		$count = $row["SCORE"];
		$count = $count + 1;
		$strSQL = "UPDATE BB_POLLS_ITEMS SET SCORE=$count WHERE POLL_ID=$id AND ANSWER=\"".stripslashes($option)."\";";
		$sqlRun = mysql_query($strSQL) or die (mysql_error());
	}
   }

   $totalVotes = 0;
   $strSQL = "SELECT * FROM BB_POLLS_ITEMS WHERE POLL_ID=$pollid ORDER BY POSITION;";
   $arrPollItems1 = mysql_query($strSQL) or die (mysql_error());
   $arrPollItems = mysql_query($strSQL) or die (mysql_error());

     while ($row = mysql_fetch_array($arrPollItems1)) {
	$score = $row["SCORE"];
	$totalVotes = $totalVotes + $score;
     }

echo "

<table  class=\"poll\" cellspacing=\"0\" cellpadding=\"4\">
  <tr>
   <td colspan=\"3\"><strong>".$question."</strong>
   </td>
  </tr>

  <tr>
   <td><strong>Answers</strong>
   </td>

   <td align=\"center\"><strong>%</strong>
   </td>

   <td align=\"center\"><strong>Number</strong>
   </td>
  </tr>

  ";

     while ($rowPollItems = mysql_fetch_array($arrPollItems)) {
   	$option = $rowPollItems["ANSWER"];
   	$score = $rowPollItems["SCORE"];
   	$percent = round(($score/$totalVotes)*100);
echo "<tr>
   <td>".$option."
   </td>

   <td align=\"center\"><strong>".$percent."%</strong>
   </td>

   <td align=\"center\"><strong>".$score."</strong>
   </td>
  </tr>

  ";
     }

echo "<tr align=\"center\">
   <td colspan=\"3\" align=\"center\"><strong>Total Votes : ".$totalVotes."</strong>
   </td>
  </tr>
</table>";
   }
}
?>