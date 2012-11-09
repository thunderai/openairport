<?php
//
// The purpose of this code is to display the Archived Code
function _tp_control_closed($tblkeyfield, $settingsarray, $functionpage) {

		if ($settingsarray == '') {
				// No information about this control, do not display it
			}
			else {
				// -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - 
				// CLOSED CONTROLS ($settingsarray)
				// -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - 
				
				$sql2 = $settingsarray[0]."'".$tblkeyfield."' ";
				$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
				//echo $sql2;
		
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
<form style="margin-bottom:0;" action="<?php echo $functionpage;?>" method="POST" name="MCreportform" id="MCreportform" target="MarkasClosed"  onsubmit="openchild600('<?php echo $functionpage;?>','MarkasClosed')" >
<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?=$tblkeyfield;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button"  />
			<tr>
				<td class="table_button_bullet_right_dark1_normal" onclick="javascript:document.forms['MCreportform'].submit();" />
					&nbsp;
					</td>
				<td class="table_button_bullet_lead_dark1_normal" />
					<input type="submit" value="Mark Closed" width="10" class="table_button_bullet_lead_dark1_normal">
					</td>
				<td class="table_button_bullet_gap_dark1_normal" onMouseover="ddrivetip('Mark Record Closed');"  onMouseout="hideddrivetip();"/>
					<span class="table_button_bullet_input_dark1_normal"> MC </span>
					</td>
				<td class="table_button_bullet_tail_dark1_normal" onMouseover="ddrivetip('Mark Record Closed');"  onMouseout="hideddrivetip();"/>
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
												$tmpid = $objarray2[$settingsarray[1]."_closed_id"];
												?>												
<form style="margin-bottom:0;" action="<?php echo $settingsarray[2];?>" method="POST" name="Creportform" id="Creportform" target="SummaryReportClosed" onsubmit="openchild600('<?php echo $settingsarray[2];?>','SummaryReportClosed')" >
	<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?=$tblkeyfield;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button"  />
			<tr>
				<td class="table_button_bullet_right_dark1_normal" onclick="javascript:document.forms['Creportform'].submit();" />
					&nbsp;
					</td>
				<td class="table_button_bullet_lead_dark1_normal" onclick="javascript:document.forms['Creportform'].submit();" />
					<input type="submit" value="Closed History" width="10" class="table_button_bullet_lead_dark1_normal">
					</td>
				<td class="table_button_bullet_gap_dark1_normal" onMouseover="ddrivetip('Closed Record History');"  onMouseout="hideddrivetip();"/>
					<span class="table_button_bullet_input_dark1_normal"> CH </span>
					</td>
				<td class="table_button_bullet_tail_dark1_normal" onMouseover="ddrivetip('Closed Record History');"  onMouseout="hideddrivetip();"/>
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