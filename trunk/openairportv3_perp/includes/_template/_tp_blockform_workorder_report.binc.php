<?php
//	 DISCREPANCY WORKORDER BLOCK FORM CONTROLS
//		Utilize $stage information to display control buttons


// Short code to make the temlate browse file shorter and more manageble.
if($functionworkorderpage == '') {
			// Display Nothing No Bounced, No Repair, No WorkOrder Information
			
			// No Workorder page defined, but do we still want to display some options anyway?
			//		Like Mark Closed and Closed History?
			//		is there a defined value in the closed function page?
			if($functionclosedpage == '') {
					
					// No there is not, so dont display this control
				} else {
					
					// There is something here, display the Closed Options
					
					_tp_control_closed($tblkeyvalue, $array_closedcontrol, $functionclosedpage);															
					
				}
		}
		else {
			// To do this efficiently, run the discrepancy stage function and get the current status of the active discrepancy
			// 0 - Work Order, can be repaired, 1 - Repaired, can be bounced, 2 - Bounced, can be repaired.
			if($imclearlyahijacker == 1) {
					// For other pages than the template browse hijacking into the blockform
					//$disid 			= $disid;												<- The pimary Page would know this already
					//$status 			= part139327discrepancy_getstage($disid, 0, 0, 0, 1);	<- The primary page should have run this already
					if($grid_or_row == '') {
							$grid_or_row = 'row';
						} else {
							$grid_or_row = 'grid';
						}
				}
				else {
					$disid 				= $objarray[$tblkeyfield];
					$array_workorder 	= array($array_bouncedcontrol,$array_repairedcontrol);
					$status 			= part139327discrepancy_getstage($disid, 0, 0, $array_workorder,0);
				
					//$has_been_archieved = preflights_tbl_139_327_main_sub_d_a_yn($disid,0);
					$has_been_bounced 	= preflights_tbl_139_327_main_sub_d_b_yn($disid,1);
					$has_been_closed 	= preflights_tbl_139_327_main_sub_d_c_yn($disid,1);
					//$has_been_duplicate = preflights_tbl_139_327_main_sub_d_d_yn($disid,0);
					$has_been_repaired 	= preflights_tbl_139_327_main_sub_d_r_yn($disid,1);
				
					//echo "Been Bounced 	: ".$has_been_bounced." 	<br>";
					//echo "Been Closed 	: ".$has_been_closed." 		<br>";
					//echo "Been Repaired 	: ".$has_been_repaired." 	<br>";
					
					$grid_or_row		= 'grid';
				
				}
				
			//echo "Status is :".$status;
			
			//  Now parse the stage information and display the proper stuff.
			
	// OUTPUT	
		// Status:
		//				0 - NO HISTORY, Requires a Work Order (ie. needs to be repaired)
		//					} Mark Repaired Button
		//					} View Workorder button
		//				1 - Needs to be Repaired (is currently bounced)
		//					} Mark Repaired Button
		//					} Repair History Button
		//					} Bounced History Button
		//					} View Workorder button
		//				2 - Needs to be Bounced (is currently repaired)	
		//					} Repair History Buton
		//					} Mark Closed
		//					} View Workorder button
		//				3 - is Closed, no furthure abilities
		//					} Closed History Button

				?>
	WO
				<?php
				// Count char in the ID and add to total chars for this record
				$charcount_tmp 	= 2;
				$charcount		= ($charcount + $charcount_tmp);	
				
				if($status == 0 || $status == 1) {
						?>
	MR	
						<?php
						// Count char in the ID and add to total chars for this record
						$charcount_tmp 	= 2;
						$charcount		= ($charcount + $charcount_tmp);						
					} else {
						?>
	--
						<?php
						// Count char in the ID and add to total chars for this record
						$charcount_tmp 	= 2;
						$charcount		= ($charcount + $charcount_tmp);						
					}

				if($status == 1 || $status == 2 || $status == 3) {
						if($has_been_repaired == 1) {
								// Discrepancy has been repaired, display the history button
								?>
	RH						
								<?php
								// Count char in the ID and add to total chars for this record
								$charcount_tmp 	= 2;
								$charcount		= ($charcount + $charcount_tmp);									
							} else {
								?>
	--
								<?php
								// Count char in the ID and add to total chars for this record
								$charcount_tmp 	= 2;
								$charcount		= ($charcount + $charcount_tmp);							
							}
					} else {
						?>
	--
						<?php
						// Count char in the ID and add to total chars for this record
						$charcount_tmp 	= 2;
						$charcount		= ($charcount + $charcount_tmp);						
					}
				
				if($status == 2 || $status == 3) {
						?>
	MB						
						<?php
						// Count char in the ID and add to total chars for this record
						$charcount_tmp 	= 2;
						$charcount		= ($charcount + $charcount_tmp);						
					} else {
						?>
	--
						<?php
						// Count char in the ID and add to total chars for this record
						$charcount_tmp 	= 2;
						$charcount		= ($charcount + $charcount_tmp);						
					}
				
				if($status == 2 || $status == 3) {
						if($has_been_bounced == 1) {
								// Discrepancy has been bounced, display the history button
								?>
	BH						
								<?php
								// Count char in the ID and add to total chars for this record
								$charcount_tmp 	= 2;
								$charcount		= ($charcount + $charcount_tmp);								
							} else {
								?>
	--
								<?php
								// Count char in the ID and add to total chars for this record
								$charcount_tmp 	= 2;
								$charcount		= ($charcount + $charcount_tmp);								
							}
					} else {
						?>
	--
						<?php
						// Count char in the ID and add to total chars for this record
						$charcount_tmp 	= 2;
						$charcount		= ($charcount + $charcount_tmp);						
					}
				if($status == 2) {	
						?>
	MC	
						<?php
						// Count char in the ID and add to total chars for this record
						$charcount_tmp 	= 2;
						$charcount		= ($charcount + $charcount_tmp);					
					} else {
						?>
	--
						<?php
						// Count char in the ID and add to total chars for this record
						$charcount_tmp 	= 2;
						$charcount		= ($charcount + $charcount_tmp);						
					}
				
				if($status == 3) {	
						if($has_been_closed == 1) {
								// Discrepancy has been closed, display the history button
								?>
	CH	
								<?php
								// Count char in the ID and add to total chars for this record
								$charcount_tmp 	= 2;
								$charcount		= ($charcount + $charcount_tmp);								
							} else {
								?>
	--
								<?php
								// Count char in the ID and add to total chars for this record
								$charcount_tmp 	= 2;
								$charcount		= ($charcount + $charcount_tmp);								
							}
					} else {
						?>
	--
						<?php
						// Count char in the ID and add to total chars for this record
						$charcount_tmp 	= 2;
						$charcount		= ($charcount + $charcount_tmp);						
					}
		}
		?>