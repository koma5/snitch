<html>
<head>
</head>
<body>

<?php
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);

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
  
      //var_dump($prowl->getError());	// Optional
      //var_dump($prowl->getRemaining()); // Optional
    }


	mysql_query("CALL pPost('$hostname', '$extip')");

	echo "$date <br />	$hostname - $extip <br />";
	
	include 'db_close.php';
?>


</body>
</html>
