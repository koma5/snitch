<?php	
	$db_connection = mysql_connect($db_server, $db_user, $db_password) or die ("connect to db failed!");
	mysql_select_db($db_name, $db_connection) or die ("select of db failed!");
?>
