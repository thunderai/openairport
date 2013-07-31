<?php
include("includes/_template_header.php");	
//include("includes/quickaccessFunctions.php");	

		$newfilterid 	= $_GET['newfilterid'];
		$myid			= $_GET['myid'];
		$mylocation		= $_GET['mylocation'];
		$myfield		= $_GET['myfield'];
		$myfield2update	= $_GET['myfield2update'];
			
// Connect to database and do an UPDATE SQL Connection
// 		$sql = "UPDATE tbl_139_327_main SET type_of_inspection_cb_int='".$_POST['distype']."', inspection_completed_by_cb_int='".$_POST['disauthor']."', 139327_date='".$tmpdate."', 139327_time='".$_POST['distime']."' WHERE inspection_system_id=".$_POST['recordid'];
		
$sql = 'UPDATE '.$mylocation.' SET '.$myfield2update.'='.$newfilterid.' WHERE '.$myfield.'='.$myid.' ';
$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
//mysql_insert_id();
		
if (mysqli_connect_errno()) {
		//echo "[1][a][2] Connection REJECTED <br>";
		printf("connect failed: %s\n", mysqli_connect_error());
		exit();
	}		
	else {

		//echo "[1][a][2] Connection Established <br>";						
		$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
		$lastid = mysqli_insert_id($mysqli);
		
		//echo "[1][a][2] The Inpsection has been updated with ID ".$lastid." <br>";
	}
?>
Done