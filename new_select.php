<table id="hostlist">
	<tr>
		<th>hostname</th>
		<th>ip</th>
		<th>changed</th>
	</tr>
 

<?php
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);

	
	include 'db_config.php';
	include 'db_connect.php';

	date_default_timezone_set('Europe/Zurich');
	$date = date("U");

	$hostname = $_REQUEST["hostname"];
	$result = mysql_query("SELECT hostname, address, Unix_Timestamp(updated) FROM ip_per_host WHERE hostname LIKE '$hostname%';");

	while($row = mysql_fetch_array($result))
	{

		$seconds = $date - $row['Unix_Timestamp(updated)'];
		//$secondsago = 31536010;


		?>

	<tr>
		<td><?php echo $row['hostname'];  ?></td>
		<td><?php echo $row['address'];  ?></td>
		<td><?php echo agostring($seconds);  ?></td>
	</tr>
		<?php
	}


	include 'db_close.php';
?>

</table> <!-- end table #hostlist -->




<?php 


function agostring($secondsago) {
	



	if ($secondsago >= 31536000) {
		$weeksago = floor($secondsago/604800);
		$agostring = $weeksago . " weeks ago";
	}

	if ($secondsago < 31536000 && $secondsago >= 604800) {
		$weeksago = floor($secondsago/604800);
		$agostring = $weeksago . " weeks ago";
		if ($weeksago == 1){
			$agostring = $weeksago . " week ago";
		}
		else {
			$agostring = $weeksago . " weeks ago";
		}
		
	}

	if ($secondsago < 604800 && $secondsago >= 86400) {
		$daysago = floor($secondsago/86400);
		if ($daysago == 1){
			$agostring = $daysago . " day ago";
		}
		else {
			$agostring = $daysago . " days ago";
		}
	}

	if ($secondsago < 86400 && $secondsago >= 3600) {
		$hoursago = floor($secondsago/3600);
		if ($hoursago == 1){
			$agostring = $hoursago . " hour ago";
		}
		else {
			$agostring = $hoursago . " hours ago";
		}
	}

	if ($secondsago < 3600 && $secondsago >= 60) {
		$minutesago = floor($secondsago/60);
		if ($minutesago == 1){
			$agostring = $minutesago . " minute ago";
		}
		else {
			$agostring = $minutesago . " minutes ago";
		}
	}

	if ($secondsago < 60) {
		if ($secondsago == 1){
			$agostring = $secondsago . " second ago";
		}
		else {
			$agostring = $secondsago . " seconds ago";
		}
	}

	return $agostring;
}

?>
