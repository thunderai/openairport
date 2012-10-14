<?php
//
// The purpose of this function is to find what the curret stage of the discrepancy is in the discrepancy life cycle. 

function part139327discrepancy_getstage($discrepancy_id,$inspection_date = 0, $inspection_time = 0, $array_workorder = 0,$detail,$inspection_timestamp = 0) {
		// Define some variables for this function
	// INPUT
		// detail
		//				0 - Work off a discrepancy ID
		//				1 - Work from a known Inspection
		//				2 - Work from an array

	// OUTPUT	
		// Status:
		//				0 - NO HISTORY, Requires a Work Order (ie. needs to be repaired)
		//				1 - Needs to be Repaired (is currently bounced)
		//				2 - Needs to be Bounced (is currently repaired)
		//				3 - Closed
		
		$bounced		= 0;
		$repaired 		= 0;
		$status			= 0;
		$tempinspdate	= 0;
		$tempinsptime	= 0;
		
		$loop			= 0;
		//$abounced		= array;
		
		// Find all Discrepancies issued prior to this inspection?
		
		$discrepancyrepairid 	= "";
		$discrepancyrepairdate 	= "";
		$discrepancyrepairtime 	= "";
		
		$discrepancybouncedid 	= "";
		$discrepancybounceddate = "";
		$discrepancybouncedtime = "";
		
		$discrepancyclosedid 	= "";
		$discrepancycloseddate 	= "";
		$discrepancyclosedtime 	= "";
		
		if($detail == 0) {
				// Work from a discrepancy ID
				$tablename	= 'discrepancy';
				$sql2		= "SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = '".$discrepancy_id."' ";
			}
		if($detail == 1) {
				// Work from a known Inspection Date and Time
				$tablename	= 'discrepancy';
				$sql2		= "SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = '".$discrepancy_id."' AND discrepancy_repaired_timestamp <= '".$inspection_timestamp."' ORDER BY discrepancy_repaired_date, discrepancy_repaired_time";
				//echo  "-> SQL Repair is ".$sql2."<br>";
			}
		if($detail == 2) {	
				// Work from an Array
				$tablename	= $array_workorder[1][1];
				// Repaired Information is the 1st element in the array
				$sql2 		= $array_workorder[1][0]."'".$discrepancy_id."' ORDER BY ".$array_workorder[1][1]."_repaired_date, ".$array_workorder[1][1]."_repaired_time";
			}
		
		$objconn2 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs2 = mysqli_query($objconn2, $sql2);

				if ($objrs2) {
						$number_of_rows = mysqli_num_rows($objrs2);
						//////echo  $number_of_rows;
						while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
							$discrepancyrepairid 	= $objarray2[$tablename.'_repaired_id'];
							$discrepancyid 			= $objarray2[$tablename.'_repaired_inspection_id'];
							$discrepancyrepairdate 	= $objarray2[$tablename.'_repaired_date'];
							$discrepancyrepairtime 	= $objarray2[$tablename.'_repaired_time'];
							}
					}
			//mysqli_free_result($objrs2);
			//mysqli_close($objcon2);			
			}
								
		
			// Test to see if it has any bounced records before the inspection...

		if($detail == 0) {
				// Work from a discrepancy ID
				$tablename	= 'discrepancy';
				$sql2		= "SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = '".$discrepancy_id."' ";
			}
		if($detail == 1) {
				// Work from a known Inspection Date and Time
				$tablename	= 'discrepancy';
				$sql2 		= "SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = '".$discrepancy_id."' AND discrepancy_bounced_timestamp <= '".$inspection_timestamp."' ORDER BY discrepancy_bounced_date, discrepancy_bounced_time";
				////echo  "-> SQL Bounce is ".$sql2."<br>";
			}
		if($detail == 2) {	
				$sql2 		= "SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = '".$discrepancy_id."' ORDER BY discrepancy_bounced_date, discrepancy_bounced_time";
				$tablename	= $array_workorder[0][1];
				// Repaired Information is the 1st element in the array
				$sql2 		= $array_workorder[0][0]."'".$discrepancy_id."' ORDER BY ".$array_workorder[0][1]."_bounced_date, ".$array_workorder[0][1]."_bounced_time";
			}			
		
		$objconn2 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				else {
					$objrs2 = mysqli_query($objconn2, $sql2);

					if ($objrs2) {
							$number_of_rows = mysqli_num_rows($objrs2);
							//////echo  "Bouced Rows ".$number_of_rows;
							while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
								$discrepancybouncedid 	= $objarray2[$tablename.'_bounced_id'];
								$discrepancyid 			= $objarray2[$tablename.'_bounced_inspection_id'];
								$discrepancybounceddate = $objarray2[$tablename.'_bounced_date'];
								$discrepancybouncedtime = $objarray2[$tablename.'_bounced_time'];
								}
						}
				}
				//mysqli_free_result($objrs2);
				//mysqli_close($objcon2);		

			// Test to see if it has any closed records before the inspection...

		if($detail == 0) {
				// Work from a discrepancy ID
				$tablename	= 'discrepancy';
				$sql2		= "SELECT * FROM tbl_139_327_sub_d_c WHERE discrepancy_closed_inspection_id = '".$discrepancy_id."' ";
			}
		if($detail == 1) {
				// Work from a known Inspection Date and Time
				$tablename	= 'discrepancy';
				$sql2 		= "SELECT * FROM tbl_139_327_sub_d_c WHERE discrepancy_closed_inspection_id = '".$discrepancy_id."' AND discrepancy_closed_timestamp <= '".$inspection_timestamp."' ORDER BY discrepancy_closed_date, discrepancy_closed_time";
				////echo  "-> SQL Bounce is ".$sql2."<br>";
			}
		if($detail == 2) {	
				$sql2 		= "SELECT * FROM tbl_139_327_sub_d_c WHERE discrepancy_closed_inspection_id = '".$discrepancy_id."' ORDER BY discrepancy_closed_date, discrepancy_closed_time";
				$tablename	= $array_workorder[0][1];
				// Repaired Information is the 1st element in the array
				$sql2 		= $array_workorder[0][0]."'".$discrepancy_id."' ORDER BY ".$array_workorder[0][1]."_closed_date, ".$array_workorder[0][1]."_closed_time";
			}			
		
		$objconn2 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				else {
					$objrs2 = mysqli_query($objconn2, $sql2);

					if ($objrs2) {
							$number_of_rows = mysqli_num_rows($objrs2);
							//////echo  "Bouced Rows ".$number_of_rows;
							while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
								$discrepancyclosedid 	= $objarray2[$tablename.'_closed_id'];
								$discrepancyid 			= $objarray2[$tablename.'_closed_inspection_id'];
								$discrepancycloseddate 	= $objarray2[$tablename.'_closed_date'];
								$discrepancyclosedtime 	= $objarray2[$tablename.'_closed_time'];
								}
						}
				}
				//mysqli_free_result($objrs2);
				//mysqli_close($objcon2);				
				
				
		////echo  "Discrepancy Repaired ID 	[".$discrepancyrepairid."] <br>";	
		////echo  "Discrepancy Repaired ID 	[".$discrepancybouncedid."] <br>";	
		////echo  "Discrepancy Closed ID 	[".$discrepancyclosedid."] <br>";

		////echo  "Discrepancy Repaired Date 	[".$discrepancyrepairdate."] <br>";	
		////echo  "Discrepancy Bounced Date 	[".$discrepancybounceddate."] <br>";	
		////echo  "Discrepancy Closed Date 		[".$discrepancycloseddate."] <br>";		
		
		////echo  "Discrepancy Repaired Time 	[".$discrepancyrepairtime."] <br>";	
		////echo  "Discrepancy Bounced Time 	[".$discrepancybouncedtime."] <br>";	
		////echo  "Discrepancy Closed Time 		[".$discrepancyclosedtime."] <br>";

		// We now have all of the information we need to figure out the current stage of the discrepancy!
		
	// OUTPUT	
		// Status:
		//				0 - NO HISTORY, Requires a Work Order (ie. needs to be repaired)
		//				1 - Needs to be Repaired (is currently bounced)
		//				2 - Needs to be Bounced (is currently repaired)	
		//				3 - Closed
		
		if($discrepancyrepairid == '') {
				// This Discrepancy has never been fixed.
				// Display the Options to fix it!
				//echo  "=-> Never been fixed <i>(Add ability to repair)</i><br>";
				$status = 0;
			}
			else {
				if($discrepancyclosedid == '') {
						// This discrepancy has never been closed.
						//	Continue with tests					
				
						// There must be at least one repair record for this discrepancy!
						// Has it ever been bounced?
						//echo  "=-> x1+ Repair Records Exisit <br>";
						if($discrepancybouncedid == '') {
								// This discrepancy has never been bounced, so it must be repaired.
								// Display the Mark Bounced Options
								//echo  "=-> Never has been bounced <i>(Add ability to bounce)</i><br>";
								$status = 2;
							}
							else {
								// This discrepancy has at least one bounced record. 
								// What is most recent, the bounce or the repair record?
								//echo  "=-> x1+ Bounce Records Exisit <br>";
								if($discrepancybounceddate > $discrepancyrepairdate) {
										// The discrepancy has more recently been bounced than repaired.
										// Display options to Repair it!
										//echo  "=-> Bounce Date > Repair Date <i>(Add ability to repair)</i> <br>";
										$status = 1;
									}
									else {
										// The Bounce Date is either the same as or less than he repair date
										// Check to see if the dates are the same
										if($discrepancybounceddate == $discrepancyrepairdate) {
												// The dates are the same, so now the time is important
												//echo  "=-> Bounce Date = Repair Date <br>";
												if($discrepancybouncedtime > $discrepancyrepairtime) {
														// The time this discrepancy was bounced is greater than the repair time
														// This means the bounce is active and the discrepancy should be repaired.
														//echo  "=-> Bounce Time > Repair Time <i>(Add ability to repair)</i> <br>";
														$status = 1;
													}
													else {
														if ($discrepancybouncedtime == $discrepancyrepairtime) {
																// Are the two the same?
																//  I have no idea how this could even happen
																//echo  "=-> Bounce Time = Repair Time <i>(Violation of Quantum Mechanics)</i> <br>";
																// Do nothing but be confused
															}
															else {
																// If the times are not the same, and Bounce time is not greater than repair time..
																// This discrepancy is currently repaired.  Display Bounce ability
																//echo  "=-> Bounce Time < Repair Time <i>(Add ability to bounce)</i> <br>";
																$status = 2;
															}
													}
											}
											else {
												// Bounce Date must be less than repair date
												// Display ability to bounce
												//echo  "=-> Bounce Date < Repair Date <i>(Add ability to bounce)</i> <br>";
												$status = 2;
											}
									}
							}
					
					} else {
						
						// There is at least one closed discrepancy record for this discrepancy
						// Report a closed status...
						$status = 3;
					}
			}
		
		return $status;
		}	// END OF FUNCTION
	?>