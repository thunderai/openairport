<?php
//
// The purpose of this code is to display the Archived Code
function _tp_control_archived($tblkeyfield, $settingsarray, $functionpage) {

		if ($settingsarray == '') {
				// No information about this control, do not display it
			}
			else {
				// -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - 
				// ARCHIEVED CONTROLS ($settingsarray)
				// -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - 
				
				$sql2 = $settingsarray[0]."'".$tblkeyfield."' ";
				$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}
					else {
						$objrs2 = mysqli_query($objconn2, $sql2);

						if ($objrs2) {
								$number_of_rows = mysqli_num_rows($objrs2);
								if ($number_of_rows == 0) {
										// There are no records to display, display NRF
										?>
	<form style="margin-bottom:0;" action="<?php echo $functionpage;?>" method="POST" name="MAreportform" id="MAreportform" target="MarkasArchieved"  onsubmit="openchild600('<?php echo $functionpage;?>','MarkasArchieved')" >
		<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?=$tblkeyfield;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button" />
			<tr>
				<td class="table_button_bullet_right_dark1_normal" onclick="javascript:document.forms['MAreportform'].submit();" />
					&nbsp;
					</td>
				<td class="table_button_bullet_lead_dark1_normal" onclick="javascript:document.forms['MAreportform'].submit();" />
					<input type="submit" value="Mark Archived" width="10" class="table_button_bullet_lead_dark1_normal">
					</td>
				<td class="table_button_bullet_gap_dark1_normal" onMouseover="ddrivetip('Mark Record Archived');"  onMouseout="hideddrivetip();"/>
					<span class="table_button_bullet_input_dark1_normal"> MA </span>
					</td>
				<td class="table_button_bullet_tail_dark1_normal" onMouseover="ddrivetip('Mark Record Archived');"  onMouseout="hideddrivetip();"/>
					&nbsp;
					</td>
				</tr>
			</table>
		</form>					
								<?php
									}
									else {
										// There are records to display, display control.
										while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
												$tmpid = $objarray2[$settingsarray[1]."_archeived_id"];
												?>
												
	<form style="margin-bottom:0;" action="<?php echo $settingsarray[2];?>" method="POST" name="AHreportform" id="AHreportform" target="SummaryReportArchieved" onsubmit="openchild600('<?php echo $settingsarray[2];?>','SummaryReportArchieved')" >
		<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?=$tblkeyfield;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button" />
			<tr>
				<td class="table_button_bullet_right_dark1_normal" onclick="javascript:document.forms['AHreportform'].submit();" />
					&nbsp;
					</td>
				<td class="table_button_bullet_lead_dark1_normal" onclick="javascript:document.forms['AHreportform'].submit();" />
					<input type="submit" value="Archived History" width="10" class="table_button_bullet_lead_dark1_normal">
					</td>
				<td class="table_button_bullet_gap_dark1_normal" onMouseover="ddrivetip('Archived Record History');"  onMouseout="hideddrivetip();"/>
					<span class="table_button_bullet_input_dark1_normal"> AH </span>
					</td>
				<td class="table_button_bullet_tail_dark1_normal" onMouseover="ddrivetip('Archived Record History');"  onMouseout="hideddrivetip();"/>
					&nbsp;
					</td>
				</tr>
			</table>
		</form>										
											<?	
											}
									}
							}
					}
			}	// End of Archived Controls	
	}