<?php
function _333_301_summaryfunction($systemuser = 0) {

	// Function will find all Personnel Records done by the defined System User!
	//		>>>>  Achieved reports and edit reports are returned by different functions if even defined at all.
	
	$sql =" SELECT * FROM tbl_139_333_main WHERE 139333_by_cb_int = ".$systemuser." ORDER BY 139333_date DESC, 139333_time DESC";
	
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
						
								$record_date = $objarray['139333_date'];
								$record_time = $objarray['139333_time'];
							}
					}
			}

	return $array = array($number_of_rows,$record_date,$record_time);
	}
	?>