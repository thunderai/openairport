<?php
function _327_a_4_301_summaryfunction($systemuser = 0) {

	// Function will find all Personnel Records done by the defined System User!
	//		>>>>  Achieved reports and edit reports are returned by different functions if even defined at all.
	
	$effectivetotal	= 0;
	$record_date	= 0;
	$record_time	= 0;
	
	$sql =" SELECT * FROM tbl_139_327_sub_d WHERE Discrepancy_by_cb_int = ".$systemuser." ORDER BY Discrepancy_date DESC, Discrepancy_time DESC";
	
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
						
								$tmpdiscrepancyid 	= $objarray['Discrepancy_id'];
								
								$displayrow_a		= preflights_tbl_139_327_main_sub_d_a_yn($tmpdiscrepancyid,0); // 1 will not return a row even if it is archieved.
								$displayrow_d		= preflights_tbl_139_327_main_sub_d_d_yn($tmpdiscrepancyid,0); // 1 will not return a row even if it is duplicate.

								//echo "Display A ".$displayrow_a." / Display D ".$displayrow_d." <br>";
							
								if($displayrow_a == 0 OR $displayrow_d == 0) {
										// Do display Row
										$displayrow = 0;
									}
									else {
										$displayrow = 1;
									}
								
								if($displayrow == 1) {	

										$effectivetotal 	= $effectivetotal + 1;
										$record_date 		= $objarray['Discrepancy_date'];
										$record_time 		= $objarray['Discrepancy_time'];
									}
								
							}
					}
			}

	return $array = array($effectivetotal,$record_date,$record_time);
	}
	?>