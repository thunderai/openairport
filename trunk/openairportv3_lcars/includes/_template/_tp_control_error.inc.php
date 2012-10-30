<?php
//
// The purpose of this code is to display the Duplicate Code
function _tp_control_error($tblkeyfield, $settingsarray, $functionpage) {

		if ($settingsarray == '') {
				// No information about this control, do not display it
			}
			else {
				// -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - 
				// ERROR CONTROLS ($settingsarray)
				// -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - 
				
				// Provide ability to Add new Error Records reguardless
				?>	
	<form style="margin-bottom:0;" action="<?php echo $functionpage;?>" method="POST" name="MarkasErrorreportform" id="MarkasErrorreportform" target="MarkasError" onsubmit="openchild600('<?php echo $functionpage;?>','MarkasError')">
		<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?=$tblkeyfield;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button" onMouseover="ddrivetip('Mark Record with an Error');"  onMouseout="hideddrivetip()" />
			<tr>
				<td class="table_button_bullet_right_dark1_normal" />
					&nbsp;
					</td>
				<td class="table_button_bullet_lead_dark1_normal" />
					<?php
					echo "Error It";
					?>
					</td>
				<td class="table_button_bullet_gap_dark1_normal" />
					<input type="submit" value="ME" NAME="b1" ID="b1" class="table_browse_row_functions_inputfield" >
					</td>
				<td class="table_button_bullet_tail_dark1_normal" />
					&nbsp;
					</td>
				<td class="table_button_bullet_left_dark1_normal" />
					&nbsp;
					</td>
				</tr>
			</table>
		</form>
				<?php
				$sql2 = $settingsarray[0]."'".$tblkeyfield."' LIMIT 1";
				//echo $sql2;
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
										<?php
									}
									else {
										// There are records to display, display control.
										while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
												$tmpid = $objarray2[$settingsarray[1]."_error_id"];
												?>
	<form style="margin-bottom:0;" action="<?php echo $settingsarray[2];?>" method="POST" name="ReportErrorreportform" id="ReportErrorreportform" target="SummaryReportError" onsubmit="openchild600('<?php echo $settingsarray[2];?>','SummaryReportError')">
		<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?=$tblkeyfield;?>">
		<table border="0" cellpadding="0" cellspacing="0" class="table_bottom_right_container_button" onMouseover="ddrivetip('Mark Record with an Error');"  onMouseout="hideddrivetip()" />
			<tr>
				<td class="table_button_bullet_right_dark1_normal" />
					&nbsp;
					</td>
				<td class="table_button_bullet_lead_dark1_normal" />
					<?php
					echo "Error History";
					?>
					</td>
				<td class="table_button_bullet_gap_dark1_normal" />
				<input type="submit" value="EH" NAME="b1" ID="b1" class="table_browse_row_functions_inputfield" >
					</td>
				<td class="table_button_bullet_tail_dark1_normal" />
					&nbsp;
					</td>
				<td class="table_button_bullet_left_dark1_normal" />
					&nbsp;
					</td>
				</tr>
			</table>
		</form>												
											<?php
											}
									}
							}
					}
			}	// End of Error Controls	
	}
	?>