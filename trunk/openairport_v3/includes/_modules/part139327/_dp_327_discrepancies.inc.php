<?php
function _dp_327_discrepancies($dasharray) {
		//						0					1						2					3					4					5					6					7					8					9
		//$dasharray	= array($tmp_dash_main_id	,$tmp_dash_main_func	,$tmp_dash_main_nl	,$tmp_dash_main_ns	,$tmp_dash_main_p	,$tmp_dash_main_ml	,$tmp_menu_item_id	,$tmp_menu_item_loc	,$tmp_menu_item_nl	,$tmp_menu_item_ns);
		?>
<!--<div id="div_327discrepancies" style="position:fixed;top:230px;left:10px;width:150px;z-index:90;display:none">-->
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
				<input class="buttons_quickaccess" type="button" name="button" value="<?php echo $dasharray[9];?>" onclick="javascript:document.menuitem<?php echo $dasharray[6];?>.submit()">
				</form>
			</td>
		</tr>
	<?php
	
		// Loop through active discrepancies and display a summary report for each one
		$sql 		= "SELECT * FROM tbl_139_327_sub_d 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d.Discrepancy_by_cb_int 
		INNER JOIN tbl_139_327_main 	ON tbl_139_327_main.inspection_system_id = tbl_139_327_sub_d.Discrepancy_inspection_id 
		INNER JOIN tbl_139_327_sub_t 	ON tbl_139_327_sub_t.inspection_type_id = tbl_139_327_main.type_of_inspection_cb_int 
		INNER JOIN tbl_139_327_sub_c 	ON tbl_139_327_sub_c.conditions_id = tbl_139_327_sub_d.discrepancy_checklist_id  
		INNER JOIN tbl_139_327_sub_c_f 	ON tbl_139_327_sub_c_f.facility_id = tbl_139_327_sub_c.condition_facility_cb_int 
		INNER JOIN tbl_general_conditions ON tbl_general_conditions.general_condition_id = tbl_139_327_sub_d.discrepancy_priority ";
		
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
										
										$status = part139327discrepancy_getstage($tmpdiscrepancyid,0, 0,0,0);
										
										if($status <> 3 ) {
												// Display Summary Report
												?>
	<tr>
		<td colspan="2" class="layout_dashpanel_container_div" />
		<?php
			
												display_discrepancy_summary($tmpdiscrepancyid,0,0);
												?>
			</td>
		</tr>
	<tr>
		<td class='forms_coumn_footer' align="right">
			<?php
			// Load Workorder Controls
			// Lie to the blockform
			$disid					= $tmpdiscrepancyid;
			$imclearlyahijacker		= 1;
			$functionworkorderpage 	= 1;
			$functionworkorderpage	= 'part139327_discrepancy_report_display_workorder.php';
			$functionrepairpage		= 'part139327_discrepancy_report_repair.php';
			$functionbouncepage		= 'part139327_discrepancy_report_bounce.php';
			$functionclosedpage		= 'part139327_discrepancy_report_closed.php';
			$array_repairedcontrol	= array(0,0,'part139327_discrepancy_report_display_repaired.php');
			$array_bouncedcontrol	= array(0,0,'part139327_discrepancy_report_display_bounced.php');
			$array_closedcontrol	= array(0,0,'part139327_discrepancy_report_display_closed.php');
			$has_been_bounced 		= preflights_tbl_139_327_main_sub_d_b_yn($disid,1);
			$has_been_closed 		= preflights_tbl_139_327_main_sub_d_c_yn($disid,1);
			$has_been_repaired 		= preflights_tbl_139_327_main_sub_d_r_yn($disid,1);
			$grid_or_row			= '';
			//echo "Been Bounced 	: ".$has_been_bounced." 	<br>";
			//echo "Been Closed 	: ".$has_been_closed." 		<br>";
			//echo "Been Repaired 	: ".$has_been_repaired." 	<br>";
				
				
			// Utilize our lies
			?>
			<table border="0" cellpadding='0' cellspacing='0' style="border: collapse;" align='left'>
				<tr>
					<td>
						<?php
						include("includes/_template/_tp_blockform_workorder.binc.php");	
						?>
						</td>
					</tr>
				</table>
			</td>
		<td class='forms_coumn_footer' align="right">
			<table border="0" cellpadding='0' cellspacing='0' style="border: collapse;" align='left'>
				<tr>
					<?php
					include_ONCE("includes/_template/template.list.php");
					$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_archived.php");
					$functionpage	= "part139327_discrepancy_report_archieved.php";														
					_tp_control_archived($objarray['Discrepancy_id'], $settingsarray, $functionpage);
					$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_duplicate.php");
					$functionpage	= "part139327_discrepancy_report_duplicate.php";														
					_tp_control_duplicate($objarray['Discrepancy_id'], $settingsarray, $functionpage);
					$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_e WHERE discrepancy_error_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_error.php");
					$functionpage	= "part139327_discrepancy_report_error.php";														
					_tp_control_error($objarray['Discrepancy_id'], $settingsarray, $functionpage);	
					?>
					</tr>
				</table>
			</td>
		</tr>
												<?php
											}
									}	
							}
					}
			}
		
		
		
		?>
	</table>
	</div>
	<?php
	}
?>