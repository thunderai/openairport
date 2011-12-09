<?php
// Function will display the buttons displayed at the end of a report
function _tp_control_footbuttons($detail = 0,$formname,$otherid = 0) {
		// $detail, currently not used
		//		1 - Display Close Button
		//		2 - Force refresh of Browse Table/Form
		//		3 - Push New Discrepancy Down
		//		4 - Display Submit Button

		if($detail == 1) {
				?>
			<input class="formsubmit" type="button" name="button" value="Close Window" 			onclick="javascript:self.close()">
				<?php
			}
			
		if($detail == 2) {
				?>
			<script>
				opener.<?php echo $formname;?>.submit();
				</script>
				<input class="formsubmit" type="button" name="button" value="Reload Browse Table" 	onclick="javascript:opener.sorttable.submit()">
				<?php
			}
			
		if($detail == 3) {
				// Display AJAX button to push data to the foem field
				?>
				<script>
						//alert("hi");
						call_server_pnd('<?php echo $formname;?>','<?php echo $otherid;?>');
					</script>
				<input class="formsubmit" type="button" name="button" value="Attach"	onClick="call_server_pnd('<?php echo $formname;?>','<?php echo $otherid;?>');">
				<?php
			}
			
		if($detail == 4) {
				?>
			<input class="formsubmit" type="button" name="button" value="<?php echo $otherid;?>" onclick="javascript:document.<?php echo $formname;?>.submit()">
				<?php
			}			
			
			
	}
	?>