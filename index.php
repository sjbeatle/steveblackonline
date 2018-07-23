<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Steve Black - Official</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Steve Black is a solo, acoustic singer/songwriter from the New York Hudson Valley area. His original music is classified Pop/Rock, and his cover selection ranges from popular rock of the sixties to today." />
	<meta name="keywords" content="Steve, Black, Steven, Music, Rock, Roll, Pop, Singer, Song, Songs, Musician, New York, NY, Hudson, Valley, CT, Original, Bar, Restaurant, Entertainment, Steve Black, Acoustic, Guitar, Drum, Bass, Microphone, Mic, Perform, Performance" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="main.js"></script>
	<script type="text/JavaScript" src="scroll.js"></script>
	<script type="text/javascript">AC_FL_RunContent = 0;</script>
	<script src="AC_RunActiveContent.js" type="text/javascript"></script>
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

	<link href="main.css" rel="stylesheet" type="text/css" />
	<link rel="Shortcut Icon" href="/favicon.ico" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://www.steveblackonline.com/rss/shows.xml" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://www.steveblackonline.com/rss/news.xml" />
</head>

<body>
<?php require("admin/config.php"); ?>
	<div id="header"></div>

	<div id="container">
		<div id="title">
			<img src="images/header_title.png" alt="steve black" height="44" width="473" />
		</div> <!-- END: id="title" -->
		
		<div id="tab_nav">
			<div style="z-index:5;" id="first" class="navLink active" data-nav-id="0"><a href="javascript:void(0)">Home</a></div>
			<div style="z-index:4;" class="navLink" data-nav-id="1"><a href="javascript:void(0)">Bio</a></div>
			<div style="z-index:3;" class="navLink" data-nav-id="2"><a href="javascript:void(0)">Shows</a></div>
			<div style="z-index:2;" class="navLink" data-nav-id="3"><a href="javascript:void(0)">Contact</a></div>
			<div style="z-index:1;" class="navLink" data-nav-id="4"><a href="javascript:void(0)">Discography</a></div>
			<div style="z-index:0;background-image:url(images/tab_bkg_demo.png);"><a href="demo/index.php" style="color:#333333!important;">Online Demo</a></div>
		</div> <!-- END: id="tab_nav" -->
		
		<div id="tab_content">
			<div id="music-player">
				<script type="text/javascript">
					if (AC_FL_RunContent == 0) {
						alert("This page requires AC_RunActiveContent.js.");
					}
					else
					{
						AC_FL_RunContent(
							'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
							'width', '341',
							'height', '26',
							'src', 'music_player',
							'quality', 'high',
							'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
							'align', 'middle',
							'play', 'true',
							'loop', 'true',
							'scale', 'showall',
							'wmode', 'window',
							'devicefont', 'false',
							'id', 'music_player',
							'bgcolor', '#1e1a19',
							'name', 'music_player',
							'menu', 'true',
							'allowFullScreen', 'false',
							'allowScriptAccess','sameDomain',
							'movie', 'music_player',
							'salign', ''
							); //end AC code
					}
				</script>
			</div> <!-- END: id="music-player" -->
			
			<div class="tab_content_subDiv" id="content0"><?php require("home_tab.php"); ?></div> <!-- id="content0" -->
			<div class="tab_content_subDiv" id="content1"><?php require("bio_tab.php"); ?></div> <!-- id="content1" -->
			<div class="tab_content_subDiv" id="content2"><?php require("shows_tab.php"); ?></div> <!-- id="content2" -->
			<div class="tab_content_subDiv" id="content3"><?php require("contact_tab.php"); ?></div> <!-- id="content3" -->
			<div class="tab_content_subDiv" id="content4"><?php require("disc_tab.php"); ?></div> <!-- id="content4" -->
		</div> <!-- END: id="tab_content" -->
		
		<div id="content_bottom"></div>
		
		<div id="columns">
			<div class="sub-col3" id="news-col"><?php require("news_column.php"); ?></div> <!-- END: class="sub-col3" id="news-col" -->
			<div class="sub-col3" id="mailing-list-col"><?php require("mailing_list_column.php"); ?></div> <!-- END: class="sub-col3" id="news-col" -->
			<div class="sub-col3" id="network-feed-col"><?php require("network_feed_column.php"); ?></div> <!-- END: class="sub-col3" id="news-col" -->
			
			<div class="clear"></div>
		</div>
		<div style="background-image:url(images/columns_bkg_border_btm.png); height: 1px;"></div>
		
		<div id="footer"><a href="http://webdesign.steveblackonline.com">steve black web development &amp; graphic design</a></div>
	</div> <!-- END: id="container" -->
	
	<div id="error-box">
		<h1><strong>E</strong>rror!</h1>
		<p id="errorMessage"></p>
		<p><input type="button" value="close" onclick="document.getElementById('error-box').style.display = 'none';"/></p>
	</div> <!-- END: error-box -->
	
	<div id="image-box">
		<div style="1000">
			<img id="image-box-image" src="" alt="" title="" onclick="document.getElementById('image-box').style.display = 'none';" />
		</div>
	</div> <!-- END: image-box -->
	
	<script>
$( document ).ready(function() {

var intTab = "<?php echo $_GET['i']; ?>";
if (intTab) { $('.navLink[data-nav-id="'+intTab+'"]').click(); }

});

		pic1= new Image(); 
		pic1.src="http://www.steveblackonline.com/images/mailing_list_error_bkg.png";
	</script>
<?php mysql_close(); ?>
</body>
</html>