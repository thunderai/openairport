<?
// Determines if the selected inspection is archived.
function tools_139303_c_studenttimeinaclass($facility_id,$condition_id,$student_id) {
// Looks in the table sub_sa for a student id as provided.
//		linked to all applicable 303 table checklist items to get a total time in the class

	$total_class_time = 0;

	$sql_tool = "SELECT * FROM tbl_139_303_c_sub_sa 
			INNER JOIN tbl_systemusers			ON tbl_systemusers.emp_record_id = tbl_139_303_c_sub_sa.discrepancy_student_cb_int  
			INNER JOIN tbl_139_303_c_main		ON tbl_139_303_c_main.139_303_id = tbl_139_303_c_sub_sa.Discrepancy_inspection_id 
			INNER JOIN tbl_139_303_c_sub_c_c	ON tbl_139_303_c_sub_c_c.conditions_checklists_inspection_cb_int = tbl_139_303_c_main.139_303_id 
			INNER JOIN tbl_139_303_c_sub_c		ON tbl_139_303_c_sub_c.conditions_id = tbl_139_303_c_sub_c_c.conditions_checklists_condition_cb_int 
			INNER JOIN tbl_139_303_c_sub_c_f	ON tbl_139_303_c_sub_c_f.facility_id = tbl_139_303_c_sub_c.condition_facility_cb_int 
			WHERE tbl_139_303_c_sub_c_f.facility_id = '".$facility_id."' AND tbl_139_303_c_sub_c.conditions_id = '".$condition_id."' AND tbl_systemusers.emp_record_id = '".$student_id."' ";
	
	//echo $sql_tool;
	
	// Establish a Conneciton with the Database
	$objconn_tool = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs_tool = mysqli_query($objconn_tool, $sql_tool);
				if ($objrs_tool) {
						$number_of_rows_tool = mysqli_num_rows($objrs_tool);
						//printf("result set has %d rows. \n", $number_of_rows);
						while ($objfields_tool = mysqli_fetch_array($objrs_tool, MYSQLI_ASSOC)) {
							
								// Loop through rows, adding total time together
								
								$tmp_class_time 	= $objfields_tool['conditions_checklist_hours'];
								$total_class_time 	= $total_class_time + $tmp_class_time;
								
								
							}
					}	
			}

	return $total_class_time;
	}
?>