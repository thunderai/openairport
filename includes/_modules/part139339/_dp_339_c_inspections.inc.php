<?php
function _dp_339_c_inspections($dasharray) {
		//						0					1						2					3					4					5					6					7					8					9
		//$dasharray	= array($tmp_dash_main_id	,$tmp_dash_main_func	,$tmp_dash_main_nl	,$tmp_dash_main_ns	,$tmp_dash_main_p	,$tmp_dash_main_ml	,$tmp_menu_item_id	,$tmp_menu_item_loc	,$tmp_menu_item_nl	,$tmp_menu_item_ns);
		?>
<!--<div id="div_339inspections" style="position:fixed;top:230px;left:10px;width:150px;z-index:90;display:none">-->
<table border="1" width="45%" align="left" valign="top" style="border-collapse:collapse;Margin:5px;float:left;">
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
		$sql 		= "SELECT * FROM tbl_139_339_main 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_339_main.139339_by_cb_int  
		INNER JOIN tbl_139_339_sub_t 	ON tbl_139_339_sub_t.139339_type_id = tbl_139_339_main.139339_type_cb_int  
		WHERE 139339_date = '".date('Y/m/d')."' ORDER BY 139339_date, 139339_time";
		
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
						
								$displayrow					= 1;
								$displayrow_a				= 0;
								$displayrow_b				= 0;
	
								$tmp_inspection_id			= $objarray['139339_main_id'];
								$tmp_inspection_type		= $objarray['139339_type_cb_int'];	
								
								$displayrow_a				= preflights_tbl_139_339_c_main_a_yn($tmp_inspection_id,0); // 0 will not return a row even if it is archieved.

								if($displayrow_a == 0) {
										// display nothing
										$displayrow = 0;
									}
									else {
										// Check Status of this Discrepancy, ie. Get the current stage
										
										_339_c_display_report_summary($tmp_inspection_id,0,0);
									}
							}	
					}
			}

		?>
			</td>
		</tr>
	</table>
<!--	</div>
	
	<script type="text/javascript">
	var googlewin=dhtmlwindow.open("div3", "div", "div_339inspections", "<?php echo $dasharray[2];?>", "width=300px,height=400px,left=5px;top=40px;resize=1,scrolling=1,center=0", "recal")
	</script>-->
	<?php
	}
?>