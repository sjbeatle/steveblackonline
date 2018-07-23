<?php
			$strRSS = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>\n";
			$strRSS .= "<rss version=\"2.0\">\n\n";
			$strRSS .= "<channel>\n\t";
			$strRSS .= "<title>Steve Black</title>\n\t";
			$strRSS .= "<link>http://www.steveblackonline.com</link>\n\t";
			$strRSS .= "<description>Solo, Acoustic Singer/Songwriter</description>\n\t";
			$strRSS .= "<copyright>2009 Steve Black. All rights reserved.</copyright>\n\t";
			$strRSS .= "<language>en-us</language>\n\t";
			
			$sqlRSS = "select * from shows left outer join venue on shows.show_venue_ID = venue.venue_ID WHERE shows.show_date>=CURDATE() order by shows.show_date limit 10;"; 
			$sqlRSS_main = mysql_query($sqlRSS) or die (mysql_error());
			 
			while ($row = mysql_fetch_array($sqlRSS_main)) {
				$idRSS = $row["show_ID"];
				$strNameRSS = $row["venue_name"];
				$strCityRSS = $row["venue_city"];
				$strStateRSS = $row["venue_state"];
				$strDateRSS = $row["show_date_display"];
				$strTimeStartRSS = $row["show_time_start"];
				$strTimeEndRSS = $row["show_time_end"];
					
				$strRSS .= "\n\t<item>\n\t\t";
				$strRSS .= "<title>".$strDateRSS.": ".$strNameRSS."</title>\n\t\t";
				$strRSS .= "<link>http://www.steveblackonline.com/?i=2&amp;h=450</link>\n\t\t";
				$strRSS .= "<description>$strCityRSS, $strStateRSS $strTimeStartRSS - $strTimeEndRSS</description>\n\t";
				$strRSS .= "</item>\n";
			}
			
			$strRSS .= "</channel>\n\n";
			$strRSS .= "</rss>";
			
			$myFile = "../rss/shows.xml";
			$fh = fopen($myFile, 'w') or die("can't open file");
			fwrite($fh, $strRSS);
			fclose($fh);
?>