<?php
function getccvalue($conditionid,$inspectionid) {
		// ID of Condition
		// Inspection ID
		
		$sql = "SELECT * FROM tbl_139_333_sub_c_c WHERE conditions_checklists_condition_cb_int = '".$conditionid."' AND conditions_checklists_inspection_cb_int = '".$inspectionid."' ";
		$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($objfieldss = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
					
							$valuearray = $objfieldss['conditions_checklist_values'];
						}
				}
		}
		
		return $valuearray;
	}							