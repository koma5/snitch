<?php
	session_start();
	session_destroy();

	$hostname = $_SERVER['HTTP_HOST'];
	$path = dirname($_SERVER['PHP_SELF']);
	$ref = $_SERVER['HTTP_REFERER'];

	//header('Location: ' .$ref);
	echo "logged out successfully";
?>
