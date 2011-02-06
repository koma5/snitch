<?php include('auth.php'); ?>

		<form>
			<lable name="q">search: </lable>
			<input type="text" name="q" onkeyup="letstype(this.value, 'get_ip.php')" size="20" />
		</form>


		<div id="qResult"><?php include 'get_ip.php'; ?> </div>
