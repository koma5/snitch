<html>
<head>
</head>
<body>

<?php
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);

	include 'db_config.php';
	include 'db_connect.php';

	date_default_timezone_set('Europe/Zurich');
	$date = date("c");

	// get extip from client
	$extip = $_SERVER['REMOTE_ADDR'];
	if ($_REQUEST["extip"])
	{
		$extip = $_REQUEST["extip"];
	}


	//get hostname from client
	$hostname = $_REQUEST["hostname"];

	mysql_query("CALL pPost('$hostname', '$extip')");

	echo "$date <br />	$hostname - $extip <br />";

	include 'db_close.php';
?>


</body>
</html>
