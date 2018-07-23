<?php
if($_POST["pollid"])
{
	$value = $_POST["pollid"];
	setcookie("poll", $value, time()+60*60*24*365,'/','.myluckyinlove.com');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jonathan Steven - Official</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<?php require("config.php"); ?>

<body>
<div class="outmost">	<div id="header">
		<!-- <div id="logo_w1">Jonathan</div>
		<div id="logo_w2">Steven</div> -->

		<div id="header_text">
			<p>Welcome to the official website of Jonathan Steven!</p>
		</div>
<?php require("menu.htm"); ?>
	</div>
	<div id="content">
		<div id="left">
			<h2>Latest news</h2>
			<div id="news">
<?php
$strSQL = "SELECT * FROM JSB_NEWS ORDER BY NEWS_DATE DESC LIMIT 5;";
$qyrSQL = mysql_query($strSQL);
// List current gigs to edit
$strHTML = "";
while ($news = mysql_fetch_array($qyrSQL)) { 
	$strDisplayDate = $news["NEWS_DISPLAY_DATE"];
	$strNewsItem = stripslashes($news["NEWS_ITEM"]);
	$strHTML .= $strDisplayDate."\n";
	$strHTML .= $strNewsItem."\n";
}
echo $strHTML;
?>
			<a href="archives.php">archives</a>
			</div>
		</div>
		<div id="right">
			<h2>Poll</h2>
			<!-- BEGIN POLL -->
			<?php require("poll.php"); ?>
			<!-- END POLL -->
		</div>
		<div id="footerline"></div>
	</div>
	
	<div id="footer">Website built by <a href="http://webdesign.steveblackonline.com">Steve Black</a></div>	
</div>
<?php mysql_close(); ?>
</body>
</html>
