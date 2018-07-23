<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>steveblackonline</title>
	<link href="../main.css" rel="stylesheet" type="text/css" />
	<link href="admin.css" rel="stylesheet" type="text/css" />
	<style>
		#tab_content {
			height: auto !important;
			position: static !important;
		}
		.tab_content_subDiv {
			position:static !important;
			padding:30px !important;
			display: block !important;
		}
	</style>
</head>

<body>
	<div id="header"></div>
	<div id="container">
		<div id="title">
			<img src="../images/header_title.png" alt="steve black" height="44" width="473" />
		</div>
		
		<div id="tab_nav">
			<div style="z-index:6;" id="first" class="active"><a href="index.php?index=0">Home</a></div>
			<div style="z-index:5;"><a href="index.php?index=1&page=addshow">Shows</a></div>
			<div style="z-index:4;"><a href="index.php?index=2&page=addvenue">Venues</a></div>
			<div style="z-index:3;"><a href="index.php?index=3&page=addsong">Songs</a></div>
			<div style="z-index:2;"><a href="index.php?index=4&page=addnews">News</a></div>
			<? if ($_SESSION['loggedin']) { ?><div style="z-index:1;"><a href="login.php">Logout</a></div><? } ?>
		</div>
		
		<div id="tab_content">
			<div class="tab_content_subDiv" id="content0" style="visibility:visible;">
<!-- ========================= MIDDLE START ======================== -->