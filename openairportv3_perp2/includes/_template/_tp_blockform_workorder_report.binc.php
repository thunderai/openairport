<?php
//	 DISCREPANCY WORKORDER BLOCK FORM CONTROLS
//		Utilize $stage information to display control buttons
$has_been_repaired 	= '';
$has_been_bounced 	= '';

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
					//$has_been_archieved = preflights_tbl_139_327_main_sub_d_a_yn($disid,0);
					$has_been_bounced 	= preflights_tbl_139_327_main_sub_d_b_yn($disid,1);
					$has_been_closed 	= preflights_tbl_139_327_main_sub_d_c_yn($disid,1);
					//$has_been_duplicate = preflights_tbl_139_327_main_sub_d_d_yn($disid,0);
					$has_been_repaired 	= preflights_tbl_139_327_main_sub_d_r_yn($disid,1);
					
					
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

		$mrbutton = 0;
		$rhbutton = 0;
		$bhbutton = 0;		
		$mbbutton = 0;
		$mcbutton = 0;
		$chbutton = 0;		
				?>
				<form style="margin-bottom:0;float:left;" action="<?php echo $functionworkorderpage;?>" method="POST" name="Workorderreportform" id="Workorderreportform" target="ViewWorkOrder" onsubmit="openmapchild('<?php echo $functionworkorderpage;?>','ViewWorkOrder');" >
					<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
					<input type="submit" value="WO" NAME="b1" ID="b1" 			class="item_name_small_active" onMouseover="ddrivetip('Workorder');"  onMouseout="hideddrivetip()">
					</form>
				<?php
				// Count char in the ID and add to total chars for this record
				$charcount_tmp 	= 6;
				$charcount		= ($charcount + $charcount_tmp);	
				
				if($status == 0 ) {
						// Discrepancy has no history.
						// 		No other options are possible
						$mrbutton = 1;
					}
				if($status == 1 ) {
						// Discrepancy needs to be repaired
						$mrbutton = 1;
						$rhbutton = 1;
						//		It is possible this was bounced before
						//				Should Check that...						
						if($has_been_bounced == 1) {
								// Unit has been bounced.
								//	Show BH button
								$bhbutton = 1;
							}
					}
				if($status == 2 ) {
						// Discrepancy needs to be bounced or closed
						//		It is possible this was bounced before
						//				Should Check that...						
						if($has_been_bounced == 1) {
								// Unit has been bounced.
								//	Show BH button
								$bhbutton = 1;
							}	
						//		It is possible this was repaired before
						//				Should Check that...							
						if($has_been_repaired == 1) {
								// Unit has been bounced.
								//	Show BH button
								$rhbutton = 1;
							}
						$mbbutton = 1;
						$mcbutton = 1;
					}
				if($status == 3 ) {
						// Discrepancy is closed.
						//		It is possible this was bounced before
						//				Should Check that...						
						if($has_been_bounced == 1) {
								// Unit has been bounced.
								//	Show BH button
								$bhbutton = 1;
							}	
						//		It is possible this was repaired before
						//				Should Check that...							
						if($has_been_repaired == 1) {
								// Unit has been bounced.
								//	Show BH button
								$rhbutton = 1;
							}						
						$chbutton = 1;
				
					}
				
				if($mrbutton == 1) {
						$charcount_tmp 	= 6;
						$charcount		= ($charcount + $charcount_tmp);				
						?>
				<form style="margin-bottom:0;float:left;" action="<?php echo $functionrepairpage;?>" method="POST" name="reportform1" id="reportform1" target="MarkasRepair" onsubmit="openchild600('','MarkasRepair');" >
					<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
					<input type="submit" value="MR" NAME="b1" ID="b1" class="item_name_small_active" alt="Repair It" onMouseover="ddrivetip('File Repair Report');"  onMouseout="hideddrivetip()">
					</form>	
						<?php
					} else {
						?>

						<?php
					}
				
				if($rhbutton == 1) {
						$charcount_tmp 	= 6;
						$charcount		= ($charcount + $charcount_tmp);
						?>
				<form style="margin-bottom:0;float:left;" action="<?php echo $array_repairedcontrol[2];?>" method="POST" name="reportform2" id="reportform2" target="ViewRepairHistory" onsubmit="openchild600('','ViewRepairHistory');" >
					<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
					<input type="submit" value="RH" NAME="r1" ID="r1" class="item_name_small_active" alt="Repair" onMouseover="ddrivetip('Repair Report');"  onMouseout="hideddrivetip()">
					</form>	
						<?php
					} else {
						?>

						<?php
					}				
				
				if($mbbutton == 1) {
						$charcount_tmp 	= 6;
						$charcount		= ($charcount + $charcount_tmp);
						?>
				<form style="margin-bottom:0;float:left;" action="<?php echo $functionbouncepage;?>" method="POST" name="reportform3" id="reportform3" target="MarkasBounce" onsubmit="openchild600('','MarkasBounce');" >
				<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
					<input type="submit" value="MB" NAME="b1" ID="b1" class="item_name_small_active" alt="Bounce It" onMouseover="ddrivetip('File Bounce Report');"  onMouseout="hideddrivetip()">
					</form>	
						<?php
					} else {
						?>

						<?php
					}
					
				if($bhbutton == 1) {
						$charcount_tmp 	= 6;
						$charcount		= ($charcount + $charcount_tmp);
						?>
				<form style="margin-bottom:0;float:left;" action="<?php echo $array_bouncedcontrol[2];?>" method="POST" name="reportform4" id="reportform4" target="ViewRepairHistory" onsubmit="openchild600('','ViewRepairHistory');" >
					<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
					<input type="submit" value="BH" NAME="b1" ID="b1" class="item_name_small_active" alt="Bounced" onMouseover="ddrivetip('Bounced Report');"  onMouseout="hideddrivetip()">
					</form>	
						<?php
					} else {
						?>

						<?php
					}

				if($mcbutton == 1) {
						$charcount_tmp 	= 6;
						$charcount		= ($charcount + $charcount_tmp);
						?>
				<form style="margin-bottom:0;float:left;" action="<?php echo $functionclosedpage;?>" method="POST" name="reportform5" id="reportform5" target="Markasclosed" onsubmit="openchild600('','Markasclosed');" >
					<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
					<input type="submit" value="MC" NAME="b1" ID="b1" class="item_name_small_active" alt="Bounce It" onMouseover="ddrivetip('File closed Report');"  onMouseout="hideddrivetip()">
					</form>	
						<?php
					} else {
						?>

						<?php
					}				
					
				if($chbutton == 1) {
						$charcount_tmp 	= 6;
						$charcount		= ($charcount + $charcount_tmp);
						?>
				<form style="margin-bottom:0;float:left;" action="<?php echo $array_closedcontrol[2];?>" method="POST" name="reportform6" id="reportform6" target="ViewclosedHistory" onsubmit="openchild600('','ViewclosedHistory');" >
					<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
					<input type="submit" value="CH" NAME="b1" ID="b1" class="item_name_small_active" alt="Bounced" onMouseover="ddrivetip('closed Report');"  onMouseout="hideddrivetip()">
					</form>	
						<?php
					} else {
						?>
	<span style="float:left;">--</span>
						<?php
					}					
	
		}
		?>