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
	
<form style="margin-bottom:0;" action="<?php echo $functionworkorderpage;?>" method="POST" name="Workorderreportform" id="Workorderreportform" target="ViewWorkOrder" onsubmit="openmapchild('<?php echo $functionworkorderpage;?>','ViewWorkOrder');" >
	<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button"  />
			<tr>
				<td class="table_button_bullet_right_dark1_normal" onclick="javascript:document.forms['Workorderreportform'].submit();" />
					&nbsp;
					</td>
				<td class="table_button_bullet_lead_dark1_normal" onclick="javascript:document.forms['Workorderreportform'].submit();" />
					<input type="submit" value="Work Order" width="10" class="table_button_bullet_lead_dark1_normal">
					</td>
				<td class="table_button_bullet_gap_dark1_normal" onMouseover="ddrivetip('Open Work-Order');"  onMouseout="hideddrivetip();"/>
					<span class="table_button_bullet_input_dark1_normal"> WO </span>
					</td>
				<td class="table_button_bullet_tail_dark1_normal" onMouseover="ddrivetip('Open Work-Order');"  onMouseout="hideddrivetip();"/>
					&nbsp;
					</td>
				</tr>
			</table>
		</form>	

<?php
if($status == 0 || $status == 1) {
	
		$skin 	= 'dark1_normal';
		$iskin	= 'dark1_normal';
		$active = 1;
		$value	= 'Repair It';
		$vshort	= 'RI';
		$message = 'Click to open a repair window';
		
	} else {
		
		$skin 	= 'inactive_normal';
		$iskin	= 'inactive_normal';
		$active = 0;
		$value	= 'Repair It';
		$vshort	= 'OFF';
		$message = 'Reapir not Needed';
	}
		?>
	<form style="margin-bottom:0;" action="<?php echo $functionrepairpage;?>" method="POST" name="MarkRepairedreportform" id="MarkRepairedreportform" target="<?php echo $functionrepairpage;?>MarkasRepair" onsubmit="openchild600('<?php echo $functionrepairpage;?>','<?php echo $functionrepairpage;?>MarkasRepair');" >
		<input type="hidden" NAME="recordid" ID="recordid" value="<?php echo $disid;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button"  />
			<tr>
				<td class="table_button_bullet_right_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['MarkRepairedreportform'].submit();"
							<?php
						}
						?>
					 /> &nbsp;
					</td>
				<td class="table_button_bullet_lead_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['MarkRepairedreportform'].submit();" />
					<input type="submit" value="<?php echo $value;?>" width="10" class="table_button_bullet_lead_<?php echo $skin;?>">
					
							<?php
						} else {
							?>
					<span class="table_button_bullet_lead_<?php echo $skin;?>"> <?php echo $value;?> </span>
							<?php
						}
						?>
					</td>
				<td class="table_button_bullet_gap_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					<span class="table_button_bullet_input_<?php echo $iskin;?>"> <?php echo $vshort;?> </span>
					</td>
				<td class="table_button_bullet_tail_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					&nbsp;
					</td>
				</tr>
			</table>
		</form>
<?php
if($status == 1 || $status == 2 || $status == 3) {
		
		if($has_been_repaired == 1) {
	
				$skin 	= 'dark1_normal';
				$iskin	= 'dark1_normal';
				$active = 1;
				$value	= 'Repair History';
				$vshort	= 'RH';
				$message = 'Click to open a repair history window';
		
			} else {
		
				$skin 	= 'inactive_normal';
				$iskin	= 'inactive_normal';
				$active = 0;
				$value	= 'Repair History';
				$vshort	= 'OFF';
				$message = 'No Repair History to view';
			}
	}
