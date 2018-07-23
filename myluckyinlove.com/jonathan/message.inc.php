<?
$sql="SELECT * FROM BB_MESSAGEBOARD ORDER BY ENTRY_DATE DESC, ID DESC";
$sql_result = mysql_query($sql) or die (mysql_error()); //run the select query

$count = mysql_num_rows($sql_result); //number of entries in the table
if ((fmod($count, 10)) == 0) {$subPages = floor($count/10);} else {$subPages = floor($count/10) + 1;}
if (!$_GET["page"]) {$page = 1;} else {$page = $_GET["page"];}

$minNum = ($page*10) - 9;
$maxNum = ""; //initialize variable
if ($page == $subPages) {$maxNum = $count;} else {$maxNum = $page*10;}
if ($page == 1) {$previous = 1;} else {$previous = $page - 1;}
if ($page == $subPages) {$next = $subPages;} else {$next = $page + 1;}

//generate # of sub pages
echo "<p>Displaying <strong>".$minNum." - ".$maxNum."</strong> of <strong>".$count."</strong> entries.</p>\n";
$strPages = "<p><a href=\"messageboard.php?do=message&amp;page=1\"><img src=\"images/double_left_arrow.gif\" border=\"0\" alt=\"First Page\" /></a>&nbsp;&nbsp<a href=\"messageboard.php?do=message&amp;page=".$previous."\"><img src=\"images/left_arrow.gif\" border=\"0\" alt=\"Previous Page\" /></a>&nbsp;&nbsp&nbsp;\n";
if ($subPages > 5)
{
	switch ($page)
	{
		case 1:
			$i=1;
			while ($i < 4)
			{
				if ($page == $i)
				{
					$strPages .= "<strong>".$i."</strong>, &nbsp;";
					$i = $i + 1;
				}
				else
				{
					$strPages .= "<a href=\"messageboard.php?do=message&amp;page=".$i."\">".$i."</a>, &nbsp;";
					$i = $i + 1;
				}
			}
			$strPages .= "<a href=\"messageboard.php?do=message&amp;page=4\">4</a>, &nbsp;<a href=\"messageboard.php?do=message&amp;page=5\">5</a>";
			break;

		case 2:
			$i=1;
			while ($i < 4)
			{
				if ($page == $i)
				{
					$strPages .= "<strong>".$i."</strong>, &nbsp;";
					$i = $i + 1;
				}
				else
				{
					$strPages .= "<a href=\"messageboard.php?do=message&amp;page=".$i."\">".$i."</a>, &nbsp;";
					$i = $i + 1;
				}
			}
			$strPages .= "<a href=\"messageboard.php?do=message&amp;page=4\">4</a>, &nbsp;<a href=\"messageboard.php?do=message&amp;page=5\">5</a>";
			break;

		case 3:
			$i=1;
			while ($i < 4)
			{
				if ($page == $i)
				{
					$strPages .= "<strong>".$i."</strong>, &nbsp;";
					$i = $i + 1;
				}
				else
				{
					$strPages .= "<a href=\"messageboard.php?do=message&amp;page=".$i."\">".$i."</a>, &nbsp;";
					$i = $i + 1;
				}
			}
			$strPages .= "<a href=\"messageboard.php?do=message&amp;page=4\">4</a>, &nbsp;<a href=\"messageboard.php?do=message&amp;page=5\">5</a>";
			break;
		default:
			if ((($page + 2) > $subPages) && ($page != $subPages))
			{
				$i = $subPages - 4;
				while ($i < $subPages)
				{
					if ($page == $i)
					{
						$strPages .= "<strong>".$i."</strong>, &nbsp;";
						$i = $i + 1;
					}
					else
					{
						$strPages .= "<a href=\"messageboard.php?do=message&amp;page=".$i."\">".$i."</a>, &nbsp;";
						$i = $i + 1;
					}
				}
				$strPages .= "<a href=\"messageboard.php?do=message&amp;page=".$subPages."\">".$subPages."</a>";
			}
			else if ($page == $subPages)
			{
				$fourBelow = $page - 4;
				$threeBelow = $page - 3;
				$twoBelow = $page - 2;
				$oneBelow = $page - 1;
				$strPages .= "<a href=\"messageboard.php?do=message&amp;page=".$fourBelow."\">".$twoBelow."</a>, &nbsp;
				<a href=\"messageboard.php?do=message&amp;page=".$oneBelow."\">".$threeBelow."</a>, &nbsp;
				<a href=\"messageboard.php?do=message&amp;page=".$oneAbove."\">".$twoBelow."</a>, &nbsp;
				<a href=\"messageboard.php?do=message&amp;page=".$twoAbove."\">".$oneBelow."</a>, &nbsp;
				<strong>".$subPages."</strong>";
			}
			else
			{
				$twoBelow = $page - 2;
				$oneBelow = $page - 1;
				$oneAbove = $page + 1;
				$twoAbove = $page + 2;
				$strPages .= "<a href=\"messageboard.php?do=message&amp;page=".$twoBelow."\">".$twoBelow."</a>, &nbsp;
				<a href=\"messageboard.php?do=message&amp;page=".$oneBelow."\">".$oneBelow."</a>, &nbsp;
				<strong>".$page."</strong>, &nbsp;
				<a href=\"messageboard.php?do=message&amp;page=".$oneAbove."\">".$oneAbove."</a>, &nbsp;
				<a href=\"messageboard.php?do=message&amp;page=".$twoAbove."\">".$twoAbove."</a>";
			}
	}
}
else
{
	$i=1;
	while ($subPages > $i)
	{
		if ($i == $page)
		{
			$strPages .= "<strong>".$i."</strong>, &nbsp;";
			$i = $i + 1;
		}
		else
		{
			$strPages .= "<a href=\"messageboard.php?do=message&amp;page=".$i."\">".$i."</a>, &nbsp;";
			$i = $i + 1;
		}
	}
	if ($i == $page)
	{
		$strPages .= "<strong>".$i."</strong>";
		$i = $i + 1;
	}
	else
	{
		$strPages .= "<a href=\"messageboard.php?do=message&amp;page=".$i."\">".$i."</a>";
		$i = $i + 1;
	}
}

