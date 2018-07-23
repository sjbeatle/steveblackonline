				<div class="floatRight"><img src="images/smile_at_guitar.jpg" alt="" style="margin-top:10px;"/></div>
				<h1><strong>W</strong>elcome</h1>
				<img style="margin-left: 60px;" src="images/steve_black_arrow.gif" width="195" height="78" alt="" />
<?php
	$sqlHomeList = "select * from shows left outer join venue on shows.show_venue_ID = venue.venue_ID WHERE shows.show_date>=CURDATE() order by shows.show_date LIMIT 2;"; 
	$arrHomeList = mysql_query($sqlHomeList) or die (mysql_error());
	
	if (mysql_num_rows($arrHomeList) > 0)
	{
		echo "\t\t\t\t<h1><strong>U</strong>pcoming <strong>S</strong>hows</h1>\n";
		echo "\t\t\t\t<div id=\"home_gig\">\n";
		
		while ($row = mysql_fetch_array($arrHomeList)) {
		$strName = $row["venue_name"];
		$strCity = $row["venue_city"];
		$strState = $row["venue_state"];
		$strUrl = $row["venue_url"];
		$strDate = $row["show_date_display"];
		$strTimeStart = $row["show_time_start"];
		$strTimeEnd = $row["show_time_end"];
		
		$strOutput = "";
		$strOutput .= "\t\t\t\t\t<p style=\"margin:0px;\">$strDate: ";
		if ($strUrl) { $strOutput .="<strong><a href=\"$strUrl\">$strName</a></strong> "; } else { $strOutput .="<strong>$strName</strong> "; }
		$strOutput .= "$strCity, $strState $strTimeStart";
		if ($strTimeEnd != " ") { $strOutput .=" - $strTimeEnd"; }
		$strOutput .= "</p>\n";
		
		echo $strOutput;
	}
	
	echo "\t\t\t\t\t<p style=\"text-align:right;\"><a href=\"?i=2\">more shows &raquo;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\n";
	echo "\t\t\t\t</div>";
	}
?>

			