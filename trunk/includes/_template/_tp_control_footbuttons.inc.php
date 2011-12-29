<?php
// Function will display the buttons displayed at the end of a report
function _tp_control_footbuttons($detail = 0,$formname,$otherid = 0,$scriptfunction = 'call_server_pnd') {
		// $detail
		//		1 - Display Close Button
		//		2 - Force refresh of Browse Table/Form
		//		3 - Push New Discrepancy Down
		//		4 - Display Submit Button
		// $formname
		//		Name of the Form
		// $otherid, Limited use
		//		ID of the main record being edited in a summary page usually
		// $scriptfunction
		//		The name of the javascript function to use when pushing data

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
				// PROBLEM:  Any form that does the Push will have its own demand for a Javascript function. 
				//			PHP is serverside, Javascript is done on the client. 
				//			We should be able to hack this:
				
				?>
				<script>
						//alert("hi");
						<?php echo $scriptfunction;?>('<?php echo $formname;?>','<?php echo $otherid;?>');
					</script>
				<input class="formsubmit" type="button" name="button" value="Attach"	onClick="<?php echo $scriptfunction;?>('<?php echo $formname;?>','<?php echo $otherid;?>');">
				<?php
			}
			
		if($detail == 4) {
				?>
			<input class="formsubmit" type="button" name="button" value="<?php echo $otherid;?>" onclick="javascript:document.<?php echo $formname;?>.submit()">
				<?php
			}			
			
			
	}
	?>