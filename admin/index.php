<?
session_start();
require("config.php");

if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
	require ("admin_header.php");
	
	if ($_GET["page"] == "addshow")
	{
		echo "<h1 id=\"admin_title\"><strong>A</strong>dd <strong>S</strong>how</h1>";
		echo "<p id='sub-nav'>Shows: <a href='index.php?index=1&page=addshow'>Add</a> | <a href='index.php?index=1&page=editshow'>Edit</a> | <a href='index.php?index=1&page=copyshow'>Copy</a> | <a href='index.php?index=1&page=deleteshow'>Delete</a></p>";
		require("addshow.inc.php");
	}
	else if ($_GET["page"] == "editshow")
	{
		echo "<h1 id=\"admin_title\"><strong>E</strong>dit <strong>S</strong>how</h1>";
		echo "<p id='sub-nav'>Shows: <a href='index.php?index=1&page=addshow'>Add</a> | <a href='index.php?index=1&page=editshow'>Edit</a> | <a href='index.php?index=1&page=copyshow'>Copy</a> | <a href='index.php?index=1&page=deleteshow'>Delete</a></p>";
		require("editshow.inc.php");
	}
	else if ($_GET["page"] == "copyshow")
	{
		echo "<h1 id=\"admin_title\"><strong>C</strong>opy <strong>S</strong>how</h1>";
		echo "<p id='sub-nav'>Shows: <a href='index.php?index=1&page=addshow'>Add</a> | <a href='index.php?index=1&page=editshow'>Edit</a> | <a href='index.php?index=1&page=copyshow'>Copy</a> | <a href='index.php?index=1&page=deleteshow'>Delete</a></p>";
		require("copyshow.inc.php");
	}
	else if ($_GET["page"] == "deleteshow")
	{
		echo "<h1 id=\"admin_title\"><strong>D</strong>elete <strong>S</strong>how</h1>";
		echo "<p id='sub-nav'>Shows: <a href='index.php?index=1&page=addshow'>Add</a> | <a href='index.php?index=1&page=editshow'>Edit</a> | <a href='index.php?index=1&page=copyshow'>Copy</a> | <a href='index.php?index=1&page=deleteshow'>Delete</a></p>";
		require("deleteshow.inc.php");
	}
	else if ($_GET["page"] == "changepass")
	{
		echo "<h1 id=\"admin_title\"><strong>C</strong>hange <strong>P</strong>assword</h1>";
		require("changepass.inc.php");
	}
	else if ($_GET["page"] == "addvenue")
	{
		echo "<h1 id=\"admin_title\"><strong>A</strong>dd <strong>V</strong>enue</h1>";
		echo "<p id='sub-nav'>Venues: <a href='index.php?index=2&page=addvenue'>Add</a> | <a href='index.php?index=2&page=editvenue'>Edit</a> | <a href='index.php?index=2&page=deletevenue'>Delete</a></p>";
		require("addvenue.inc.php");
	}
	else if ($_GET["page"] == "deletevenue")
	{
		echo "<h1 id=\"admin_title\"><strong>D</strong>elete <strong>V</strong>enue</h1>";
		echo "<p id='sub-nav'>Venues: <a href='index.php?index=2&page=addvenue'>Add</a> | <a href='index.php?index=2&page=editvenue'>Edit</a> | <a href='index.php?index=2&page=deletevenue'>Delete</a></p>";
		require("deletevenue.inc.php");
	}
	else if ($_GET["page"] == "editvenue")
	{
		echo "<h1 id=\"admin_title\"><strong>E</strong>dit <strong>V</strong>enue</h1>";
		echo "<p id='sub-nav'>Venues: <a href='index.php?index=2&page=addvenue'>Add</a> | <a href='index.php?index=2&page=editvenue'>Edit</a> | <a href='index.php?index=2&page=deletevenue'>Delete</a></p>";
		require("editvenue.inc.php");
	}
	else if ($_GET["page"] == "addnews")
	{
		echo "<h1 id=\"admin_title\"><strong>A</strong>dd <strong>N</strong>ews</h1>";
		echo "<p id='sub-nav'>News: <a href='index.php?index=3&page=addnews'>Add</a> | <a href='index.php?index=3&page=deletenews'>Delete</a></p>";
		require("addnews.inc.php");
	}
	else if ($_GET["page"] == "deletenews")
	{
		echo "<h1 id=\"admin_title\"><strong>D</strong>elete <strong>N</strong>ews</h1>";
		echo "<p id='sub-nav'>News: <a href='index.php?index=3&page=addnews'>Add</a> | <a href='index.php?index=3&page=deletenews'>Delete</a></p>";
		require("deletenews.inc.php");
	}
	else if ($_GET["page"] == "addsong")
	{
		echo "<h1 id=\"admin_title\"><strong>A</strong>dd <strong>S</strong>ong</h1>";
		echo "<p id='sub-nav'>Songs: <a href='index.php?index=1&page=addsong'>Add</a> | <a href='index.php?index=1&page=editsong'>Edit</a> | <a href='index.php?index=1&page=deletesong'>Delete</a></p>";
		require("addsong.inc.php");
	}
	else
	{
		$strHTML = "<p>Hi, ".$_SESSION['loggedin']."!\n";
		echo $strHTML;
	}
	
	require("admin_footer.php");
}
//if user is not logged in
else
{
echo $_SESSION['loggedin'];
	require("login.php");
}
?>