<?
	$sqlCurrentGig = "select * from shows left outer join venue on shows.show_venue_ID = venue.venue_ID WHERE shows.show_date>=CURDATE() order by shows.show_date LIMIT 1;"; 
	$arrCurrentGig = mysql_query($sqlCurrentGig) or die (mysql_error());
?>

				<div id="showDetails">
					<h1 style="margin-left:0px;"><strong>S</strong>how <strong>D</strong>etails</h1>
<?
	if (mysql_num_rows($arrCurrentGig) > 0)
	{	
		while ($row = mysql_fetch_array($arrCurrentGig)) {
			$strName = urlencode($row["venue_name"]);
			$strStreet = urlencode($row["venue_street"]);
			$strCity = urlencode($row["venue_city"]);
			$strState = $row["venue_state"];
			$strZip = $row["venue_zip"];
			$strUrl = $row["venue_url"];
			$strEmail = $row["venue_email"];
			$strPhone = $row["venue_phone"];
			$strDate = $row["show_date_display"];
			$strTimeStart = $row["show_time_start"];
			$strTimeEnd = $row["show_time_end"];
			$strCover = $row["show_cover"];
			$strInfoDisplay = urlencode($row["show_info"]);
			
			$strOutput = "";
			$strOutput .= "\t\t\t\t\t<h2 style='color:#dee2d4'>$strDate</h2>\n";
			$strOutput .= "\t\t\t\t\t<p>$strTimeStart";
			if ($strTimeEnd != " ") { $strOutput .=" - $strTimeEnd"; }
			$strOutput .= "</p>\n";
			
			$strOutput .= "\t\t\t\t\t<h2><strong>V</strong>enue</h2>\n";
			if ($strUrl)
			{
				$strOutput .= "\t\t\t\t\t<p><a href=\"$strUrl\">".urldecode($strName)."</a></p>\n";
			}
			else
			{
				$strOutput .= "\t\t\t\t\t<p>".urldecode($strName)."</p>\n";
			}
			$strOutput .= "\t\t\t\t\t<p>".urldecode($strStreet)."<br />";
			$strOutput .= urldecode($strCity).", ";
			$strOutput .= "$strState $strZip</p>\n";
			if (!$strEmail) {$strOutput .= "\t\t\t\t\t<p>E-mail: none<br />";}else{$strOutput .= "\t\t\t\t\t<p>E-mail: <a href=\"mailto:$strEmail\">E-mail ".urldecode($strName)."</a><br />";}
			if ($strPhone) {$strOutput .= "Phone: $strPhone<br />";}
			$strOutput .= "Cover: $strCover</p>\n";
	
			echo $strOutput;
		}
	}
?>
				</div> <!-- END: id="showDetails" -->

				<div id="showList">
					<h1><strong>S</strong>hows</h1>
					<div id="divScrollTextCont">
						<div id="divText">
						<h2 style="text-align:center;"><strong>S</strong>tart of <strong>L</strong>ist</h2>
							<ul>
<?
	$sqlUpcoming = "select * from shows left outer join venue on shows.show_venue_ID = venue.venue_ID WHERE shows.show_date>=CURDATE() order by shows.show_date;"; 
	$arrUpcoming = mysql_query($sqlUpcoming) or die (mysql_error());
	
	if (mysql_num_rows($arrUpcoming) > 0)
	{	
		while ($row = mysql_fetch_array($arrUpcoming)) {
		$strName = urlencode($row["venue_name"]);
		$strStreet = urlencode($row["venue_street"]);
		$strCity = urlencode($row["venue_city"]);
		$strState = $row["venue_state"];
		$strZip = $row["venue_zip"];
		$strUrl = $row["venue_url"];
		$strEmail = $row["venue_email"];
		$strPhone = $row["venue_phone"];
		$strDate = $row["show_date_display"];
		$strTimeStart = $row["show_time_start"];
		$strTimeEnd = $row["show_time_end"];
		$strCover = $row["show_cover"];
		$strInfo = urlencode($row["show_info"]);
		
		$strOutput = "";
		$strOutput .= "\t\t\t\t\t\t\t\t<li>$strDate: ";
		if ($strUrl) { $strOutput .="<strong><a href=\"$strUrl\">".urldecode($strName)."</a></strong> "; } else { $strOutput .="<strong>".urldecode($strName)."</strong> "; }
		$strOutput .= urldecode($strCity).", ".urldecode($strState)." $strTimeStart";
		if ($strTimeEnd != " ") { $strOutput .=" - $strTimeEnd"; }
		$strOutput .= " <a href=\"#\" onclick=\"updateDetails('$strName','$strStreet','$strCity','$strState','$strZip','$strUrl','$strEmail','$strPhone','$strDate','$strTimeStart','$strTimeEnd','$strCover','$strInfo');return false;\">details</a></li>\n";
		
		echo $strOutput;
		}
	}
?>
							</ul>
							<h2 style="text-align:center;"><strong>E</strong>nd of <strong>L</strong>ist</h2>
							<p>&nbsp;</p>
						</div> <!-- END: id="divScrollTextCont" -->
					</div> <!-- END: id="divText" -->
				</div> <!-- END: id="showList" -->

				<!-- <div id="showsScrollArrows">
					<div style="margin-top:34px;"><a href="#" onmousedown="scroll(-2)" onmouseup="noScroll()" onclick="return false"><img src="images/arrow_up.png" alt="" class="noBorder" /></a></div>
					<div style="margin-top:174px;"><a href="#" onmousedown="scroll(2)" onmouseup="noScroll()" onclick="return false"><img src="images/arrow_down.png" alt="" class="noBorder" /></a></div>
				</div> END: id="showsScrollArrows" -->

				<div class="clear"></div>

				<div>
					<h2><strong>E</strong>xtra <strong>I</strong>nfo</h2>
					<div id="extraInfo"><? echo urldecode($strInfoDisplay); ?></div>
				</div>
			