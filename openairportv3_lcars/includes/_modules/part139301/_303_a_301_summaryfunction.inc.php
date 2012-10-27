<?php
function _303_a_301_summaryfunction($systemuser = 0) {

	// Function will find all Personnel Records done by the defined System User!
	//		>>>>  Achieved reports and edit reports are returned by different functions if even defined at all.
	
	$sql =" SELECT * FROM tbl_systemusers WHERE emp_added_by_int = ".$systemuser." ORDER BY emp_addedon_date DESC, emp_addon_time DESC";
	
		//echo "Connect to database usining this SQL statement ".$sql." <br>";				
		$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);
						
				if ($objrs) {
						$number_of_rows = mysqli_num_rows($objrs);
						while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								$record_date = $objarray['emp_addedon_date'];
								$record_time = $objarray['emp_addon_time'];
							}
					}
			}

	return $array = array($number_of_rows,$record_date,$record_time);
	}
	?>