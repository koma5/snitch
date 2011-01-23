<?php

	   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		session_start();
				$username = $_GET['username'];
				$password = md5($_GET['password']);

				$hostname = $_SERVER['HTTP_HOST'];
				$path = dirname($_SERVER['PHP_SELF']);
				$ref = $_SERVER['HTTP_REFERER'];
				//echo 'Location: http://' .$ref;

				//echo "sent username: $username <br /> sent password: $password";

				include 'db_config.php';
				include 'db_connect.php';

				//$realpassword = mysql_result(mysql_query("SELECT password FROM user WHERE username = '$username';"),0 ,0);
				//echo "<br /> real password: " . $realpassword;

				$result = mysql_query("SELECT usrName, usrPassword FROM tUser WHERE tUser.usrName = '$username' AND tUser.usrPassword = '$password';");



				// Mysql_num_row is counting table row
				$count=mysql_num_rows($result);

				if ($count==1){
						$_SESSION['username'] = $username;
						$_SESSION['logedin'] = true;
						echo "logged in successfully!";
						//header('Location: ' .$ref);
				}
				else {
						echo "wrong username or password.";
						//header('Location: ' .$ref . '?');
				}

				include 'db_close.php';

		} //end if method POST
?>
