<?php 

function _nav_getbysuid_navigationalgrouptext($systemuser_id) {

	$sql = "SELECT * FROM tbl_systemusers 
			INNER JOIN tbl_systemusers_ncga ON tbl_systemusers_ncga.navigational_user_id_cb_int = tbl_systemusers.emp_record_id 
			INNER JOIN tbl_navigational_control_g ON tbl_navigational_control_g.navigational_groups_id = tbl_systemusers_ncga.navigational_group_id_cb_int 
			WHERE tbl_systemusers.emp_record_id = '".$systemuser_id."' ";
	
	//echo $sql;
	
	$tmpgroupname = "No Access Rights Assigned";
	
	$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($mysqli, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($newarray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
					
							$tmpgroupid 	= $newarray['navigational_groups_id'];
							$tmpgroupname 	= $newarray['navigational_groups_name'];
							$tmpgrouparch	= $newarray['navigational_groups_archived_yn'];
							
								}	// End of while loop
								mysqli_free_result($res);
								mysqli_close($mysqli);
						}	// end of Res Record Object						
				}
	return $tmpgroupname;
	}
	?>