<?
session_start();
require("config.php");

if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
	$intClientID = $_SESSION['loggedin'];
	require ("client_header.php");
	
	$strQueryPrimary = "select ID,
														 song_title,
														 artist
														 from LIL_dn_playlist
														 where client_ID=$intClientID
														 order by song_title;";
	$qryPrimary = mysql_query($strQueryPrimary);
?>
			<h2><img src="../images/lscroll.gif" alt="" /> Your Lucky in Love <img src="../images/scroll.gif" alt="" /></h2>
			<h2 style="text-align: left !important;margin-bottom:0px !important;">DO NOT PLAY list</h2>
			<p>Add a song to your DO NOT PLAY list*, or remove one you've already entered. If you do not know the name of the artist, enter &quot;unknown&quot; in the field.</p>
			<p class="note_this">*Any songs present in this list will NOT be played the night of your event, unless told otherwise by yourself, or your designated person(s).</p>
			
			<div style="float: left;">
				<form name="addSong" method="get" action="javascript:verifyData();">
					<p><input name="song_title" id="song_title" class="text_input" type="text" width="100px" value="Song Title" onfocus="if (this.value == 'Song Title') this.value = '';" onblur="if (this.value == '') this.value = 'Song Title';" /></p>
					<p><input name="artist" id="artist" class="text_input" type="text" width="100px" value="Artist" onfocus="if (this.value == 'Artist') this.value = '';" onblur="if (this.value == '') this.value = 'Artist';" /></p>
					<p style="text-align:right;"><input type="submit" value="Add Song >>>" /></p>
				</form>
			</div>
			
			<script language="javascript">
				var blnOdd = false;
				
				function verifyData()
				{					
					var strSongTitle = document.getElementById('song_title').value;
					var strArtist = document.getElementById('artist').value;
					
					if ((strSongTitle == "" || strSongTitle == "Song Title") && (strArtist == "" || strArtist == "Artist"))
					{
						alert("Please enter a Song Title and Artist first.");
					}
					else if (strArtist == "" || strArtist == "Artist")
					{
						alert("Please enter an Artist first.");
					}
					else if (strSongTitle == "" || strSongTitle == "Song Title")
					{
						alert("Please enter a Song Title first.");
					}
					else
					{
						updateDNPlaylist(document.addSong.song_title.value, document.addSong.artist.value, <? echo $intClientID; ?>);
					}
				}
				
				function addSong(intID)
				{
					var strClass = '';
					if (blnOdd == true)
					{
						strClass = 'odd';
						blnOdd = false;
					}
					else
					{
						blnOdd = true;
					}
					var strSongTitle = document.getElementById('song_title').value;
					var strArtist = document.getElementById('artist').value;
					var strCurrentList = document.getElementById('playlist').innerHTML;
					var strNewSong = "<p class=\"" + strClass + "\" style=\"padding-bottom: 2px;\"><a href=\"#\" class=\"btn_cancel\" onclick=\"deleteDNPlaylist(" + intID + ");this.parentNode.style.display = 'none';return false;\"></a>&nbsp;&nbsp;&nbsp;" + strSongTitle + " by " + strArtist + "</p>";
					strCurrentList = document.getElementById('playlist').innerHTML = strNewSong + strCurrentList;
					
					document.addSong.song_title.value = "Song Title";
					document.addSong.artist.value = "Artist";
				}
			</script>
			
			<div id="playlist" style="float: right; width:440px;">
<?
$i=0;
while ($row = mysql_fetch_array($qryPrimary))
{
	$strSongTitle = $row['song_title'];
	$strArtist = $row['artist'];
	$intID = $row['ID'];
	$blnOdd = false;
	if ( $i&1 ) { $blnOdd = false; } else { $blnOdd = true; } 
?>
				<p<? if ($blnOdd) { echo " class=\"odd\""; } ?> style="padding-bottom: 2px;display: block;">
					<a href="#" class="btn_cancel" onclick="deleteDNPlaylist(<? echo $intID ?>);this.parentNode.style.display = 'none';return false;"></a>&nbsp;&nbsp;&nbsp;<? echo $strSongTitle ?> by <? echo $strArtist ?>
				</p>
<?
	$i = $i + 1;
}
?>
			</div>
			<div style="height:0px;clear:both;padding:0px;"></div>
<?
	require("client_footer.php");
}
//if user is not logged in
else
{
echo $_SESSION['loggedin'];
	require("login.php");
}
mysql_close();
?>
