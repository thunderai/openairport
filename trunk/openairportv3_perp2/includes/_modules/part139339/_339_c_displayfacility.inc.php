<?php

?>

<?php

	// Define SQL
	$sql = "SELECT * FROM tbl_139_339_sub_c_c 
			INNER JOIN tbl_139_339_sub_c ON 139339_cc_c_cb_int = 139339_c_id 
			INNER JOIN tbl_139_339_sub_c_f ON 139339_f_id = 139339_c_facility_cb_int 
			WHERE 139339_cc_ficon_cb_int = '".$recordid."' AND 139339_f_name LIKE '%".$display_facility."%'   
			ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
									
// Establish a Conneciton with the Database
							$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
							if (mysqli_connect_errno()) {
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else {
									$res = mysqli_query($objcon, $sql);
									if ($res) {
											$number_of_rows = mysqli_num_rows($res);
											//printf("result set has %d rows. \n", $number_of_rows);
					
											while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
													
													if($display_header == 1) {
															$display_header = 0;
															?>
															<?php
															switch($objfields['139339_f_rwy_yn']) {
																	case 0:
																			?>
	<div style="position:absolute; z-index:13; left:<?php echo $objfields['139339_f_locx'];?>; top:<?php echo $objfields['139339_f_locy'];?>; width:450; align="center" />
		<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse" border="1" bordercolor="#000000">
																	
			<tr>
					<td height="37" align="center" valign="middle" width="60" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Surface
						</td>
					<td align="center" valign="middle" width="50" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>CLD ?
						</td>
					<td align="center" valign="middle" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Condition
						</td>												
					<td  align="center" valign="middle" width="60" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Mu(s)
						</td>
					</tr>																		
																			<?php
																		break;
																	case 2:
																			?>
		<div style="position:absolute; z-index:13; left:<?php echo $objfields['139339_f_locx'];?>; top:<?php echo $objfields['139339_f_locy'];?>; width:270; align="center" />
		<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse" border="1" bordercolor="#000000">
			<tr>
				<td height="37" rowspan="1" colspan="3" align="center" valign="middle" width="60" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
						<font size="2"><B>Mu test conducted from</b></font>
					</td>
				</tr>														<?php
																		break;
																	case 3:
																		?>
		<div style="position:absolute; z-index:13; left:<?php echo $objfields['139339_f_locx'];?>; top:<?php echo $objfields['139339_f_locy'];?>; width:270; align="center" />
		<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse" border="1" bordercolor="#000000">
			<tr>
				<td height="37" rowspan="1" colspan="3" align="center" valign="middle" width="60" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
						<font size="2"><B>Operational Notices</b></font>
					</td>
				</tr>																	
																		<?php
																		break;
																	case 8:
																			?>
	<div style="position:absolute; z-index:13; left:<?php echo $objfields['139339_f_locx'];?>; top:<?php echo $objfields['139339_f_locy'];?>; width:450; align="center" />
		<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse" border="1" bordercolor="#000000">
																	
			<tr>
					<td height="37" align="center" valign="middle" width="60" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Surface
						</td>
					<td align="center" valign="middle" width="50" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>CLD ?
						</td>
					<td align="center" valign="middle" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Condition
						</td>												
					<td  align="center" valign="middle" width="60" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Mu(s)
						</td>
					</tr>																		
																			<?php
																		break;
																	default:
																			?>
	<div style="position:absolute; z-index:13; left:<?php echo $objfields['139339_f_locx'];?>; top:<?php echo $objfields['139339_f_locy'];?>; width:450; align="center" />
		<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse" border="1" bordercolor="#000000">
																	
			<tr>
					<td height="37" rowspan="2" align="center" valign="middle" width="60" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Surface
						</td>
					<td rowspan="2" align="center" valign="middle" width="50" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>CLD ?
						</td>
					<td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Condition
						</td>												
					<td colspan="3" align="center" valign="middle" width="60" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Mu(s)
						</td>
					</tr>
				<tr>
					<td colspan="1" align="middle" valign="center" width="30" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
						<font size="2">T
						</td>
					<td colspan="1" align="middle" valign="center" width="30" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
						<font size="2">M
						</td>
					<td colspan="1" align="middle" valign="center" width="30" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
						<font size="2">R
						</td>
					</tr>																			<?php
																		break;
																		
																}
															
														}
													
													$tmpid 					= $objfields['139339_c_id'];
													$current_facility 		= $objfields['139339_c_facility_cb_int'];
													$current_facility_rwy	= $objfields['139339_f_rwy_yn'];
													$tmpcondname			= $objfields['139339_c_name'];
													$tmp_xlox				= $objfields['139339_cc_xloc'];
													
													$facility_id			= $objfields['139339_f_id'];				// The ID of the facility row
													$facility_name			= $objfields['139339_f_name'];				// The Name of this facility. Typically english readable
													$facility_is_runway		= $objfields['139339_f_rwy_yn'];			// Toggle for dynamic control. 0: Nothing special, 1: Is a runway, 2: is a holder for runway orintation, 3: Checkbox not applicable to a surface
													
													$condition_id			= $objfields['139339_c_id'];				// The ID of the condition row
													$condition_name			= $objfields['139339_c_name'];				// The Programming name of this condition.  Typically not something readable
													$condition_type			= $objfields['139339_c_type_cb_int'];		// The type of FiCON this condition is part of.  Timeline....
													$condition_field_type	= $objfields['139339_cc_type'];				// Describes the type of input box this is:  0:Mu Value, 1: checkbox, 2: text
													$condition_xlocation	= $objfields['139339_cc_xloc'];				// Describes the order to sort this condition

													$condition_location_x	= $objfields['139339_cc_location_x'];
													$condition_location_y	= $objfields['139339_cc_location_y'];
													
													$condition_location_rx	= $objfields['139339_cc_location_rx'];
													$condition_location_ry	= $objfields['139339_cc_location_ry'];
													
													$checklist_item_id		= $objfields['139339_cc_id'];				// ID of the checklist item
													$checklist_item_disc	= $objfields['139339_cc_d_yn'];				// Value of the discrepancy (could be Mu value, a surface description, or a checkbox toggle).
													
													//$main_id				= $objfields['139339_main_id'];
													//$main_time			= $objfields['139339_time'];
													//$main_date			= $objfields['139339_date'];
													
													
													
													$tmpcondnamestr			= str_replace(" ","",$tmpcondname);
													
													if ($current_facility!=$previous_facility) {
															// This is is a new row to display.
															// Display Facility Name
															?>
					<tr>
      					<td align="left" valign="middle" name="<?=($objfields["139339_c_facility_cb_int"]);?>" height="15" background="images/part_139_327/cellbackground.png" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;" />
      						&nbsp;
							<font size="3">
								<? 
								$tmpfacility = $objfields["139339_c_facility_cb_int"];
								part139339_c_facilitycombobox($tmpfacility, "all", "notused", "hide", "all");
								?>
								</font>
							</td>
															<?
															}
													if ($current_facility_rwy == 2) {
															// This facility is a runway orintation marker.
															$thisrunway = $objfields['139339_cc_type'];
															
															if ($objfields['139339_cc_type'] == 3) {
																	$thisrunway = $objfields['139339_cc_type'];
																	// This is a runway orintation for runway 17/35
																	// Q. What direction is the travel in?
																	// A. What ever the value is in: 139339_cc_d_yn.
																	if ($objfields["139339_cc_d_yn"] == 1) {
																			//echo "From 17";
																			$tmp_runwayort_17	= 1;
																			//echo $tmp_runwayort_17."<br>";
																		}
																		else {
																			//echo "From 35";
																			$tmp_runwayort_17	= 0;
																			//echo $tmp_runwayort_17."<br>";
																		}	// End of Oriant Check
																}	// End of cc_type Check
														}	// End of facility Check
														

													if ($current_facility_rwy == 1) {
															//This facility is a runway.
															IF ($objfields['139339_cc_type'] == 0) {
																	//echo $tmp_runwayort_17." / ";
																	//echo $tmp_runwayort_12." : ";
																	//Field is a Mu
																	//Step 2: Add one to the count loop
																		$rwy_loop_count	= ($rwy_loop_count + 1);
																		//echo "This is the ".$inner_rwy_loop." Mu for this runway <br>";
																		
																		// Draw Cells Here		////////////////////////////////////////////////////////////////
																		//$tmp_xlox				= $objfields['139339_cc_xloc'];
																		
																		if ($thisrunway == 3) {
																				// Load 17 arrays																		
																				//$tmp_x								= $a17_x[$inner_rwy_loop];
																				//$tmp_y								= $a17_y[$inner_rwy_loop];											
																				$arunway_number_17[$inner_rwy_loop]	= $objfields["139339_cc_d_yn"];
																				$arunway_x_17[$inner_rwy_loop]		= $tmp_x;
																				$arunway_y_17[$inner_rwy_loop]		= $tmp_y;
																			}
																		if ($thisrunway == 4) {
																				// Load 12 arrays
																				//$tmp_x								= $a12_x[$inner_rwy_loop];
																				//$tmp_y								= $a12_y[$inner_rwy_loop];											
																				$arunway_number_12[$inner_rwy_loop]	= $objfields["139339_cc_d_yn"];
																				$arunway_x_12[$inner_rwy_loop]		= $tmp_x;
																				$arunway_y_12[$inner_rwy_loop]		= $tmp_y;
																			}
																		//displayficonmuelement(10, $tmp_x, $tmp_y, 5,10, 10, "images/part_139_339/139_339_1735overlayblank.gif", $objfields["139339_cc_d_yn"], "#FFFFFF", "#000000");
																		
																		$inner_rwy_loop	= ($inner_rwy_loop + 1);
																		
																		// End Draw Cells Area	////////////////////////////////////////////////////////////////
																		
																		//echo "This is the ".$rwy_loop_count." field in this runway<br>";
																	//Step 1: Add value of the field to a temporary field to store the third value
																		$tmp_rwy_mu	= ($tmp_rwy_mu + $objfields["139339_cc_d_yn"]);
																		//echo "All Mus in this cycle = ".$tmp_rwy_mu." <br>";
																	//Step 3: If rwy_loop_count = 3 then average and display
																		if ($rwy_loop_count==3) {
																				//average value
																					$tmpaverage 	= ($tmp_rwy_mu/3);
																					$tmpaverage		= round($tmpaverage);
																				//Display Average
																					?>
						<td align="center" valign="middle" name="<?=($tmpcondnamestr);?>" height="15" background="images/part_139_327/cellbackground.png" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;" />
      						<font size="3">
								<?
								if ($tmpaverage==0) {
										// Display Nothing
									}
									else {
										echo $tmpaverage;
									}
								?>
								</font>
							</td>
																							<?
																							//echo $tmpaverage;
																						//Reset counter
																							$rwy_loop_count = 0;
																						//Reset Value
																							$tmp_rwy_mu		= 0;
																							
																					}
																		if ($inner_rwy_loop == 9) {
																				// 9 Mu Values have been reported, reset the loop
																				$inner_rwy_loop = 0;
																				// Reset Runway Orinatation Markers
																				$tmp_runwayort_17	= -1;
																				$tmp_runwayort_12	= -1;
																				$thisrunway			= -1;
																			}
																		}
																		else {
																			?>
      					<td align="center" valign="middle" name="<?=($tmpcondnamestr);?>" height="15" background="images/part_139_327/cellbackground.png" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;" />
      						<font size="3">
							<?
							switch ($objfields['139339_cc_type']) {
									case 0:
											echo $objfields["139339_cc_d_yn"];
											break;
									case 1:
											if ($objfields["139339_cc_d_yn"]== 1) {
													// Display Yes
													echo "Yes";
												}
												else {
													//Display No
													echo "No";
												}
											break;
									case 2:
											echo $objfields["139339_cc_d_yn"];
											break;
									}
								?>
								</font>
							</td>																			
																			<?
																		}
																}
																else {
																		switch ($objfields['139339_cc_type']) {
																				case 0:
																						$tmpcolspan	= 3;
																						break;
																				case 1:
																						$tmpcolspan	= 1;
																						break;
																				case 2:
																						$tmpcolspan	= 1;
																						break;
																			}
																?>
      					<td colspan="<?=($tmpcolspan);?>" align="center" valign="middle" name="<?=($tmpcondnamestr);?>" height="15" background="images/part_139_327/cellbackground.png" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;" />
      						<font size="3">
							<?
							switch ($objfields['139339_cc_type']) {
									case 0:
											echo $objfields["139339_cc_d_yn"];
											break;
									case 1:
											if ($objfields["139339_cc_d_yn"] == 1) {
													// Display Yes
													echo "Yes";
												}
												else {
													//Display No
													echo "No";
												}
											break;
									case 2:
											echo $objfields["139339_cc_d_yn"];
											break;
									case 3:
											if ($objfields["139339_cc_d_yn"] == 1) {
													// Display Yes
													echo "From 17";
													$tmp_runwayort_17	= 1;
												}
												else {
													//Display No
													echo "From 35";
													$tmp_runwayort_17	= 0;
												}
											break;
									case 4:
											if ($objfields["139339_cc_d_yn"]==1) {
													// Display Yes
													echo "From 12";
													$tmp_runwayort_12	= 1;
												}
												else {
													//Display No
													echo "From 30";
													$tmp_runwayort_12	= 0;
												}
											break;
								}
								?>								
								</font>
							</td>																		
															<?
																}
												
												
												//								0		, 1						, 2						, 3						, 4						, 5				, 6						, 7
												$display_menu_item[$i] 	= array($tmpid	,$condition_location_x	,$condition_location_y	,$checklist_item_disc	,$facility_is_runway	,$facility_name	,$condition_location_rx	,$condition_location_ry);
												
												$previous_facility		= $objfields['139339_c_facility_cb_int'];
												$i 						= $i + 1;
												
												}	// End of while loop
												mysqli_free_result($res);
												mysqli_close($objcon);
										}	// end of Res Record Object						
								}
								?>
					</table>
				</div>
<?php


?>