				
				<h1><strong>L</strong>atest <strong>N</strong>ews</h1>
				<div id="news-feed">
					<h2></h2>
					<p></p>
					<p>- Steve</p>
				</div> <!-- END: id="news-feed" -->
				<p style="padding-left:10px;">
					<a id="previous-news" href="#" onclick="previousNews();return false;" style="visibility:visible;"><img src="images/arrow_left_white.png" height="24" width="26" alt="previous news" title="previous news" class="noBorder" /></a>&nbsp;&nbsp;
					<a id="latest-news" href="#" onclick="latestNews();return false;" style="visibility:hidden;"><img src="images/arrow_right_white.png" height="24" width="26" alt="latest news" title="latest news" class="noBorder" /></a>
				</p>
<?
	$sqlNews = "select * from news order by news_date desc;"; 
	$arrNews = mysql_query($sqlNews) or die (mysql_error());
	
	$intNumOfItems = mysql_num_rows($arrNews);
?>

				<script type="text/javascript">
					var arrNewsDates = new Array();
					var arrNewsItems = new Array();
					var objHeader = document.getElementById('news-feed').getElementsByTagName('h2')[0];
					var objItem = document.getElementById('news-feed').getElementsByTagName('p')[0];
					var intItem = 0;

<?
	if ($intNumOfItems > 0)
	{	
		$i=0;
		while ($row = mysql_fetch_array($arrNews))
		{
			$strDisplayDate = $row["news_display_date"];
			$strItem = urlencode($row["news_item"]);
?>
					arrNewsDates[<? echo $i; ?>] = "<? echo $strDisplayDate; ?>";
					arrNewsItems[<? echo $i; ?>] = "<? echo $strItem; ?>";
<?
			$i=$i+1;
		}
	}
?>
					objHeader.innerHTML = arrNewsDates[0];
					objItem.innerHTML = unescape(arrNewsItems[0]).replace(/\+/g, ' ');
					
					function previousNews()
					{
						intItem = intItem + 1;
						document.getElementById('news-feed').style.visibility = 'hidden';
						objHeader.innerHTML = arrNewsDates[intItem];
						objItem.innerHTML = unescape(arrNewsItems[intItem]).replace(/\+/g, ' ');
						fireMyPopup("news-feed");
						document.getElementById('latest-news').style.visibility = 'visible';
						if (intItem == (<? echo $intNumOfItems; ?> - 1))
						{
							document.getElementById('previous-news').style.visibility = 'hidden';
						}
						else
						{
							document.getElementById('previous-news').style.visibility = 'visible';
						}
					}

					function latestNews()
					{
						intItem = intItem - 1;
						document.getElementById('news-feed').style.visibility = 'hidden';
						objHeader.innerHTML = arrNewsDates[intItem];
						objItem.innerHTML = unescape(arrNewsItems[intItem]).replace(/\+/g, ' ');
						fireMyPopup("news-feed");
						document.getElementById('previous-news').style.visibility = 'visible';
						if (intItem == 0)
						{
							document.getElementById('latest-news').style.visibility = 'hidden';
						}
						else
						{
							document.getElementById('latest-news').style.visibility = 'visible';
						}
					}
				</script>
			