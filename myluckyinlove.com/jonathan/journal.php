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
		<div id="journal_left"><p>&nbsp;</p><img src="images/journal_header.gif" alt="" border="0" /><p>&nbsp;</p>
<?php require ('journallist.php'); ?>
		</div>
		<div id="journal_right">
<?php require ('journalentry.php'); ?>
		</div>
		<div id="footerline"></div>
	</div>
	
	<div id="footer">Copyright © 2008.  All rights reserved.</div>	
</div>
<?php mysql_close(); ?>
</body>
</html>
