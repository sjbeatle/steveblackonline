<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Lucky in Love - Your Lucky In Love</title>
  <link href="http://www.myluckyinlove.com/main.css" rel="stylesheet" type="text/css" />
  <link href="client.css" rel="stylesheet" type="text/css" />
  <link rel="Shortcut Icon" href="../images/favicon.ico">
  <script type="text/javascript" src="clientscripts.js"></script>
</head>
<body>
<div id="header"></div>
	
<div id="collage"></div>

<div id="container">
	<div id="innerLeft">
		<a href="http://www.myluckyinlove.com">Lucky In Love Home</a>
		<? if($_SESSION['loggedin']==1){echo'<a href="admin.php">Administration Main</a>';} ?>
		<? if($_SESSION['loggedin']!=1){echo'<a href="index.php">Contact Info</a>';} ?>
    <? if($_SESSION['loggedin']!=1){echo'<a href="playlist.php">Playlist</a>';} ?>
    <? if($_SESSION['loggedin']!=1){echo'<a href="dn_playlist.php">Do Not Playlist</a>';} ?>
    <a href="changepass.inc.php">Change Password</a>
    <a href="login.php">Log In / Log Out</a>
	</div>
	
	<div id="innerRight">
		<div id="boxTop"></div>
		<div id="box">
<!-- ========================= MIDDLE START ======================== -->