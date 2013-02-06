<?php
//
// The purpose of this code is to add entries to the daily log routine
function autodutylogentry($date,$time,$author,$event) {

	$sql = "INSERT INTO tbl_duty_log (duty_log_comments,duty_log_by_cb_int,duty_log_date,duty_log_time) VALUES ('".$event."', '".$author."', '".$date."', '".$time."')";
	$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}		
		else {
		//mysql_insert_id();
			$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
			$lastid = mysqli_insert_id($objconn_support);
			//echo $tmp;
			//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
			//echo mysql_insert_id($objconn_support);
			//mysqli_free_result($objrs_support);													// Apperently not required or useable for this type of transaction
			mysqli_close($objconn_support);
			}
	}
?>