?>	
<form style="margin-bottom:0;" action="<?php echo $array_repairedcontrol[2];?>" method="POST" name="RepairHistoryreportform" id="RepairHistoryreportform" target="<?php echo $array_repairedcontrol[2];?>ViewRepairHistory" onsubmit="openchild600('<?php echo $array_repairedcontrol[2];?>','<?php echo $array_repairedcontrol[2];?>ViewRepairHistory');" >
	<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button"  />
			<tr>
				<td class="table_button_bullet_right_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['RepairHistoryreportform'].submit();" 
							<?php
						}
						?>
					 /> &nbsp;
					</td>
				<td class="table_button_bullet_lead_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['RepairHistoryreportform'].submit();" />
					<input type="submit" value="<?php echo $value;?>" width="10" class="table_button_bullet_lead_<?php echo $skin;?>">
					
							<?php
						} else {
							?>
					<span class="table_button_bullet_lead_<?php echo $skin;?>"> <?php echo $value;?> </span>
							<?php
						}
						?>
					</td>
				<td class="table_button_bullet_gap_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					<span class="table_button_bullet_input_<?php echo $iskin;?>"> <?php echo $vshort;?> </span>
					</td>
				<td class="table_button_bullet_tail_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					&nbsp;
					</td>
				</tr>
			</table>
		</form>	
<?php
if($status == 2 || $status == 3) {
	
		$skin 	= 'dark1_normal';
		$iskin	= 'dark1_normal';
		$active = 1;
				$value	= 'Bounce It';
				$vshort	= 'MB';
				$message = 'Click to bounce the report';
		
	} else {
		
		$skin 	= 'inactive_normal';
		$iskin	= 'inactive_normal';
		$active = 0;
				$value	= 'Bounce It';
				$vshort	= 'OFF';
				$message = 'Bounce It not avilable';
	}
?>
<form style="margin-bottom:0;" action="<?php echo $functionbouncepage;?>" method="POST" name="BounceItreportform" id="BounceItreportform" target="<?php echo $functionbouncepage;?>MarkasBounce" onsubmit="openchild600('<?php echo $functionbouncepage;?>','<?php echo $functionbouncepage;?>MarkasBounce');" >
	<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button"  />
			<tr>
				<td class="table_button_bullet_right_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['BounceItreportform'].submit();"
							<?php
						}
						?>
					 /> &nbsp;
					</td>
				<td class="table_button_bullet_lead_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['BounceItreportform'].submit();" />
					<input type="submit" value="<?php echo $value;?>" width="10" class="table_button_bullet_lead_<?php echo $skin;?>">
					
							<?php
						} else {
							?>
					<span class="table_button_bullet_lead_<?php echo $skin;?>"> <?php echo $value;?> </span>
							<?php
						}
						?>
					</td>
				<td class="table_button_bullet_gap_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					<span class="table_button_bullet_input_<?php echo $iskin;?>"> <?php echo $vshort;?> </span>
					</td>
				<td class="table_button_bullet_tail_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					&nbsp;
					</td>
				</tr>
			</table>
		</form>	
<?php
if($status == 2 || $status == 3) {
		
		if($has_been_bounced == 1) {
	
				$skin 	= 'dark1_normal';
				$iskin	= 'dark1_normal';
				$active = 1;
				$value	= 'Bounce History';
				$vshort	= 'BH';
				$message = 'Click to view bounce history';				
		
			} else {
		
				$skin 	= 'inactive_normal';
				$iskin	= 'inactive_normal';
				$active = 0;
				$value	= 'Bounce History';
				$vshort	= 'OFF';
				$message = 'Bounce History not avilable';				
				
			}
	}
?>	
<form style="margin-bottom:0;" action="<?php echo $array_bouncedcontrol[2];?>" method="POST" name="BounceHistoryreportform" id="BounceHistoryreportform" target="<?php echo $array_bouncedcontrol[2];?>ViewRepairHistory" onsubmit="openchild600('<?php echo $array_bouncedcontrol[2];?>','<?php echo $array_bouncedcontrol[2];?>ViewRepairHistory');" >
	<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button"  />
			<tr>
				<td class="table_button_bullet_right_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['BounceHistoryreportform'].submit();"
							<?php
						}
						?>
					 /> &nbsp;
					</td>
				<td class="table_button_bullet_lead_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['BounceHistoryreportform'].submit();" />
					<input type="submit" value="<?php echo $value;?>" width="10" class="table_button_bullet_lead_<?php echo $skin;?>">
					
							<?php
						} else {
							?>
					<span class="table_button_bullet_lead_<?php echo $skin;?>"> <?php echo $value;?> </span>
							<?php
						}
						?>
					</td>
				<td class="table_button_bullet_gap_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					<span class="table_button_bullet_input_<?php echo $iskin;?>"> <?php echo $vshort;?> </span>
					</td>
				<td class="table_button_bullet_tail_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					&nbsp;
					</td>
				</tr>
			</table>
		</form>		
