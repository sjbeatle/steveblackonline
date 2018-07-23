<?php
if ($_GET["page"] == "")
{
	if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
	{
		echo "Welcome to the Administration Section";
	}
	else
	{
		echo "Login";
	}
}
else if ($_GET["page"] == "logout")
{
	echo "Logout";
}
else if ($_GET["page"] == "addshow")
{
	echo "Add a Show";
}
else if ($_GET["page"] == "editshow")
{
	echo "Edit Show Details";
}
else if ($_GET["page"] == "deleteshow")
{
	echo "Delete Show(s)";
}
else if ($_GET["page"] == "addvenue")
{
	echo "Add a Venue";
}
else if ($_GET["page"] == "deletevenue")
{
	echo "Delete Venue(s)";
}
else if ($_GET["page"] == "editvenue")
{
	echo "Edit Venue Details";
}
else if ($_GET["page"] == "changepass")
{
	echo "Change Password";
}
else if ($_GET["page"] == "addsong")
{
	echo "Add a Song";
}
?>