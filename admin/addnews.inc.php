<?php
session_start();
require ("config.php");
/************* FIRST CHECK IF THE USER IS LOGGED IN **************/
if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
	if (!$_POST['news_submit'])
	{ // START IF news item hasn't been submitted, display the entry form
?>
<form name="admin_news_item_add" method="post" action="">
	<p class="admin_form_title">Date: (enter only if the event didn't occur today)</p>
	<select name="news_month" size="1">
		<option></option>
		<option value="01">Jan</option>
		<option value="02">Feb</option>
		<option value="03">Mar</option>
		<option value="04">Apr</option>
		<option value="05">May</option>
		<option value="06">Jun</option>
		<option value="07">Jul</option>
		<option value="08">Aug</option>
		<option value="09">Sep</option>
		<option value="10">Oct</option>
		<option value="11">Nov</option>
		<option value="12">Dec</option>
	</select>
	<select name="news_day" size="1">
		<option></option>
		<option value="01">01</option>
		<option value="02">02</option>
		<option value="03">03</option>
		<option value="04">04</option>
		<option value="05">05</option>
		<option value="06">06</option>
		<option value="07">07</option>
		<option value="08">08</option>
		<option value="09">09</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
	</select>
	<select name="news_year" size="1">
		<option value="<?php echo date("Y");?>"><?php echo date("Y");?></option>
		<option value="<?php echo date("Y")-1;?>"><?php echo date("Y")+1;?></option>
		<option value="<?php echo date("Y")-2;?>"><?php echo date("Y")+2;?></option>
	</select>
	<p>Item:</p>
	<textarea id="news_item" name="news_item" rows="5" cols="48"></textarea>
	<p class="submit"><input name="news_submit" type="submit" value="Submit" /></p>
</form>
<?
	} // END IF a News Item hasn't been added, display the entry form.
	else
	{ // START ELSE a News Item has been added.
		//initialize variables
		$strNewsDisplayDate = "";
		$dtmNewsDate = "";
		//Prep News Item
		$strNewsItem = $_POST["news_item"];
		$strNewsItem = trim($strNewsItem);
		$arrLineReturns = array("\r\n", "\n", "\r");
		$strReplace = "</p><p>";
		$strNewsItem = "<p>".str_replace($arrLineReturns, $strReplace, $strNewsItem)."</p>";
		$strNewsItemRaw = str_replace("&", "&amp;", $strNewsItem);
		$strNewsItemRaw = str_replace("<", "&lt;", $strNewsItemRaw);
		$strNewsItemRaw = str_replace(">", "&gt;", $strNewsItemRaw);
		//populate Date variables
		if ($_POST['news_year'] && $_POST['news_month'] && $_POST['news_day'])
		{
			$dtmNewsDate = $_POST['news_year']."/".$_POST['news_month']."/".$_POST['news_day'];
			$strNewsDisplayDate = date("m-d-y", mktime(0, 0, 0, $_POST['news_month'], $_POST['news_day'], $_POST['news_year']));
		}
		else
		{
			if ($_POST["hidden_news_date"])
			{
				$dtmNewsDate = $_POST["hidden_news_date"];
				$strNewsDisplayDate = date("m-d-y",$_POST["hidden_news_date"]);
			}
			else
			{
				$dtmNewsDate = date("Y/m/d");
				$strNewsDisplayDate = date("m-d-y");
			}
		}

		if ($strNewsItem == "<p></p>")
		{ // START IF there are errors in the entry form
?>

<form name="admin_news_item_add" method="post" action="">
	<p>Error: Please fill out all required fields, correctly.</p>
	<input name="hidden_news_date" type="hidden" value="<? echo $dtmNewsDate; ?>" />
	<p>Item:</p>
	<textarea name="news_item" rows="5" cols="48"></textarea>
	<p class="submit"><input name="news_submit" type="submit" value="Submit" /></p>
</form>

<?
		} // END IF there are errors in the entry form
		else
		{ // START ELSE no errors found
			/***********************************************************************************
			*                          Start Printing Success!                                 *
			***********************************************************************************/
			$strSQL = "INSERT INTO news (news_date,
																	 news_display_date,
																	 news_item,
																	 news_item_raw)
																	 VALUES (\"$dtmNewsDate\",
																	 				 \"$strNewsDisplayDate\",
																					 \"$strNewsItem\",
																					 \"$strNewsItemRaw\")";
			$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
?>
<p><font color="green">The following news item was successfully entered!</font></p>
<div style="padding-left: 20px;">
	<p>&nbsp;</p>
	<p class="admin_form_title">Date:</p>
	<p><? echo $strNewsDisplayDate; ?></p>
	<p class="admin_form_title">Item:</p>
	<p><? echo $strNewsItem; ?></p>
</div>

<?
			/***********************************************************************************
			*                            End Printing Success!                                 *
			***********************************************************************************/

			/***********************************************************************************
			*                          Start Generating RSS Feed                               *
			***********************************************************************************/

			require("rss_news.php");

			/***********************************************************************************
			*                          Finish Generating RSS Feed                              *
			***********************************************************************************/
		} // END ELSE no errors found
	} // END ELSE a News Item has been added
}
else
{
	require ("login.php"); // user is not logged in, send them to the login page
}
?>
