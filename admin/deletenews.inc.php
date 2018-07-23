<?php
session_start();
require ("config.php");
/************* FIRST CHECK IF THE USER IS LOGGED IN **************/
if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{	
	if (!$_POST['enter'])
	{ // START IF show(s) haven't been selected, display the entry form
		$strSQL = "select * from news order by news_date desc;"; 
		$qrySQL = mysql_query($strSQL) or die (mysql_error());
?>

<script type="text/javascript">
	function disp_confirm(form)
	{
		var r=confirm("The news item(s) will be deleted permanently.\r\nAre you sure you want to proceed?");
		if (r==true)
		{
			form.submit();
		}
		else
		{
			return false;
		}
	}
</script>
<form name="delete" method="post" action="">
	<input type="hidden" name="enter" value="true" />
	<p>Select the news item(s) you would like to delete...</p>
	<p>&nbsp;</p>
<?php
while ($row = mysql_fetch_array($qrySQL)) {
   $id = $row["news_ID"];
   $strDisplayDate = $row["news_display_date"];
	 $strItem = $row["news_item"];
	 
	 echo "\t<p><input type=\"checkbox\" name=\"delete$id\" value=\"$id\" /> <strong>$strDisplayDate:</strong> $strItem</p>\n";
}
?>

	<p class="submit"><input type="button" name="check" value="Delete Item(s)" onclick="disp_confirm(this.form);" /></p>
</form>
<?php
	} // END IF show(s) haven't been selected, display the entry form.
	else
	{ // START ELSE delete show
		$strSQL = "select * from news order by news_date desc;"; 
		$qrySQL = mysql_query($strSQL) or die (mysql_error());
		
		while ($row = mysql_fetch_array($qrySQL))
		{
			$id = $row["news_ID"];
			$strDisplayDate = $row["news_display_date"];
			$strItem = $row["news_item"];
			$compare = $_POST["delete$id"];
			
			if ($compare == $id) 
			{
				$strDelete = "DELETE FROM news WHERE news_ID=$id;";
	 			echo "<p><strong>$strDisplayDate:</strong> $strItem</p>\n";
				$qryDelete = mysql_query($strDelete) or die (mysql_error()); //run delete query
			}
 		}
		$strHTML = "<p>&nbsp;</p>\n";
		$strHTML .= "\n<p><font color=\"green\">The above news item(s) have been deleted.</font></p>\n";
		
		echo $strHTML;
		

			/***********************************************************************************
			*                          Start Generating RSS Feed                               *
			***********************************************************************************/
				
			require("rss_news.php");
						
			/***********************************************************************************
			*                          Finish Generating RSS Feed                              *
			***********************************************************************************/
		
	} // END ELSE delete show
}
else
{
	require ("login.php"); // user is not logged in, send them to the login page
}
?>