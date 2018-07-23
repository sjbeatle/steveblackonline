<?
Header('Cache-Control: no-cache');
Header('Pragma: no-cache');

//initialize variables
$strName = $_GET['name'];
$strEmail = $_GET['email'];

if (mail("stevenjblack@gmail.com", "Mailing List Submission", stripslashes($strName)."\n".$strEmail, "From: Mailing List < donotreply@steveblackonline.com >"))
{
	if (mail($strEmail, "Steve Black Mailing List", "Thanks for joining the Steve Black Mailing List!\n\n-Steve", "From: Steve Black < steve@steveblackonline.com >"))
	{
		print_r("1");
	}
	else
	{
		print_r("0");
	}
}
else
{
	print_r("0");
}
?>
