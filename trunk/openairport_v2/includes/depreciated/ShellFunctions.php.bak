<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Shell Functions.php				The purpose of this page is to manage different functions used by the Shell Program
	
								Usage:
								This page should work in most cases, but in those cases where it wont, this page should be used as the template for your custome page. When using a custom page you will need to
								account for the new name in the Settings of the Browse and Entry pages of the applicable module.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
function auto_adjust_lease_term($leaseterm) {


	$newstartdate = date('m/1/Y');
	$newstartdate = amerdate2sqldatetime($newstartdate);
	
	$currentmonth 	= date('m');
	$currentyear	= date('Y');
   
	$newenddate = idate('d', mktime(0, 0, 0, ($currentmonth + 1), 0, $currentyear));
	$newenddate	= $currentmonth."/".$newenddate."/".$currentyear;
	$newenddate = amerdate2sqldatetime($newenddate);	

	$sql = "UPDATE tbl_leases_main SET lease_beganon='".$newstartdate."', lease_expectedend='".$newenddate."' WHERE lease_terms_cb_int = '".$leaseterm."'";

	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}		
		else {
			$objrs_support = mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
			//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
			//echo mysql_insert_id($objconn_support);
			mysqli_free_result($objrs_support_support);
			mysqli_close($objconn_support);
			}	
	}

?>
