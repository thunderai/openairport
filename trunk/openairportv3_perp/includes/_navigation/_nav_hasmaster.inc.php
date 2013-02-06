<?php

function _nav_hasmaster($menuid) {
		// Function will take the variable $menuid and test to see if there are any menu items
		//		that are slaved to that menu item
		
		// Define initial value to $nor;
			$nor	= 0;
		
		// Function		
			$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			$sql 		= "SELECT * FROM tbl_navigational_control WHERE menu_item_id = ".$menuid."";

		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			} else {
				// load sql syntax with search criteria
				
				//echo "SQL Statement is :".$sql." <br>";
				
				$obrs = mysqli_query($objconn, $sql);
				
				if ($obrs) {
						// Connection to the record set exisits, do work
						// put the number of rows found into a new variable
						$number_of_rows = mysqli_num_rows($obrs);
						// echo "There are ".$number_of_rows." rows in the first level";
						
						while ($objfields = mysqli_fetch_array($obrs, MYSQLI_ASSOC)) {
							
								$mastermenuitem = $objfields['menu_item_slaved_to_id'];
							
							}
					}
			}
	return $mastermenuitem;
	}
?>