$strPages .= "&nbsp;&nbsp;&nbsp<a href=\"messageboard.php?do=message&amp;page=".$next."\"><img src=\"images/right_arrow.gif\" border=\"0\" alt=\"Next Page\" /></a>&nbsp;&nbsp
<a href=\"messageboard.php?do=message&amp;page=".$subPages."\"><img src=\"images/double_right_arrow.gif\" border=\"0\" alt=\"Last Page\" /></a>";
echo $strPages."</p>";

//generate list articles
$i=1;
while ($row = mysql_fetch_array($sql_result))
{
	$id = $row["ID"];
	$name = $row["NAME"];
	$message = $row["MESSAGE"];
	$date = strtotime($row["ENTRY_DATE"]);
	$date = date("M d Y", $date);

	if (($i >= $minNum) && ($i <= $maxNum))
	{
		$strOutput = "<div id=\"message_title\">\n";
		$strOutput .= "<div><img src=\"images/journal_title_top.gif\" alt=\"\" border=\"0\" /></div>\n";
		$strOutput .= "<div id=\"message_title_middle\">\n";
		$strOutput .= "<p id=\"message_title_text\">Posted By: <strong>".stripslashes($name)."</strong></p>\n";
		$strOutput .= "<div id=\"message_title_text\">".stripslashes($message)."</div>\n";
		$strOutput .= "<p id=\"message_title_text\">Posted On: <strong>".$date."</strong></p>\n";
		$strOutput .= "</div>\n";
		$strOutput .= "<div><img src=\"images/journal_title_bottom.gif\" alt=\"\" border=\"0\" /></div>\n";
		$strOutput .= "</div>\n";
		echo $strOutput;
		$i = $i + 1;
	}
	else
	{
		$i = $i + 1;
	}
}
echo $strPages."</p>";
?>