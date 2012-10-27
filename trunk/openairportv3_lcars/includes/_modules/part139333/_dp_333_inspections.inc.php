<?php
function _dp_333_inspections($dasharray) {
		//						0					1						2					3					4					5					6					7					8					9
		//$dasharray	= array($tmp_dash_main_id	,$tmp_dash_main_func	,$tmp_dash_main_nl	,$tmp_dash_main_ns	,$tmp_dash_main_p	,$tmp_dash_main_ml	,$tmp_menu_item_id	,$tmp_menu_item_loc	,$tmp_menu_item_nl	,$tmp_menu_item_ns);
		?>
<!--<div id="div_333inspections" style="position:fixed;top:230px;left:10px;width:150px;z-index:90;display:none">-->
<table class="layout_dashpanel_container" width="45%" align="left" valign="top"  border="0" cellpadding='0' cellspacing='0' style="border: collapse;" align='left'>
	<tr>
		<td class="layout_dashpanel_container_header">
			<font size='2'>
				<b>
					<?php echo $dasharray[2];?>
					</b>
				</font>
			</td>
		<td class="layout_dashpanel_container_header_right">
			<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem<?php echo $dasharray[6];?>" method="POST" action="<?php echo $dasharray[7];?>" target="layouttableiframecontent">
				<input type="hidden" name="menuitemid" value="<?php echo $dasharray[6];?>">
				<input class="input_button" type="button" name="button" value="<?php echo $dasharray[9];?>" onclick="javascript:document.menuitem<?php echo $dasharray[6];?>.submit()">
				</form>
			</td>
		</tr>
	<?php

		// Loop through active discrepancies and display a summary report for each one
		$sql 		= "SELECT * FROM tbl_139_333_main 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_333_main.139333_by_cb_int 
		INNER JOIN tbl_139_333_sub_t 	ON tbl_139_333_sub_t.inspection_type_id = tbl_139_333_main.139333_type_cb_int 
		WHERE 139333_date = '".date('Y/m/d')."' ORDER BY 139333_date, 139333_time";
		
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
	<tr>
		<td colspan="2" class="forms_coumn_header">
			No Discrepancies
			</td>
		</tr>
								<?php
							}
						
						while ($objarray 	= mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								$displayrow					= 0;
								$displayrow_a				= 0;
								$displayrow_b				= 0;
	
								$tmp_inspection_id			= $objarray['139333_main_id'];
								$tmp_inspection_type		= $objarray['139333_type_cb_int'];	
								
								$displayrow_a				= preflights_tbl_139_333_main_a_yn($tmp_inspection_id,0); // 0 will not return a row even if it is archieved.

								if($displayrow_a == 0) {
										// display nothing
										$displayrow = 0;
									}
									else {
										// Check Status of this Discrepancy, ie. Get the current stage
												?>
	<tr>
		<td colspan="2" class="layout_dashpanel_container_div">
		<?php										
										_333_display_report_summary($tmp_inspection_id,0,0);
												?>
			</td>
		</tr>
												<?php
									}
							}	
					}
			}

		?>
			</td>
		</tr>
	</table>
	</div>
<!--	</div>
	
	<script type="text/javascript">
	var googlewin=dhtmlwindow.open("div5", "div", "div_333inspections", "<?php echo $dasharray[2];?>", "width=300px,height=100px,left=5px;top=640px;resize=1,scrolling=1,center=0", "recal")
	</script>	-->
	<?php
	}
?>