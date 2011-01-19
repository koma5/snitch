<?php
	session_start();

	$hostname = $_SERVER['HTTP_HOST'];
	$path = dirname($_SERVER['PHP_SELF']);

	if (!isset($_SESSION['logedin']) || !$_SESSION['logedin']) {
		echo "login required!";
		//header('Location: http://'.$hostname . '/login-out-form.php');
	exit;
	}
?>
