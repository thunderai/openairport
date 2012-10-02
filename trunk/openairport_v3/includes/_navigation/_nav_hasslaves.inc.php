<?php

function _nav_hasslaves($menuid) {
		// Function will take the variable $menuid and test to see if there are any menu items
		//		that are slaved to that menu item
		
		// Define initial value to $nor;
			$nor	= 0;
		
		// Function		
			$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			$sql 		= "SELECT * FROM tbl_navigational_control WHERE menu_item_slaved_to_id = ".$menuid."";
			$objrs 		= mysqli_query($objconn, $sql);
			$nor 		= mysqli_num_rows($objrs);
		
		return $nor;
	}
?>