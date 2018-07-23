<?php
session_start();
require ("config.php");
/************* FIRST CHECK IF THE USER IS LOGGED IN **************/
if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
	require("admin_header.php"); //include starting HTML tags, menu, and connect to the database
	
	if (!$_POST['news_submit'])
	{ // START IF news item hasn't been submitted, display the entry form
		$strForm = "<h3 id=\"admin_title\">Add News Item</h3>\n";
		$strForm .= "<div id=\"admin_form\">\n\t";
		$strForm .= "<form name=\"admin_news_item_add\" method=\"post\" action=\"\">\n\t\t";
		$strForm .= "<p class=\"admin_form_title\">Date: (enter only if the event didn't occur today)</p>\n\t\t";
		$strForm .= "<select name=\"news_month\" size=\"1\">\n\t\t ";
		$strForm .= "<option></option>\n\t\t ";
		$strForm .= "<option value=\"01\">Jan</option>\n\t\t ";
		$strForm .= "<option value=\"02\">Feb</option>\n\t\t ";
		$strForm .= "<option value=\"03\">Mar</option>\n\t\t ";
		$strForm .= "<option value=\"04\">Apr</option>\n\t\t ";
		$strForm .= "<option value=\"05\">May</option>\n\t\t ";
		$strForm .= "<option value=\"06\">Jun</option>\n\t\t ";
		$strForm .= "<option value=\"07\">Jul</option>\n\t\t ";
		$strForm .= "<option value=\"08\">Aug</option>\n\t\t ";
		$strForm .= "<option value=\"09\">Sep</option>\n\t\t ";
		$strForm .= "<option value=\"10\">Oct</option>\n\t\t ";
		$strForm .= "<option value=\"11\">Nov</option>\n\t\t ";
		$strForm .= "<option value=\"12\">Dec</option>\n\t\t";
		$strForm .= "</select>\n\t\t";
		$strForm .= "<select name=\"news_day\" size=\"1\">\n\t\t ";
		$strForm .= "<option></option>\n\t\t ";
		$strForm .= "<option value=\"01\">01</option>\n\t\t ";
		$strForm .= "<option value=\"02\">02</option>\n\t\t ";
		$strForm .= "<option value=\"03\">03</option>\n\t\t ";
		$strForm .= "<option value=\"04\">04</option>\n\t\t ";
		$strForm .= "<option value=\"05\">05</option>\n\t\t ";
		$strForm .= "<option value=\"06\">06</option>\n\t\t ";
		$strForm .= "<option value=\"07\">07</option>\n\t\t ";
		$strForm .= "<option value=\"08\">08</option>\n\t\t ";
		$strForm .= "<option value=\"09\">09</option>\n\t\t ";
		$strForm .= "<option value=\"10\">10</option>\n\t\t ";
		$strForm .= "<option value=\"11\">11</option>\n\t\t ";
		$strForm .= "<option value=\"12\">12</option>\n\t\t ";
		$strForm .= "<option value=\"13\">13</option>\n\t\t ";
		$strForm .= "<option value=\"14\">14</option>\n\t\t ";
		$strForm .= "<option value=\"15\">15</option>\n\t\t ";
		$strForm .= "<option value=\"16\">16</option>\n\t\t ";
		$strForm .= "<option value=\"17\">17</option>\n\t\t ";
		$strForm .= "<option value=\"18\">18</option>\n\t\t ";
		$strForm .= "<option value=\"19\">19</option>\n\t\t ";
		$strForm .= "<option value=\"20\">20</option>\n\t\t ";
		$strForm .= "<option value=\"21\">21</option>\n\t\t ";
		$strForm .= "<option value=\"22\">22</option>\n\t\t ";
		$strForm .= "<option value=\"23\">23</option>\n\t\t ";
		$strForm .= "<option value=\"24\">24</option>\n\t\t ";
		$strForm .= "<option value=\"25\">25</option>\n\t\t ";
		$strForm .= "<option value=\"26\">26</option>\n\t\t ";
		$strForm .= "<option value=\"27\">27</option>\n\t\t ";
		$strForm .= "<option value=\"28\">28</option>\n\t\t ";
		$strForm .= "<option value=\"29\">29</option>\n\t\t ";
		$strForm .= "<option value=\"30\">30</option>\n\t\t ";
		$strForm .= "<option value=\"31\">31</option>\n\t\t";
		$strForm .= "</select>\n\t\t";
		$strForm .= "<select name=\"news_year\" size=\"1\">\n\t\t ";
		$strForm .= "<option></option>\n\t\t ";
		$strForm .= "<option value=\"2007\">2007</option>\n\t\t ";
		$strForm .= "<option value=\"2008\">2008</option>\n\t\t ";
		$strForm .= "<option value=\"2009\">2009</option>\n\t\t";
		$strForm .= "</select>\n\t\t";
		$strForm .= "<p class=\"admin_form_title\">Item:</p>\n";
		$strForm .= "<textarea id=\"news_item\" name=\"news_item\" rows=\"5\" cols=\"48\"></textarea>\n\t\t";
		$strForm .= "<script language=\"javascript1.2\">make_wyzz('news_item');</script>";
		$strForm .= "<p><input name=\"news_submit\" type=\"submit\" value=\"Submit\" /></p>\n\t";
		$strForm .= "</form>\n";
		$strForm .= "</div>\n";
		
		echo $strForm;
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
		
		$strDateTemp = $strNewsDisplayDate;
		$strNewsDisplayDate = "";
		$i = 0;
		while ($i <= 7)
		{
			if ($i == 2 || $i == 5)
			{
				$strNewsDisplayDate .= "<img src=\"images/dash.gif\" alt=\"\" class=\"dateImages\" />";
			}
			else
			{
				$strValue = substr($strDateTemp, $i, 1);
				switch ($strValue)
				{
					case 0:
						$strNewsDisplayDate .= "<img src=\"images/0.gif\" alt=\"\" class=\"dateImages\" />";
						break;
					case 1:
						$strNewsDisplayDate .= "<img src=\"images/1.gif\" alt=\"\" class=\"dateImages\" />";
						break;
					case 2:
						$strNewsDisplayDate .= "<img src=\"images/2.gif\" alt=\"\" class=\"dateImages\" />";
						break;
					case 3:
						$strNewsDisplayDate .= "<img src=\"images/3.gif\" alt=\"\" class=\"dateImages\" />";
						break;
					case 4:
						$strNewsDisplayDate .= "<img src=\"images/4.gif\" alt=\"\" class=\"dateImages\" />";
						break;
					case 5:
						$strNewsDisplayDate .= "<img src=\"images/5.gif\" alt=\"\" class=\"dateImages\" />";
						break;
					case 6:
						$strNewsDisplayDate .= "<img src=\"images/6.gif\" alt=\"\" class=\"dateImages\" />";
						break;
					case 7:
						$strNewsDisplayDate .= "<img src=\"images/7.gif\" alt=\"\" class=\"dateImages\" />";
						break;
					case 8:
						$strNewsDisplayDate .= "<img src=\"images/8.gif\" alt=\"\" class=\"dateImages\" />";
						break;
					case 9:
						$strNewsDisplayDate .= "<img src=\"images/9.gif\" alt=\"\" class=\"dateImages\" />";
						break;
				}
			}
			$i=$i+1;
		}

		if ($strNewsItem == "<p></p>")
		{ // START IF there are errors in the entry form
			$strForm = "<h3 id=\"admin_title\">Add News Item</h3>\n";
			$strForm .= "<div id=\"admin_form\">\n\t";
			$strForm .= "<form name=\"admin_news_item_add\" method=\"post\" action=\"\">\n\t\t";
			$strForm .= "<p class=\"form_error\">Error: Please fill out all required fields, correctly.</p>\n\t\t";
			$strForm .= "<input name=\"hidden_news_date\" type=\"hidden\" value=\"$dtmNewsDate\" />\n\t\t";
			$strForm .= "<p class=\"form_error\">Item:</p>\n\t\t";
			$strForm .= "<textarea name=\"news_item\" rows=\"5\" cols=\"48\"></textarea>\n\t\t";
			$strForm .= "<p><input name=\"news_submit\" type=\"submit\" value=\"Submit\" /></p>\n\t";
			$strForm .= "</form>\n";
			$strForm .= "</div>\n";
			
			echo $strForm;
		} // END IF there are errors in the entry form
		else
		{ // START ELSE no errors found
			/***********************************************************************************
			*                          Start Printing Success!                                 *
			***********************************************************************************/
			$strSQL = "INSERT INTO JSB_NEWS (NEWS_DATE, NEWS_DISPLAY_DATE, NEWS_ITEM) ";
			$strSQL .= "VALUES (\"$dtmNewsDate\", \"".addslashes($strNewsDisplayDate)."\", \"$strNewsItem\")";
			$qrySQL = mysql_query($strSQL) or die (mysql_error()); //run the insert query
			
			$strHTML = "<h3 id=\"admin_title\">Add News Item</h3>\n";
			$strHTML .= "<div id=\"admin_form\">\n\t";
			$strHTML .= "<p class=\"form_success\">The following news item was successfully entered!</p>\n\t";
			$strHTML .= "<p>&nbsp;</p>\n\t";
			$strHTML .= "<p class=\"admin_form_title\">Date:</p>\n\t";
			$strHTML .= "<p>".$strNewsDisplayDate."</p>\n\t";
			$strHTML .= "<p class=\"admin_form_title\">Item:</p>\n\t";
			$strHTML .= "<p>".stripslashes($strNewsItem)."</p>\n";
			$strHTML .= "</div>\n";
			
			echo $strHTML;
			/***********************************************************************************
			*                            End Printing Success!                                 *
			***********************************************************************************/
		} // END ELSE no errors found
	} // END ELSE a News Item has been added
	
	require("admin_footer.php"); // include ending HTML tags close database connection
}
else
{
	require ("login.php"); // user is not logged in, send them to the login page
}
?>