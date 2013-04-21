<?php
function _dp_327_discrepancies2($dasharray) {
		
		$module_name = '327_discrepancies';
		$target_frame = '_iframe-layouttableiframecontent';
	
		$status0		= 0;
		$status1		= 0;
		$status2		= 0;
		$status3		= 0;
		$status4		= 0;
		
		//						0					1						2					3					4					5					6					7					8					9
		//$dasharray	= array($tmp_dash_main_id	,$tmp_dash_main_func	,$tmp_dash_main_nl	,$tmp_dash_main_ns	,$tmp_dash_main_p	,$tmp_dash_main_ml	,$tmp_menu_item_id	,$tmp_menu_item_loc	,$tmp_menu_item_nl	,$tmp_menu_item_ns);
		?>
<div name="div_<?php echo $module_name;?>_container" id="div_<?php echo $module_name;?>_container"  class="table_dashpanel_container" />
	<table name="table_<?php echo $module_name;?>" id="table_<?php echo $module_name;?>" class="dashpanel_container_table" />
		<tr>
			<form name="menuitem<?php echo $dasharray[6];?>" id="menuitem<?php echo $dasharray[6];?>"  
				method="POST" 
				action="<?php echo $dasharray[7];?>" 
				target="<?php echo $target_frame;?>" 
				style="margin: 0px; margin-bottom:0px; margin-top:-1px;" />
				<input type="hidden" name="menuitemid" value="<?php echo $dasharray[6];?>">
			<td name="header_for_<?php echo $module_name;?>" id="header_for_<?php echo $module_name;?>" 
				class="perp_menuheader"  
				/>
				<input type="button" name="button" value="<?php echo $dasharray[2];?>" 
					class="makebuttonlooklikeaheader" 
					onclick="javascript:document.getElementById('menuitem<?php echo $dasharray[6];?>').submit();" />
				</td>
				</form>	
			</tr>
	<?php
	
		// Loop through active discrepancies and display a summary report for each one
		$sql 		= "SELECT * FROM tbl_139_327_sub_d 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d.Discrepancy_by_cb_int 
		INNER JOIN tbl_139_327_main 	ON tbl_139_327_main.inspection_system_id = tbl_139_327_sub_d.Discrepancy_inspection_id 
		INNER JOIN tbl_139_327_sub_t 	ON tbl_139_327_sub_t.inspection_type_id = tbl_139_327_main.type_of_inspection_cb_int 
		INNER JOIN tbl_139_327_sub_c 	ON tbl_139_327_sub_c.conditions_id = tbl_139_327_sub_d.discrepancy_checklist_id  
		INNER JOIN tbl_139_327_sub_c_f 	ON tbl_139_327_sub_c_f.facility_id = tbl_139_327_sub_c.condition_facility_cb_int 
		INNER JOIN tbl_general_conditions ON tbl_general_conditions.general_condition_id = tbl_139_327_sub_d.discrepancy_priority 
		ORDER BY Discrepancy_date DESC";
		
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
						if($number_of_rows == 0) {
								?>
	<tr>
		<td class="table_dashpanel_container_noresults" />
			No Outstanding Discrepancies
			</td>
		</tr>
								<?php
							}
						while ($objarray 	= mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								$displayrow					= 0;
								$displayrow_a				= 0;
								$displayrow_b				= 0;
	
								$tmpdiscrepancyid			= $objarray['Discrepancy_id'];
								$tmpdiscrepancycondition	= $objarray['discrepancy_checklist_id'];	
								
								$displayrow_a				= preflights_tbl_139_327_main_sub_d_a_yn($tmpdiscrepancyid,0); // 0 will not return a row even if it is archieved.
								$displayrow_d				= preflights_tbl_139_327_main_sub_d_d_yn($tmpdiscrepancyid,0); // 0 will not return a row even if it is duplicate.

								if($displayrow_a == 0 OR $displayrow_d == 0) {
										// display nothing
										$displayrow = 0;
									}
									else {
										// Check Status of this Discrepancy, ie. Get the current stage
										
										$status 		= part139327discrepancy_getstage($tmpdiscrepancyid, 0, 0, 0, 0);
										// OUTPUT	
										// Status:
										//				0 - NO HISTORY, Requires a Work Order (ie. needs to be repaired)
										//				1 - Needs to be Repaired (is currently bounced)
										//				2 - Needs to be Bounced (is currently repaired)
										//				3 - Closed
										switch ($status) {
												case 0:
													// Add Plus One to Status 0
													$status0 = $status0 + 1;
													break;
												case 1:
													// Add Plus One to Status 1
													$status1 = $status1 + 1;
													break;
												case 2:
													// Add Plus One to Status 2
													$status2 = $status2 + 1;
													break;
												case 3:
													// Add Plus One to Status 3
													$status3 = $status3 + 1;
													break;	
											}
										
										$style_bk		= array('red','yellow','green','blue');
										$style_root		= 'table_dashpanel_container_summary_';
										
										//echo $status.'<br>';
									}	// End of Display This Discrepancy Loop/Test
							}	// End of Object While Loop
							?>
	<tr>
		<td align="center" valign="middle" />							
			<table border="0" cellpadding="0" cellspacing="0" />
				<tr>
					<td height="22" width="100%" rowspan="1" colspan="6" />
						&nbsp; 
						</td>
					</tr>
				<tr>
					<td height="100%" width="22" rowspan="4" colspan="1" />
						&nbsp;
						</td>					
					<td height="22" width="50" rowspan="2" colspan="1" align='center' valign='middle' />
						<img src="images/_interface/icons/icon_arrow_topleft.png" width="50" height="44" />
						</td>
					<td height="22" width="50" rowspan="1" colspan="1" class='<?php echo $style_root.$style_bk[1];?>' onclick="javascript:open_new_report_window('','_printerfriendlyreport');document.printform1.submit();" />	
						<form style="margin-bottom:0;" action="part139327_discrepancy_report_taskmap.php" method="POST" name="printform1" id="printform1" target="_printerfriendlyreport" />
							<input type="hidden" name="recordid" id="recordid" value='1' />
							<?php
							_tp_control_function_submit_color('printform1',$status1,'icon_status1','item_name_inactive',$style_root.$style_bk[1]);
							?>
						</form>					
						</td>
					<td height="22" width="50" rowspan="1" colspan="2" />
						<img src="images/_interface/icons/icon_arrow_topright.png" width="100" height="22" />
						</td>
					<td height="100%" width="22" rowspan="4" colspan="1" />
						&nbsp;
						</td>
					</tr>
				<tr>
					<td rowspan="2" colspan="1" />	
						<img src="images/_interface/icons/icon_arrow_blank.png" width="50" height="44" />
						</td>
					<td rowspan="2" colspan="1" />	
						<img src="images/_interface/icons/icon_arrow_blank.png" width="50" height="44" />
						</td>						
					<td height="22" rowspan="1" colspan="1" class='<?php echo $style_root.$style_bk[2];?>' onclick="javascript:open_new_report_window('','_printerfriendlyreport');document.printform2.submit();" />		
						<form style="margin-bottom:0;" action="part139327_discrepancy_report_taskmap.php" method="POST" name="printform2" id="printform2" target="_printerfriendlyreport" />
							<input type="hidden" name="recordid" id="recordid" value='2' />
							<?php
							_tp_control_function_submit_color('printform2',$status2,'icon_status2','item_name_inactive',$style_root.$style_bk[2]);
							?>
						</form>	
						</td>						
					</tr>
				<tr>
					<td width="50" rowspan="1" colspan="1" class='<?php echo $style_root.$style_bk[0];?>' onclick="javascript:open_new_report_window('','_printerfriendlyreport');document.printform0.submit();" />		
						<form style="margin-bottom:0;" action="part139327_discrepancy_report_taskmap.php" method="POST" name="printform0" id="printform0" target="_printerfriendlyreport" />
							<input type="hidden" name="recordid" id="recordid" value='0' />
							<?php
							_tp_control_function_submit_color('printform0',$status0,'icon_status0','item_name_inactive',$style_root.$style_bk[0]);
							?>
						</form>	
						</td>
					<td width="50" rowspan="2" colspan="1" align='center' valign='middle' />	
						<img src="images/_interface/icons/icon_arrow_bottomright.png" width="50" height="44" />
						</td>	
					</tr>
				<tr>
					<td rowspan="1" colspan="2" />	
						<img src="images/_interface/icons/icon_arrow_bottomleft.png" width="100" height="22" />
						</td>	
					<td rowspan="1" colspan="1" class='<?php echo $style_root.$style_bk[3];?>' onclick="javascript:open_new_report_window('','_printerfriendlyreport');document.printform3.submit();" />	
						<form style="margin-bottom:0;" action="part139327_discrepancy_report_taskmap.php" method="POST" name="printform3" id="printform3" target="_printerfriendlyreport" />
							<input type="hidden" name="recordid" id="recordid" value='3' />
							<?php
							_tp_control_function_submit_color('printform3',$status3,'icon_status3','item_name_inactive',$style_root.$style_bk[3]);
							?>
						</form>	
						</td>	
					</tr>
				<tr>
					<td height="22" width="100%" rowspan="1" colspan="6" />	
						&nbsp;
						</td>
				</table>
			</td>
		</tr>
	<tr>
		<td class="item_name_active" colspan="3" onclick="javascript:open_new_report_window('','_printerfriendlyreport');document.printform.submit();" />
		<form style="margin-bottom:0;" action="part139327_discrepancy_report_taskmap.php" method="POST" name="printform" id="printform" target="_printerfriendlyreport" />
			<input type="hidden" name="recordid" id="recordid" value='all' />
			<?php
			_tp_control_function_submit('printform','Task Map');
			?>
			</form>
			</td>
		</tr>	
	</table>
</div>
							<?php
							
					}	// End of Object
			}	// End of Connection	
	}	// End of Function
?>