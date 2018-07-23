<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Steve Black - Demo Site</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Steve Black is a solo, acoustic singer/songwriter from the New York Hudson Valley area. His original music is classified Pop/Rock, and his cover selection ranges from popular rock of the sixties to today." />
	<meta name="keywords" content="Steve, Black, Steven, Music, Rock, Roll, Pop, Singer, Song, Songs, Musician, New York, NY, Hudson, Valley, CT, Original, Bar, Restaurant, Entertainment, Steve Black, Acoustic, Guitar, Drum, Bass, Microphone, Mic, Perform, Performance" />

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="../main.js"></script>

	<link href="../main.css" rel="stylesheet" type="text/css" />
	<link rel="Shortcut Icon" href="/favicon.ico" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://www.steveblackonline.com/rss/shows.xml" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://www.steveblackonline.com/rss/news.xml" />
</head>

<body>
	<div id="header"></div>

	<div id="container">
		<div id="title">
			<div style="float:left;">
				<p><a href="mailto:steve@steveblackonline.com">steve@steveblackonline.com</a></p>
				<p>845-309-3138</p>
			</div>
			<img src="../images/demo_site_title.png" alt="steve black" height="44" width="461" />
		</div> <!-- END: id="title" -->
		
		<div id="tab_nav">
			<div style="z-index:5;" id="first" class="navLink active" data-nav-id="0"><a href="javascript:void(0)">Welcome</a></div>
			<div style="z-index:4;" class="navLink" data-nav-id="1"><a href="javascript:void(0)">Live Demos</a></div>
			<div style="z-index:3;" class="navLink" data-nav-id="2"><a href="javascript:void(0)">Song List</a></div>
			<div style="z-index:2;" class="navLink" data-nav-id="3"><a href="javascript:void(0)">Bio</a></div>
			<div style="z-index:1;" class="navLink" data-nav-id="4"><a href="javascript:void(0)">Success</a></div>
			<div style="z-index:0;background-image:url(../images/tab_bkg_demo.png);"><a href="../index.php" style="color:#333333!important;">Official Site</a></div>
		</div> <!-- END: id="tab_nav" -->
		
		<div id="tab_content">			
			<div class="tab_content_subDiv" id="content0"><? require('welcome_tab.php') ?></div> <!-- id="content0" -->
			<div class="tab_content_subDiv" id="content1"><? require('demo_tab.php') ?></div> <!-- id="content1" -->
			<div class="tab_content_subDiv" id="content2"><? require('song_list_tab.php') ?></div> <!-- id="content2" -->
			<div class="tab_content_subDiv" id="content3"><? require('bio_tab.php') ?></div> <!-- id="content3" -->
			<div class="tab_content_subDiv" id="content4"><? require('success_tab.php') ?></div> <!-- id="content4" -->
		</div> <!-- END: id="tab_content" -->
		
		<div id="content_bottom"></div>
		
		<div id="footer"><a href="http://webdesign.steveblackonline.com">steve black web development &amp; graphic design</a></div>
	</div> <!-- END: id="container" -->
<script>
$( document ).ready(function() {

var intTab = "<?php echo $_GET['i']; ?>";
if (intTab) { $('.navLink[data-nav-id="'+intTab+'"]').click(); }

});
</script>
</body>
</html>