<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Lucky in Love - DJ Productions</title>
<link href="main.css" rel="stylesheet" type="text/css" />
<link rel="Shortcut Icon" href="images/favicon.ico">
<style type="text/css">
	<!--
	#box ul {margin-left:20px; list-style:url(images/clover_bullet.gif) !important;}
	#box ul ul {list-style:url(images/heart_bullet.gif) !important;}
	#box ul ul ul {list-style:url(images/note_bullet.gif) !important;}
	#box ol {list-style:decimal;margin-left:35px;margin-top:0px;padding-top:0px;}
	-->
</style>
</head>

<body>
<div id="header"></div>
	
<div id="collage"></div>

<div id="container">
<?php include("nav.php"); ?>
	
	<div id="innerRight">
		<div id="boxTop"></div>
		
		<div id="box"><a name="top"></a>
			<h2><img src="images/lscroll.gif" alt="" /> Steven's Song List <img src="images/scroll.gif" alt="" /></h2>
<?php require("../admin/config.php"); ?>

				<h2>Instrumental (Guitar)</h2>
				<div class="songList" id="songList">
<?php
	$sql = "SELECT instrumentals.title, artists.name, artists.id FROM instrumentals JOIN artists ON instrumentals.artists_id = artists.id ORDER BY artists.alpha_name, instrumentals.title;";
	$arrSQL = mysql_query($sql) or die (mysql_error());
	$count = mysql_num_rows($arrSQL);
	
	$i = 0;
	while ($row = mysql_fetch_array($arrSQL)) {
		$id = $row["id"];
		$strArtistName = $row["name"];
		$strSongTitle = $row["title"];
		
		if ($i==$id)
		{
			echo "<div class='songs'><label>&nbsp;</label> <span class='songTitle'>$strSongTitle</span></div>";
		}
		else
		{
			echo "<div class='songs'><label>$strArtistName</label> <span class='songTitle'>$strSongTitle</span></div>";
		}
		$i=$id;
	}
?>
				</div>
				<p>&nbsp;</p>
				<h2>Guitar and Vocals</h2>
				<div class="songList" id="songList">
<?php
	$sql = "SELECT songs.title, artists.name, artists.id FROM songs JOIN artists ON songs.artists_id = artists.id ORDER BY artists.alpha_name, songs.title;";
	$arrSQL = mysql_query($sql) or die (mysql_error());
	$count = mysql_num_rows($arrSQL);
	
	$i = 0;
	while ($row = mysql_fetch_array($arrSQL)) {
		$id = $row["id"];
		$strArtistName = $row["name"];
		$strSongTitle = $row["title"];
		
		if ($i==$id)
		{
			echo "<div class='songs'><label>&nbsp;</label> <span class='songTitle'>$strSongTitle</span></div>";
		}
		else
		{
			echo "<div class='songs'><label>$strArtistName</label> <span class='songTitle'>$strSongTitle</span></div>";
		}
		$i=$id;
	}
?>
				</div>
				
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
				
				<script type="text/javascript">
					$(document).ready(function(){
						$("div.songs:even").css("background-color","#EEEEEE");
					});
				</script>
				
				<style>
					.songs {padding:2px;clear:both;}
					.songList label {
						clear: both;
						display: block;
						float: left;
						font-weight: bold;
						width: 170px;
					}
					.songTitle {
						clear: both;
						padding-left:15px;
					}
				</style>

<?php mysql_close(); ?>
			<p><a href="#top" style="font-size: 10px;">back to top</a></p>
		</div>
		
		<div id="boxBottom"></div>
	</div>
	
	<div id="break"></div>

<?php include("footer.php"); ?>
</div>

</body>
</html>
