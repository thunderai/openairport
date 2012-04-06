<?php
// Short code to make the temlate browse file shorter and more manageble.
if($functionworkorderpage == '') {
			// Display Nothing No Bounced, No Repair, No WorkOrder Information
		}
		else {
			// To do this efficiently, run the discrepancy stage function and get the current status of the active discrepancy
			// 0 - Work Order, can be repaired, 1 - Repaired, can be bounced, 2 - Bounced, can be repaired.
			if($imclearlyahijacker == 1) {
					// For other pages than the template browse hijacking into the blockform
					//$disid 			= $disid;												<- The pimary Page would know this already
					//$status 			= part139327discrepancy_getstage($disid, 0, 0, 0, 1);	<- The primary page should have run this already
				}
				else {
					$disid 				= $objarray[$tblkeyfield];
					$array_workorder 	= array($array_bouncedcontrol,$array_repairedcontrol);
					$status 			= part139327discrepancy_getstage($disid, 0, 0, $array_workorder,2);
				}
			//  Now parse the stage information and display the proper stuff.
			
	// OUTPUT	
		// Status:
		//				0 - NO HISTORY, Requires a Work Order (ie. needs to be repaired)
		//				1 - Needs to be Repaired (is currently bounced)
		//				2 - Needs to be Bounced (is currently repaired)					
			?>
			<font size="1">
			<?php
			if($status == 0) {
					// Work Order Stage
					// Display WorkOrder Button 
					?>
	<form style="margin-bottom:0;" action="<?php echo $functionworkorderpage;?>" method="POST" name="Workorderreportform" id="Workorderreportform" target="ViewWorkOrder" onsubmit="openmapchild('<?php echo $functionworkorderpage;?>','ViewWorkOrder');" >
	<td >
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="WO" NAME="b1" ID="b1" class="buttons_quickaccess" onMouseover="ddrivetip('Workorder');"  onMouseout="hideddrivetip()">
		</td>
		</form>
					<?php
					// Display 'Mark Repaired' Button
					?>
	<form style="margin-bottom:0;" action="<?php echo $functionrepairpage;?>" method="POST" name="MarkRepairedreportform" id="MarkRepairedreportform" target="<?php echo $functionrepairpage;?>MarkasRepair" onsubmit="openchild600('<?php echo $functionrepairpage;?>','<?php echo $functionrepairpage;?>MarkasRepair');" >
	<td onMouseover="ddrivetip('File Repair Report');"  onMouseout="hideddrivetip()">
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="MR" NAME="b1" ID="b1" class="buttons_quickaccess" alt="Repair It" onMouseover="ddrivetip('File Repair Report');"  onMouseout="hideddrivetip()">
		</td>
		</form>	
					<?php
				}
			if($status == 2) {
					// Repaired Stage
					// Display WorkOrder Button 
					?>
	<form style="margin-bottom:0;" action="<?php echo $functionworkorderpage;?>" method="POST" name="reportform" id="reportform" target="ViewWorkOrder" onsubmit="openmapchild('','ViewWorkOrder');" >
	<td>
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="WO" NAME="b1" ID="b1" class="buttons_quickaccess" onMouseover="ddrivetip('Workorder');"  onMouseout="hideddrivetip()">
		</td>
		</form>															
					<?php
					// Display 'Repair History' Button
					?>
	<form style="margin-bottom:0;" action="<?php echo $array_repairedcontrol[2];?>" method="POST" name="reportform" id="reportform" target="<?php echo $array_repairedcontrol[2];?>ViewRepairHistory" onsubmit="openchild600('<?php echo $array_repairedcontrol[2];?>','<?php echo $array_repairedcontrol[2];?>ViewRepairHistory');" >
	<td>
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="RH" NAME="r1" ID="r1" class="buttons_quickaccess" alt="Repair" onMouseover="ddrivetip('Repair Report');"  onMouseout="hideddrivetip()">
		</td>
		</form>															
					<?php
					// Display 'Bounced History' Button
					?>
	<form style="margin-bottom:0;" action="<?php echo $array_bouncedcontrol[2];?>" method="POST" name="reportform" id="reportform" target="<?php echo $array_bouncedcontrol[2];?>ViewRepairHistory" onsubmit="openchild600('<?php echo $array_bouncedcontrol[2];?>','<?php echo $array_bouncedcontrol[2];?>ViewRepairHistory');" >
	<td>
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="BH" NAME="b1" ID="b1" class="buttons_quickaccess" alt="Bounced" onMouseover="ddrivetip('Bounced Report');"  onMouseout="hideddrivetip()">
		</td>
		</form>		
					<?php											
					// Display 'Mark Bounced' Button
					?>
	<form style="margin-bottom:0;" action="<?php echo $functionbouncepage;?>" method="POST" name="reportform" id="reportform" target="<?php echo $functionbouncepage;?>MarkasBounce" onsubmit="openchild600('<?php echo $functionbouncepage;?>','<?php echo $functionbouncepage;?>MarkasBounce');" >
	<td onMouseover="ddrivetip('File Bounce Report');"  onMouseout="hideddrivetip()">
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="MB" NAME="b1" ID="b1" class="buttons_quickaccess" alt="Bounce It" onMouseover="ddrivetip('File Bounce Report');"  onMouseout="hideddrivetip()">
		</td>
		</form>		
					<?php
					// Display 'Closed History' Button
					?>
	<form style="margin-bottom:0;" action="<?php echo $array_closedcontrol[2];?>" method="POST" name="reportform" id="reportform" target="<?php echo $array_closedcontrol[2];?>ViewclosedHistory" onsubmit="openchild600('<?php echo $array_closedcontrol[2];?>','<?php echo $array_closedcontrol[2];?>ViewclosedHistory');" >
	<td>
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="CH" NAME="b1" ID="b1" class="buttons_quickaccess" alt="Bounced" onMouseover="ddrivetip('closed Report');"  onMouseout="hideddrivetip()">
		</td>
		</form>		
					<?php											
					// Display 'Mark Closed' Button
					?>
	<form style="margin-bottom:0;" action="<?php echo $functionclosedpage;?>" method="POST" name="reportform" id="reportform" target="<?php echo $functionclosedpage;?>Markasclosed" onsubmit="openchild600('<?php echo $functionclosedpage;?>','<?php echo $functionclosedpage;?>Markasclosed');" >
	<td onMouseover="ddrivetip('File closed Report');"  onMouseout="hideddrivetip()">
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="MC" NAME="b1" ID="b1" class="buttons_quickaccess" alt="Bounce It" onMouseover="ddrivetip('File closed Report');"  onMouseout="hideddrivetip()">
		</td>
		</form>	


		
					<?php
				}
			if($status == 1) {
					// Bounced Stage
					// Display WorkOrder Button
					?>
	<form style="margin-bottom:0;" action="<?php echo $functionworkorderpage;?>" method="POST" name="reportform" id="reportform" target="ViewWorkOrder" onsubmit="openmapchild('','ViewWorkOrder');" >
	<td>
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="WO" NAME="b1" ID="b1" class="buttons_quickaccess" onMouseover="ddrivetip('Workorder');"  onMouseout="hideddrivetip()">
		</td>
		</form>															
					<?php
					// Display 'Repair History' Button
					?>
	<form style="margin-bottom:0;" action="<?php echo $array_repairedcontrol[2];?>" method="POST" name="reportform" id="reportform" target="<?php echo $array_repairedcontrol[2];?>PrinterFriendlyWindow" onsubmit="openchild600('<?php echo $array_repairedcontrol[2];?>','<?php echo $array_repairedcontrol[2];?>ViewRepairHistory');" >
	<td>
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="RH" NAME="r1" ID="r1" class="buttons_quickaccess" alt="Repair" onMouseover="ddrivetip('Repair Report');"  onMouseout="hideddrivetip()">
		</td>
		</form>															
					<?php
					// Display 'Bounced History' Button
					?>
	<form style="margin-bottom:0;" action="<?php echo $array_bouncedcontrol[2];?>" method="POST" name="reportform" id="reportform" target="<?php echo $array_bouncedcontrol[2];?>ViewBouncedHistory" onsubmit="openchild600('<?php echo $array_bouncedcontrol[2];?>','<?php echo $array_bouncedcontrol[2];?>ViewRepairHistory');" >
	<td>
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="BH" NAME="b1" ID="b1" class="buttons_quickaccess" alt="Bounced" onMouseover="ddrivetip('Bounced Report');"  onMouseout="hideddrivetip()">
		</td>
		</form>		
					<?php
					// Display 'Mark Repaired' Button
					?>
	<form style="margin-bottom:0;" action="<?php echo $functionrepairpage;?>" method="POST" name="reportform" id="reportform" target="<?php echo $functionrepairpage;?>MarkasRepair" onsubmit="openchild600('<?php echo $functionrepairpage;?>','<?php echo $functionrepairpage;?>MarkasRepair');" >
	<td onMouseover="ddrivetip('File Repair Report');"  onMouseout="hideddrivetip()">
		<input type="hidden" NAME="recordid" ID="recordid" 			value="<?php echo $disid;?>">
		<input type="submit" value="MR" NAME="b1" ID="b1" class="buttons_quickaccess" alt="Repair It" onMouseover="ddrivetip('File Repair Report');"  onMouseout="hideddrivetip()">
		</td>
		</form>	
					<?php
				}
		}