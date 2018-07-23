<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Administration - Jonathan Steven</title>
	<script src="scripts/dropdown_menu.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript" src="scripts/wyzz.js"></script>
	<link href="admin.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="outmost">
	<div id="header">
		<!-- <div id="logo_w1">Jonathan</div>
		<div id="logo_w2">Steven</div> -->
	
		<div id="header_text">
			<p>Jonathan's Webpage Administration</p>
		</div>
<!-- BEGIN NAVIGATION -->
			<div class="suckertreemenu">
				<ul id="treemenu1">
					<li><a href="#">news</a>
						<ul>
							<li><a href="addnews.php">add news</a></li>
							<li><a href="editnews.php">edit news</a></li>
							<li><a href="deletenews.php">delete news</a></li>
						</ul> 
					</li>
<?php
if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
?>
					<li><a href="login.php">logout</a></li>
<?php
}
?>
				</ul>
			</div>
<!-- END NAVIGATION -->
	</div>
	<div id="content">