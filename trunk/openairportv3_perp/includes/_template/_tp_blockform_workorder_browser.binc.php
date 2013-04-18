<?php
// Setup Window to build things into


//	 DISCREPANCY WORKORDER BLOCK FORM CONTROLS
//		Utilize $stage information to display control buttons


// Short code to make the temlate browse file shorter and more manageble.
if($functionworkorderpage == '') {
			// Display Nothing No Bounced, No Repair, No WorkOrder Information
			
			// No Workorder page defined, but do we still want to display some options anyway?
			//		Like Mark Closed and Closed History?
			//		is there a defined value in the closed function page?
/* 			if($functionclosedpage == '') {
					
					// No there is not, so dont display this control
				} else {
					
					// There is something here, display the Closed Options
					
					_tp_control_closed($tblkeyvalue, $array_closedcontrol, $functionclosedpage);															
					
				} */
		}
		else {
			// To do this efficiently, run the discrepancy stage function and get the current status of the active discrepancy
			// 0 - Work Order, can be repaired, 1 - Repaired, can be bounced, 2 - Bounced, can be repaired.
			if (!isset($imclearlyahijacker)) {
					// Not set
				} else {
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
		//open_new_littleform_window
$icons_width = '25';
$icons_height = '25';

if (!isset($form_name)) {
		// Not set
		$form_name = '';
	} else {
		$form_name = $form_name;
	}

$button_name 	= 'WorkOrder';
$random_element = rand(0,10000);
$window_name	= preg_replace('/\s+/', '', $button_name);
$window_name	= $window_name."_".$form_name."_".$random_element;
$button_name	= $button_name."_".$random_element."";
$window_command	= 'open_new_report_window';
	?>
<form style="margin-bottom:0;" action="<?php echo $functionworkorderpage;?>" method="POST" name="Workorderreportform" id="Workorderreportform" target="WorkOrderForm" onSubmit="javascript:<?php echo $window_command;?>('','WorkOrderForm');" />
	<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
	<table 	name="MenuItem_<?php echo $window_name;?>" id="MenuItem_<?php echo $window_name;?>" 
		border="0" 
		cellpadding="0" 
		cellspacing="0" 
		class="perp_menutable" />
		<tr>			
			<td name="OSpace_<?php echo $window_name;?>" id="OSpace_<?php echo $window_name;?>" 
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $window_name;?>.className='item_name_active';Icon_<?php echo $window_name;?>.className='item_name_active';ISpace_<?php echo $window_name;?>.className='item_name_active';Name_<?php echo $window_name;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $window_name;?>.className='item_name_inactive';Icon_<?php echo $window_name;?>.className='item_name_inactive';ISpace_<?php echo $window_name;?>.className='item_name_inactive';Name_<?php echo $window_name;?>.className='item_name_inactive';" 
				/>&nbsp;
				</td>
			<td name="Icon_<?php echo $window_name;?>" id="Icon_<?php echo $window_name;?>" 
				class="item_icon_inactive" 
				onmouseover="OSpace_<?php echo $window_name;?>.className='item_name_active';Icon_<?php echo $window_name;?>.className='item_name_active';ISpace_<?php echo $window_name;?>.className='item_name_active';Name_<?php echo $window_name;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $window_name;?>.className='item_name_inactive';Icon_<?php echo $window_name;?>.className='item_name_inactive';ISpace_<?php echo $window_name;?>.className='item_name_inactive';Name_<?php echo $window_name;?>.className='item_name_inactive';" 
				/>
				<img src="images/_interface/icons/icon_paintroller.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
				</td>
			<td name="ISpace_<?php echo $window_name;?>" id="ISpace_<?php echo $window_name;?>" 
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $window_name;?>.className='item_name_active';Icon_<?php echo $window_name;?>.className='item_name_active';ISpace_<?php echo $window_name;?>.className='item_name_active';Name_<?php echo $window_name;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $window_name;?>.className='item_name_inactive';Icon_<?php echo $window_name;?>.className='item_name_inactive';ISpace_<?php echo $window_name;?>.className='item_name_inactive';Name_<?php echo $window_name;?>.className='item_name_inactive';" 
				/>
				&nbsp;
				</td>				
			<td name="Name_<?php echo $window_name;?>" id="Name_<?php echo $window_name;?>" 
				class="item_space_inactive" 
				onmouseover="OSpace_<?php echo $window_name;?>.className='item_name_active';Icon_<?php echo $window_name;?>.className='item_name_active';ISpace_<?php echo $window_name;?>.className='item_name_active';Name_<?php echo $window_name;?>.className='item_name_active';" 
				onmouseout="OSpace_<?php echo $window_name;?>.className='item_name_inactive';Icon_<?php echo $window_name;?>.className='item_name_inactive';ISpace_<?php echo $window_name;?>.className='item_name_inactive';Name_<?php echo $window_name;?>.className='item_name_inactive';" 
				 />
				<input class="makebuttonlooklikelargetext" type="submit" name="submitform" value="Work Order" />
				</td>				
			</tr>
			</table>
		</form>	

<?php

if (!isset($status)) {
		// Not set
		$status = '';
	} else {
		$status = $status;
	}


		if($status == 0 || $status == 1) {
			
				$active = 1;
				$value	= 'Repair It';
				$vshort	= 'RI';
				$message = 'Click to open a repair window';	
				
			} else {
				
				$active = 0;
				$value	= 'Repair It';
				$vshort	= 'OFF';
				$message = 'Reapir not Needed';
			}
			
			$form_action	= $functionrepairpage;
			$image_name		= 'icons_tools';
			$button_name 	= 'RepairOrder';
			$form_name		= 'RepairOrderReportForm';
			$random_element = rand(0,10000);
			$window_name	= preg_replace('/\s+/', '', $button_name);
			$window_name	= $window_name."_".$form_name."_".$random_element;
			$button_name	= $button_name."_".$random_element."";
			$window_command	= 'open_new_littleform_window';
			
			include('includes/_template/_tp_blockform_work_button.binc.php');

			$form_action	= '';
			$image_name		= '';
			$button_name 	= '';
			$form_name		= '';
			$random_element = '';
			$window_name	= '';
			$window_name	= '';
			$button_name	= '';
			$window_command = '';			
			
			if($status == 1 || $status == 2 || $status == 3) {
					
					if($has_been_repaired == 1) {
				
							$active 		= 1;
							$value			= 'Repair History';
							$vshort			= 'RH';
							$message 		= 'Click to open a repair history window';

						} else {
					
							$active 		= 0;
							$value			= 'Repair History';
							$vshort			= 'OFF';
							$message 		= 'No Repair History to view';
						}
						
					$form_action	= $array_repairedcontrol[2];
					$button_name 	= 'RepairHistory';	
					$image_name		= 'icon_repairhistory';
					$form_name		= 'RepairHistoryreportform';
					$random_element = rand(0,10000);
					$window_name	= preg_replace('/\s+/', '', $button_name);
					$window_name	= $window_name."_".$form_name."_".$random_element;
					$button_name	= $button_name."_".$random_element."";
					$window_command	= 'open_new_report_window';
							
					include('includes/_template/_tp_blockform_work_button.binc.php');
					
					$form_action	= '';
					$image_name		= '';
					$button_name 	= '';
					$form_name		= '';
					$random_element = '';
					$window_name	= '';
					$window_name	= '';
					$button_name	= '';
				}

			if($status == 2 || $status == 3) {
				
					$active = 1;
					$value	= 'Bounce It';
					$vshort	= 'MB';
					$message = 'Click to bounce the report';
					
				} else {
					
					$active = 0;
					$value	= 'Bounce It';
					$vshort	= 'OFF';
					$message = 'Bounce It not avilable';
				}
	
			$form_action	= $functionbouncepage;
			$image_name		= 'icon_bounceit';
			$button_name 	= 'BounceOrder';	
			$form_name		= 'BounceOrderReportForm';
			$random_element = rand(0,10000);
			$window_name	= preg_replace('/\s+/', '', $button_name);
			$window_name	= $window_name."_".$form_name."_".$random_element;
			$button_name	= $button_name."_".$random_element."";
			$window_command	= 'open_new_littleform_window';

			include('includes/_template/_tp_blockform_work_button.binc.php');	

			$form_action	= '';
			$image_name		= '';
			$button_name 	= '';
			$form_name		= '';
			$random_element = '';
			$window_name	= '';
			$window_name	= '';
			$button_name	= '';
			
			if($status == 2 || $status == 3) {
					
					if($has_been_bounced == 1) {
				
							$active = 1;
							$value	= 'Bounce History';
							$vshort	= 'BH';
							$message = 'Click to view bounce history';				
					
						} else {

							$active = 0;
							$value	= 'Bounce History';
							$vshort	= 'OFF';
							$message = 'Bounce History not avilable';				
							
						}
						
				$form_action	= $array_bouncedcontrol[2];
				$image_name		= 'icon_bouncehistory';
				$button_name 	= 'BounceHistory';	
				$form_name		= 'BounceHistoryReportForm';
				$random_element = rand(0,10000);
				$window_name	= preg_replace('/\s+/', '', $button_name);
				$window_name	= $window_name."_".$form_name."_".$random_element;
				$button_name	= $button_name."_".$random_element."";	
				$window_command	= 'open_new_report_window';				
						
				include('includes/_template/_tp_blockform_work_button.binc.php');	
				
				$form_action	= '';
				$image_name		= '';
				$button_name 	= '';
				$form_name		= '';
				$random_element = '';
				$window_name	= '';
				$window_name	= '';
				$button_name	= '';
				}

			if($status == 2) {

					$active = 1;
					$value	= 'Close It';
					$vshort	= 'MC';
					$message = 'Click to close record';			
					
				} else {
					
					$active = 0;
					$value	= 'Close It';
					$vshort	= 'OFF';
					$message = 'Close it Not Avilable';		
				}
	
			$form_action	= $functionclosedpage;
			$image_name		= 'icon_safe';
			$button_name 	= 'CloseOrder';	
			$form_name		= 'CloseOrderReportForm';
			$random_element = rand(0,10000);
			$window_name	= preg_replace('/\s+/', '', $button_name);
			$window_name	= $window_name."_".$form_name."_".$random_element;
			$button_name	= $button_name."_".$random_element."";
			$window_command	= 'open_new_littleform_window';
			
			include('includes/_template/_tp_blockform_work_button.binc.php');	

			$form_action	= '';
			$image_name		= '';
			$button_name 	= '';
			$form_name		= '';
			$random_element = '';
			$window_name	= '';
			$window_name	= '';
			$button_name	= '';
			
			if($status == 3) {	
					
					if($has_been_closed == 1) {
				
							$active = 1;
							$value	= 'Close History';
							$vshort	= 'CH';
							$message = 'Click to view close history';					
					
						} else {

							$active = 0;
							$value	= 'Close History';
							$vshort	= 'OFF';
							$message = 'Close History Not Avilable';					
						}
				
					$form_action	= $array_closedcontrol[2];
					$image_name		= 'closehistory';
					$button_name 	= 'CloseHistory';	
					$form_name		= 'CloseHistoryReportForm';
					$random_element = rand(0,10000);
					$window_name	= preg_replace('/\s+/', '', $button_name);
					$window_name	= $window_name."_".$form_name."_".$random_element;
					$button_name	= $button_name."_".$random_element."";
					$window_command	= 'open_new_report_window';
					
					include('includes/_template/_tp_blockform_work_button.binc.php');
					
					$form_action	= '';
					$image_name		= '';
					$button_name 	= '';
					$form_name		= '';
					$random_element = '';
					$window_name	= '';
					$window_name	= '';
					$button_name	= '';
				}
		}
?>