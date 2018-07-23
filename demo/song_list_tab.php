<?php require("../admin/config.php"); ?>

				<h1><strong>S</strong>ong <strong>L</strong>ist</h1>
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
						$("div.songs:even").css("background-color","#241f1e");
					});
				</script>

<?php mysql_close(); ?>