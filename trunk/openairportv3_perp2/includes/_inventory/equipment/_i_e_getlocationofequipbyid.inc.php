<?php 
function _i_e_getlocationofequipbyid($equipmentid,$location) {

	$sql = "SELECT * FROM tbl_inventory_sub_e 
			WHERE tbl_inventory_sub_e.equipment_id = '".$equipmentid."' ";
	
	//echo $sql;
	
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
					
							$tmpgroupid 	= $newarray['equipment_id'];
							$tmpgroupname 	= $newarray['equipment_lat'];
							$tmpgrouparch	= $newarray['equipment_long'];
							
							if($location == 'lat') {
								$returned = $tmpgroupname;
								}
								
							if($location == 'long') {
								$returned = $tmpgrouparch;
								}	
							
								}	// End of while loop
								mysqli_free_result($res);
								mysqli_close($mysqli);
						}	// end of Res Record Object						
				}
	return $returned;
	}
	?>