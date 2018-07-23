<?
	require("config.php");
	include("cryptor.php");
	
	if (isset($_POST['btnAdd'])) {
    $nobots = $_POST['nobots'];
    $postVerf = decrypt($_POST['verfnum']);

    if ($nobots != $postVerf) die("The numbers you entered do not match those shown in the image. Please go back and try again.");
	} 

  //display results
  //initialize variables
  $name = $_POST['name'];
  $str= $_POST['message'];
  $order = array("\r\n", "\n", "\r");
  $replace = '<br />';
  $entry = str_replace($order, $replace, $str);
  $date = date("Y/m/d");

  if (!$name || !$entry)
  {
  	print <<<EOF
<br /><font color="#FF0000">You either did not fill out your name or did not fill out a message.<br />
Please use your browser's back button to fix your entry.</font><br /><br />
EOF;
  }
  else
  {
  	// Connect to the Database
	$sql = "INSERT INTO BB_MESSAGEBOARD (NAME, MESSAGE, ENTRY_DATE) ";
	$sql .= "VALUES ('$name', '$entry', '$date')";
	$result = mysql_query($sql);
	if ($result)
	{
	mysql_close();
	header ('Location: http://www.myluckyinlove.com/jonathan/messageboard.php');
	}
	else
	{
	mysql_close();
  	print <<<EOF
<br /><font color="#FF0000">There was an error entering your message.<br />
EOF;
	}
  }
	
?>