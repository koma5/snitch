<?php include 'auth.php'; ?>

<table id="hostlist">
	<tr>
		<th>...</th>
		<th>ip address</th>
		<th>...</th>
	</tr>


<?php
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);

	include 'db_config.php';
	include 'db_connect.php';


	$ip = $_REQUEST["q"];
	$result = mysql_query("SELECT ipAddress FROM tIP WHERE ipAddress LIKE '$ip%';;");
	$RecordCount = mysql_num_rows($result);
	//$RecordCount = 1;
	
	if ($RecordCount > 0)
	{

     	while($row = mysql_fetch_array($result))
     	{

    
      		?>
    
<tr>
  <td colspan="3"><?php echo $row['ipAddress'];  ?></td>
</tr>
      		<?php
     	}
    } //end if RecordCount > 0
    else {
      
       ?>
        
<tr>
  <td colspan="3"><?php echo "oops no record found...";  ?></td>
</tr>
    
        <?php
        
     } // end else


	include 'db_close.php';
?>

</table> <!-- end table #hostlist -->

