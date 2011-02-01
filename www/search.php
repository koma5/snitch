<?php include('auth.php'); ?>

		<form>
			<lable name="q">search: </lable>
			<input type="text" name="q" onkeyup="letstype(this.value, 'get_ip_per_host.php')" size="20" />
		</form>


		<div id="qResult"><?php include 'get_ip_per_host.php'; ?> </div>
