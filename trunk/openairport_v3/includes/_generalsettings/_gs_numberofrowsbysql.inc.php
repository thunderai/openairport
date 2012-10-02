<?php

function gs_numberofrows($suppliedsql) {
		// Takes the supplied SQL statement, runs it and returns the total number of rows found:
		$objconn_general = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
			}					
			else {
				$objrs_general = mysqli_query($objconn_general, $suppliedsql);								
				if ($objrs_general) {
						$number_of_rows = mysqli_num_rows($objrs_general);	
					}
			}
	return $number_of_rows;
	}
	?>