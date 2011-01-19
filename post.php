<html>
<body>

<?php
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);

	include 'db_config.php';
	include 'db_connect.php';

	//include 'db_init.php';

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



	//insert
	//mysql_query("INSERT INTO host (hostname) values ('$hostname')");
	//$id_of_host = mysql_result(mysql_query("SELECT host.hid FROM host WHERE host.hostname = '$hostname';"), 0, 0 );

	//mysql_query("INSERT INTO ip (address) values ('$extip')");
	//$id_of_ip = mysql_result(mysql_query("SELECT ip.iid FROM ip WHERE ip.address = '$extip';"), 0, 0 );

	//set all records to inactive
	//mysql_query("UPDATE mtm_host_ip SET active=FALSE WHERE fk_host='$id_of_host'");
	
	//mysql_query("INSERT INTO mtm_host_ip (fk_host, fk_ip, active) VALUES ('$id_of_host', '$id_of_ip', TRUE)");
	
	//mysql_query("UPDATE mtm_host_ip SET updated=default WHERE fk_host='$id_of_host' AND fk_ip='$id_of_ip'");
	
	
	mysql_query("CALL post('$hostname', '$extip')");

	echo "$date <br />	$hostname  $extip <br />";
	//echo "id of host: $id_of_host <br />";
	//echo "id of ip: $id_of_ip <br />";

	include 'db_close.php';
?>


</body>
</html>
