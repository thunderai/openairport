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
						<td class="formoptionsubmit" onMouseover="ddrivetip('File Closed Report')"; onMouseout="hideddrivetip()">
							<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?=$tblkeyfield;?>">
							<input type="submit" value="MC" NAME="b1" ID="b1" class="formsubmit" alt="Closed" onMouseover="ddrivetip('File Closed Report')"; onMouseout="hideddrivetip()">
							</td>
							</form>
										<?php
									}
									else {
										// There are records to display, display control.
										while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
												$tmpid = $objarray2[$settingsarray[1]."_closed_id"];
												?>
						<form style="margin-bottom:0;" action="<?php echo $settingsarray[2];?>" method="POST" name="Creportform" id="Creportform" target="SummaryReport_ClosedReport" onsubmit="openchild600('<?php echo $settingsarray[2];?>','SummaryReport_CloseddReport')" >
						<td class="formoptionsubmit">
							<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?=$tblkeyfield;?>">
							<input type="submit" value="CH" NAME="a1" ID="a1" class="formsubmit" alt="Closed" onMouseover="ddrivetip('Closed Report')"; onMouseout="hideddrivetip()">
							</td>
						</form>
												<?	
											}
									}
							}
					}
			}	// End of Archived Controls	
	}