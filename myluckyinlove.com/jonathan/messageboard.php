<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jonathan Steven - Official</title>
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript">
<!--
function insertAtCursor(myField, myValue)
{
  //IE support
  if (document.selection)
  {
    myField.focus();
    sel = document.selection.createRange();
    sel.text = myValue;
  }
  //MOZILLA/NETSCAPE support
  else if (myField.selectionStart || myField.selectionStart == '0')
  {
    var startPos = myField.selectionStart;
    var endPos = myField.selectionEnd;
    myField.value = myField.value.substring(0, startPos)
                  + myValue
                  + myField.value.substring(endPos, myField.value.length);
  }
  else
  {
    myField.value += myValue;
  }
}

browser = navigator.appName;
if (browser == "Netscape")
{
	function olink()
	{
		var link = prompt('Enter web address[url]:','http://');
		if (link != null)
		{
			var text = prompt('Enter text for link:','');
			if (text != null)
			{
				insertAtCursor(document.messageForm.message, '<a href="' + link + '" target="_blank"><b>' + text + "</b></a>");
			}
			else
			{
				return;
			}
		}
		else
		{
			return;
		}
	}

	function format(format1, format2)
	{
  		var text = prompt('Enter text to format:','');
  		if (text != null)
 		{
  			insertAtCursor(document.messageForm.message, format1 + text + format2);
  		}
 		 else
  		{
  			return;
  		}
	}

	function format2(format1, format2, format3, id)
	{
		font = document.messageForm.font.options[document.messageForm.font.selectedIndex].value;
		size = document.messageForm.size.options[document.messageForm.size.selectedIndex].value;
 		var text = prompt('Enter text to format:','');
		if (text != null)
 		{
			if (id == "1")
			{
				insertAtCursor(document.messageForm.message, format1 + font + format2 + text + format3);
  			}
			if (id == "2")
			{
				insertAtCursor(document.messageForm.message, format1 + size + format2 + text + format3);
			}
		}
 		else
  		{
			return;
		}
	}

	function format3(position)
	{
		var txt = prompt('Please enter text to be aligned', '')
		insertAtCursor(document.messageForm.message, '<div align="' + position + '">' + txt + '</div>')
	}
}
else
{
	function getSel()
	{
		if (document.selection) txt = document.selection.createRange().text;
		else return;
		return txt;
	}

	function olink()
	{
		var link = prompt('Enter web address[url]:','http://');
		if (link != null)
		{
			getSel();
			insertAtCursor(document.messageForm.message, '<a href="' + link + '" target="_blank"><b>' + txt + "</b></a>");
		}
	}

	function format(format1, format2)
	{
		getSel();
  		insertAtCursor(document.messageForm.message, format1 + txt + format2);
	}

	function format2(format1, format2, format3, id)
	{
		font = document.messageForm.font.options[document.messageForm.font.selectedIndex].value;
		size = document.messageForm.size.options[document.messageForm.size.selectedIndex].value;
		if (id == "1")
		{
			getSel();
			insertAtCursor(document.messageForm.message, format1 + font + format2 + txt + format3);
		}
		if (id == "2")
		{
			getSel();
			insertAtCursor(document.messageForm.message, format1 + size + format2 + txt + format3);
		}
	}

	function format3(position)
	{
		getSel();
		insertAtCursor(document.messageForm.message, '<div align="' + position + '">' + txt + '</div>')
	}
}
//-->
</script>
</head>
<?php require("config.php"); ?>

<body>
<div class="outmost">	
	<div id="header">
		<!-- <div id="logo_w1">Jonathan</div>
		<div id="logo_w2">Steven</div> -->

		<div id="header_text">
			<p>Welcome to the official website of Jonathan Steven!</p>
		</div>
<?php require("menu.htm"); ?>
	</div>
	<div id="content">
		<div id="message_left">
			<img src="images/message_header.gif" alt="Leave a Message" border="0" />
<?php
include("cryptor.php");

// generate random number
$randNum = "";
for ($i = 1; $i <= 6; $i++)
$randNum .= rand(0,9);

$randNum = encrypt($randNum);

print '
<form name="messageForm" method="post" action="signmessage.inc.php">
	<p><strong>Name:&nbsp;</strong></p>
	<input type="text" name="name" size="30" value="" />
	<p>
		<img class="showpointer" src="images/form_bold.jpg" border="1" name="bold" alt="Bold" OnMouseDown=\'format("<b>", "</b>")\'>
		<img class="showpointer" src="images/form_italic.jpg" border="1" name="italics" alt="Italics" OnMouseDown=\'format("<i>", "</i>")\'>
		<img class="showpointer" src="images/form_underline.jpg" border="1" name="underline" alt="Underline" OnMouseDown=\'format("<u>", "</u>")\'>
		<img class="showpointer" src="images/form_hyperlink.jpg" border="1" name="pre" alt="Insert Hyperlink" OnMouseDown="olink();">
	</p>
	<p><strong>Message:</strong></p>
	<textarea name="message" rows="4" cols="20"></textarea>
	<input type="hidden" name="verfnum" value="'.$randNum.'" />
	<p>Type the number shown in the box below:</p>
	<input type="text" name="nobots" />
	<p><img src="randImg.php?r='.$randNum.'" alt="security image" /></p>
	<p><input type="submit" name="btnAdd" value="Submit" /></p>
</form>
';
?>
		</div>
	<div id="message_right">
<?php require("message.inc.php"); ?>
	</div>
	<div id="footerline"></div>
	</div>
	
	<div id="footer">Copyright © 2008.  All rights reserved.</div>	
</div>
<?php mysql_close(); ?>
</body>
</html>
