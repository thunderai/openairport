<?php
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Quickaccess Functions.php			The purpose of this file is to allow for functions that can be used multiple times in many different files, cleaning up the apperence of the pages as well as increasing their usability.
	
								Usage:
								Just include this page in with your other page and the functions will be avilable to be used in that page.
								
								
								
								
	NOTE: THERE SHOULD BE NO NEED TO CHANGE ANY OF THE CODE ON THIS PAGE
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	

function qac_test_exisist($menuid,$userid,$test) {
		// Tests to see if this item is already in the Quick Access Menu System
		$nsql = "";
		
		$sql = "SELECT * FROM tbl_quickaccess_control WHERE tbl_qac_systemuser_id = ".$userid." AND tbl_qac_navigation_id = ".$menuid."";
		//echo "Function SQL :".$sql."<br><br>";

	if ($test=="test") {
				$nsql = " AND tbl_qac_hidden_yn = 0";
			}
		
		$sql = $sql.$nsql;
		//echo $sql;
		
		$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$res = mysqli_query($mysqli, $sql);
				if ($res) {
						$number_of_rows = mysqli_num_rows($res);
						//echo "Number of Rows ".$number_of_rows;
					}
			}
			
	return $number_of_rows;	
	}

?>