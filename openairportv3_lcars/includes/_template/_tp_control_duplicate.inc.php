<?php
//
// The purpose of this code is to display the Duplicate Code
function _tp_control_duplicate($tblkeyfield, $settingsarray, $functionpage) {

if ($settingsarray == '') {
		// No information about this control, do not display it
	}
	else {
		// -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - 
		// DUPLICATE CONTROLS ($settingsarray)
		// -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - 
		
		$sql2 = $settingsarray[0]."'".$tblkeyfield."' ";
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
				<td>
				<form style="margin-bottom:0;" action="<?php echo $functionpage;?>" method="POST" name="reportform" id="reportform" target="MarkasDuplicate" onsubmit="openchild600('<?php echo $functionpage;?>','MarkasDuplicate')">
					<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?=$tblkeyfield;?>">
					<input type="submit" value="MD" NAME="b1" ID="b1" class="input_button" alt="Duplicate" onMouseover="ddrivetip('File Duplicate Report')"; onMouseout="hideddrivetip()">
					</form>	
					</td>
								<?php
							}
							else {
								// There are records to display, display control.
								while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
										$tmpid = $objarray2[$settingsarray[1]."_duplicate_id"];
										?>
				<td>
				<form style="margin-bottom:0;" action="<?php echo $settingsarray[2];?>" method="POST" name="reportform" id="reportform" target="MarkasDuplicateReport" onsubmit="openchild600('<?php echo $settingsarray[2];?>','MarkasDuplicateReport')" >
					<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?=$tblkeyfield;?>">
					<input type="submit" value="DH" NAME="b1" ID="b1" class="input_button" alt="Duplicate" onMouseover="ddrivetip('Duplicate Report')"; onMouseout="hideddrivetip()">
					</form>
					</td>
									<?	
									}
							}
					}
			}
	}	// End of Duplicate Controls
	
	}