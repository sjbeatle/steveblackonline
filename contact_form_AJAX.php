<?
Header('Cache-Control: no-cache');
Header('Pragma: no-cache');

//initialize variables
$strName = $_GET['name'];
$strEmail = $_GET['email'];
$strMessage = addslashes(urldecode(stripslashes($_GET['message'])));

if (mail("stevenjblack@gmail.com", "Contact Form Submission", stripslashes($strMessage), "From: $strName < $strEmail >"))
{
	print_r("1");
}
else
{
	print_r("0");
}
?>
