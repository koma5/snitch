<?php
	session_start();
		if (!isset($_SESSION['logedin']) || !$_SESSION['logedin'])
		{ ?>

		<form action="login.php" method="post">
						<label for="username">username: </label>
						<input type="text" name="username" id="username" value="<?=$username?>" />
						<br />

						<label for="password">password: </label>
						<input type="text" name="password" id="password" />
						<br />
						<input type="submit" value="login" />
				</form>
		<a href="search.php">search.php</a>

		<?php
				exit;
		 } //end if
		else
		{ ?>

				<form action="logout.php" method="GET">
						<input type="submit" value="logout" />
		</form>
				<a href="search.php">search.php</a>

		<?php } //end else


?>
