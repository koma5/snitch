<?php
header("Content-type: text/xml");
echo '<?xml version="1.0"?>',"\n";

?>
<snitch>
<titel>snitch - post</titel>
<content>
<?php
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);
	
	header("Content-type: text/xml");

	include 'db_config.php';
	include 'db_connect.php';

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

    	//thanks to Fenric => https://github.com/Fenric/ProwlPHP
    include('classes/ProwlPHP.php');
    
    $result = mysql_query("SELECT * FROM vIPperHost WHERE hostName = '$hostname' AND ipAddress = '$extip' AND hipActive = TRUE;");
    $RecordCount = mysql_num_rows($result);
    
    if ($RecordCount == 0)
    {
		$prowl = new Prowl('1c1fb8fa620a9577bddd591b5f2b360eb7feb1a1');
		$prowl->push(array(
				  'application'=>'snitch',
				  'event'=>'new ip...',
				  'description'=>"$hostname - $extip ",
				  'priority'=>0,
			  ),true);
		echo "<PushSent>true</PushSent>\n";
		//var_dump($prowl->getError());	// Optional
		//var_dump($prowl->getRemaining()); // Optional
    }
	else
	{
		echo "<PushSent>false</PushSent>\n";
	}


	mysql_query("CALL pPost('$hostname', '$extip')");

	//echo "<date>$date</date>";
	echo "<host>$hostname</host>\n";
	echo "<extip>$extip</extip>\n";
	
	include 'db_close.php';
?>
</content>
</snitch>