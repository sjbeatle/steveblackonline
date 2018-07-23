<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Steve Black - Web Development and Graphic Design</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" />
<?php $page="home"; ?>
</head> 

<body>
<div id="wrapper">
	<div id="header">
		<div id="border-top"></div>

<?php require("menu.php"); ?>
	</div>
	
	<div id="recent-sites">
		<p class="img-header"><img src="images/header_recent_sites.png" width="160" height="19" alt="" /></p>

		<div class="rs-box">
			<a href="http://www.traviswinkley.com"><img src="images/recent_site_6.png" width="259" height="209" title="Travis Winkley" alt="Travis Winkley" /></a>
			<a href="http://www.traviswinkley.com" class="text-link">Travis Winkley</a>
		</div>

		<div class="rs-box">
			<a href="http://www.bataxservice.com"><img src="images/recent_site_5.png" width="259" height="209" alt="B &amp; A Tax Service" title="B &amp; A Tax Service" /></a>
			<a href="http://www.bataxservice.com" class="text-link">B &amp; A Tax Service</a>
		</div>
		
		<div class="rs-box">
			<a href="http://www.mapletreecabinets.com"><img src="images/recent_site_4.png" width="259" height="209" title="Maple Tree Cabinetmakers" alt="Maple Tree Cabinetmakers" /></a>
			<a href="http://www.mapletreecabinets.com" class="text-link">Maple Tree Cabinetmakers</a>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="welcome">
		<p class="img-header"><img src="images/header_welcome.png" width="115" height="21" alt="" /></p>
		<p>Professionalism, with a large emphasis on web standards. <span style="color:#fbedbb">Steve Black Web Development &amp; Graphic Design</span> will work with you to design and develop websites reaching the highest potential of your needs.</p>
	</div>
	
<?php require("footer.php"); ?>
</div>
</body>
</html>
