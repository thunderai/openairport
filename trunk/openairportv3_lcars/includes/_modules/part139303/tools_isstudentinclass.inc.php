<?
// Determines if the selected inspection is archived.
function tools_139303_c_isstudentinclass($recordid,$studentid) {
// Looks in the table sub_sa for a student id as provided.

	$sql = "SELECT * FROM tbl_139_303_c_sub_sa WHERE Discrepancy_inspection_id = '".$recordid."' AND discrepancy_student_cb_int	= '".$studentid."' AND discrepancy_hidden_yn = 0";
	
	//echo $sql;
	
	// Establish a Conneciton with the Database
	$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($objcon, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
				}
		}


	if($number_of_rows == 0) {
		
			$displayrow = 0;
		} else {
			$displayrow = 1;
		}


	return $displayrow;
	}
?>