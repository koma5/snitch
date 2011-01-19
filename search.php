<?php include('auth.php'); ?>

		<form>
			<lable name="q">search: </lable>
			<input type="text" name="q" onkeyup="letstype(this.value)" size="20" />
		</form>


		<div id="changing"><?php include 'get_ip_per_host.php'; ?> </div>
