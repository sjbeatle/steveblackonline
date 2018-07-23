<?php
			$strRSS = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>\n";
			$strRSS .= "<rss version=\"2.0\">\n\n";
			$strRSS .= "<channel>\n\t";
			$strRSS .= "<title>Steve Black</title>\n\t";
			$strRSS .= "<link>http://www.steveblackonline.com</link>\n\t";
			$strRSS .= "<description>Solo, Acoustic Singer/Songwriter</description>\n\t";
			$strRSS .= "<copyright>2009 Steve Black. All rights reserved.</copyright>\n\t";
			$strRSS .= "<language>en-us</language>\n\t";
			
			$sqlRSS = "select * from news order by news_date desc limit 10;"; 
			$sqlRSS_main = mysql_query($sqlRSS) or die (mysql_error());
			 
			while ($row = mysql_fetch_array($sqlRSS_main)) {
				$strDateRSS = $row["news_display_date"];
				$strItemRSS = $row["news_item_raw"];
					
				$strRSS .= "\n\t<item>\n\t\t";
				$strRSS .= "<title>".$strDateRSS."</title>\n\t\t";
				$strRSS .= "<link>http://www.steveblackonline.com/</link>\n\t\t";
				$strRSS .= "<description>$strItemRSS</description>\n\t";
				$strRSS .= "</item>\n";
			}
			
			$strRSS .= "</channel>\n\n";
			$strRSS .= "</rss>";
			
			$myFile = "../rss/news.xml";
			$fh = fopen($myFile, 'w') or die("can't open file");
			fwrite($fh, $strRSS);
			fclose($fh);
?>