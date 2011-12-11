<?php
function _dp_327_inspections($dasharray) {
		//						0					1						2					3					4					5					6					7					8					9
		//$dasharray	= array($tmp_dash_main_id	,$tmp_dash_main_func	,$tmp_dash_main_nl	,$tmp_dash_main_ns	,$tmp_dash_main_p	,$tmp_dash_main_ml	,$tmp_menu_item_id	,$tmp_menu_item_loc	,$tmp_menu_item_nl	,$tmp_menu_item_ns);
		?>
<table border="1" width="270" align="left" valign="top" style="border-collapse:collapse;Margin:5px;">
	<tr>
		<td class="tableheaderleft">
			<font size='2'>
				<b>
					<?php echo $dasharray[2];?>
					</b>
				</font>
			</td>
		<td class="tableheaderright">
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem<?php echo $dasharray[6];?>" method="POST" action="<?php echo $dasharray[7];?>" target="layouttableiframecontent">
				<input type="hidden" name="menuitemid" value="<?php echo $dasharray[6];?>">
				<input class="formsubmit" type="button" name="button" value="<?php echo $dasharray[9];?>" onclick="javascript:document.menuitem<?php echo $dasharray[6];?>.submit()">
				</form>
			</td>
		</tr>
	<tr>
		<td colspan="2" class='formresults'>
	<?php

		// Loop through active discrepancies and display a summary report for each one
		$sql 		= "SELECT * FROM tbl_139_327_main 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_327_main.inspection_completed_by_cb_int 
		INNER JOIN tbl_139_327_sub_t 	ON tbl_139_327_sub_t.inspection_type_id = tbl_139_327_main.type_of_inspection_cb_int 
		WHERE 139327_date = '".date('Y/m/d')."' ORDER BY 139327_date, 139327_time";
		
		//echo $sql;
		$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);		
				if ($objrs) {
						$number_of_rows 	= mysqli_num_rows($objrs);
						if($number_of_rows == 0){
								// Nothing to Display
								?>
			No Records to Display Today
								<?php
							}
						
						while ($objarray 	= mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								$displayrow					= 0;
								$displayrow_a				= 0;
								$displayrow_b				= 0;
	
								$tmp_inspection_id			= $objarray['inspection_system_id'];
								$tmp_inspection_type		= $objarray['type_of_inspection_cb_int'];	
								
								$displayrow_a				= preflights_tbl_139_327_main_a_yn($tmp_inspection_id,0); // 0 will not return a row even if it is archieved.

								if($displayrow_a == 0) {
										// display nothing
										$displayrow = 0;
									}
									else {
										// Check Status of this Discrepancy, ie. Get the current stage
										
										_327_display_report_summary($tmp_inspection_id,0,0);
									}
							}	
					}
			}

		?>
			</td>
		</tr>
	</table>
	<?php
	}
?>