<?php
if($status == 2) {
	
		$skin 	= 'dark1_normal';
		$iskin	= 'dark1_normal';
		$active = 1;
				$value	= 'Close It';
				$vshort	= 'MC';
				$message = 'Click to close record';			
		
	} else {
		
		$skin 	= 'inactive_normal';
		$iskin	= 'inactive_normal';
		$active = 0;
				$value	= 'Close It';
				$vshort	= 'OFF';
				$message = 'Close it Not Avilable';		
	}
?>
<form style="margin-bottom:0;" action="<?php echo $functionclosedpage;?>" method="POST" name="CloseItreportform" id="CloseItreportform" target="<?php echo $functionclosedpage;?>Markasclosed" onsubmit="openchild600('<?php echo $functionclosedpage;?>','<?php echo $functionclosedpage;?>Markasclosed');" >
	<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button"  />
			<tr>
				<td class="table_button_bullet_right_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['CloseItreportform'].submit();"
							<?php
						}
						?>
					 /> &nbsp;
					</td>
				<td class="table_button_bullet_lead_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['CloseItreportform'].submit();" />
					<input type="submit" value="<?php echo $value;?>" width="10" class="table_button_bullet_lead_<?php echo $skin;?>">
					
							<?php
						} else {
							?>
					<span class="table_button_bullet_lead_<?php echo $skin;?>"> <?php echo $value;?> </span>
							<?php
						}
						?>
					</td>
				<td class="table_button_bullet_gap_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					<span class="table_button_bullet_input_<?php echo $iskin;?>"> <?php echo $vshort;?> </span>
					</td>
				<td class="table_button_bullet_tail_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					&nbsp;
					</td>
				</tr>
			</table>
		</form>		
<?php
if($status == 3) {	
		
		if($has_been_closed == 1) {
	
				$skin 	= 'dark1_normal';
				$iskin	= 'dark1_normal';
				$active = 1;
				$value	= 'Close History';
				$vshort	= 'CH';
				$message = 'Click to view close history';					
		
			} else {
		
				$skin 	= 'inactive_normal';
				$iskin	= 'inactive_normal';
				$active = 0;
				$value	= 'Close History';
				$vshort	= 'OFF';
				$message = 'Close History Not Avilable';					
			}
			?>
<form style="margin-bottom:0;" action="<?php echo $array_closedcontrol[2];?>" method="POST" name="ClosedHistoryreportform" id="ClosedHistoryreportform" target="<?php echo $array_closedcontrol[2];?>ViewclosedHistory" onsubmit="openchild600('<?php echo $array_closedcontrol[2];?>','<?php echo $array_closedcontrol[2];?>ViewclosedHistory');" >
	<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button"  />
			<tr>
				<td class="table_button_bullet_right_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['ClosedHistoryreportform'].submit();"
							<?php
						}
						?>
					 /> &nbsp;
					</td>
				<td class="table_button_bullet_lead_<?php echo $skin;?>" 
					<?php 
					if($active == 1) {
							?>
					onclick="javascript:document.forms['ClosedHistoryreportform'].submit();" />
					<input type="submit" value="<?php echo $value;?>" width="10" class="table_button_bullet_lead_<?php echo $skin;?>">
					
							<?php
						} else {
							?>
					<span class="table_button_bullet_lead_<?php echo $skin;?>"> <?php echo $value;?> </span>
							<?php
						}
						?>
					</td>
				<td class="table_button_bullet_gap_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					<span class="table_button_bullet_input_<?php echo $iskin;?>"> <?php echo $vshort;?> </span>
					</td>
				<td class="table_button_bullet_tail_<?php echo $skin;?>" onMouseover="ddrivetip('<?php echo $message;?>');"  onMouseout="hideddrivetip();"/>
					&nbsp;
					</td>
				</tr>
			</table>
		</form>			
			<?php
	}
		}
?>