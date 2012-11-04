<?php
function _333_display_report_summary($inspectionid = 0,$detail_level = 0,$returnhtml = 0) {
		// Display Discrepancy Summary
		// Detail Level:
		//					0 : Name and Remark
		//					1 : All Local Table Values   				<--- NOT DEFINED, useless
		//					2 : Everything!!!! (1,3,4,5,6,7,8)
		//					3 : 0 + Archieved
		//					4 : 0 + Error
		//					5 : 0 + Checklist items
		//					6 : 0 + Discrepancies						<--- NOT APPLICABLE - All Discrepancies are Forced in Part 139.327	
		//					7 : 0 + Also Owned By						<--- NOT APPLICABLE
		
		
		$display_basic 		= 0;
		$display_checklist	= 0;	
		$display_discrep	= 0;
		$display_ownedby	= 0;
		$display_archived 	= 0;
		$display_error 		= 0;
		
				$webroot			= "http://localhost/openairportv3t/";
		
		if($detail_level == 0) {
				$display_basic 		= 1;
		
			}		
		if($detail_level == 2) {
				$display_basic 		= 1;
				$display_checklist	= 1;
				$display_discrep	= 1;				
				$display_archived 	= 1;
				$display_error 		= 1;
				$display_ownedby	= 1;
			}			
		if($detail_level == 3) {
				$display_basic 		= 1;
				$display_archived 	= 1;		
			}		
		if($detail_level == 4) {
				$display_basic 		= 1;
				$display_error 		= 1;			
			}	
		if($detail_level == 5) {
				$display_basic 		= 1;
				$display_checklist	= 1;				
			}	
		if($detail_level == 6) {
				$display_basic 		= 1;
				$display_discrep	= 1;		
			}				
		if($detail_level == 7) {
				$display_basic 		= 1;
				$display_ownedby	= 1;		
			}					
			
		$sql 		= "SELECT * FROM tbl_139_333_main 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_333_main.139333_by_cb_int 
		INNER JOIN tbl_139_333_sub_t 	ON tbl_139_333_sub_t.inspection_type_id = tbl_139_333_main.139333_type_cb_int ";
		
		if($inspectionid == 0) {
				// No discrepancy is defined, find all
			}
			else {
				// Use the specific entry
				$sql = $sql."WHERE 139333_main_id = '".$inspectionid."' ";
			}
		
		//echo $sql;
		$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		if($returnhtml == 0) {
				// Just display the results now
				echo "<table width='100%' cellpaddin='1' cellspacing='1' border='0' class='layout_dashpanel_container_div'>";
			}
			else {
				// DO NOT display anything YET!!!!!
				$table_i = "<table width='100%' cellpaddin='1' cellspacing='1' border='0' class='layout_dashpanel_container_div'>";
			}

		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);		
				if ($objrs) {
						$number_of_rows 	= mysqli_num_rows($objrs);
						while ($objarray 	= mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								$inspectionid = $objarray['139333_main_id'];
								
								$basicHTML = "
												<tr>		
													<td class='table_dashpanel_container_summary_rowheader'>
														ID
														</td>
													<td class='table_dashpanel_container_summary_rowresult'>
														<a class='table_dashpanel_container_summary_link' href='#' onclick='openmapchild(&quot;part139333_report_display.php?recordid=".$inspectionid."&quot;,&quot;SummaryWindow&quot;)'; />".$inspectionid."</a>
														</td>
													</tr>
												<tr>		
													<td class='table_dashpanel_container_summary_rowheader'>
														Date / Time 
														</td>
													<td class='table_dashpanel_container_summary_rowresult'>".
														$objarray['139333_date']." / ".$objarray['139333_time']." 
														</td>
													</tr>													
												<tr>		
													<td class='table_dashpanel_container_summary_rowheader'>
														Type
														</td>
													<td class='table_dashpanel_container_summary_rowresult'>".
														$objarray['inspection_type']." (".$objarray['inspection_type_short_name'].") 
														</td>
													</tr>
												<tr>		
													<td class='table_dashpanel_container_summary_rowheader'>
														Inspection By 
														</td>
													<td class='table_dashpanel_container_summary_rowresult'>".
														$objarray['emp_firstname']." ".$objarray['emp_lastname']." 
														</td>
													</tr>";

								if($returnhtml == 0) {
										// Just display the results now
										echo $basicHTML;
									}
									else {
										// DO NOT display anything YET!!!!!
									}

								if($display_checklist == 1) {	
									
										// Display all Repaired Information
										$sql2 = "SELECT * FROM tbl_139_333_sub_c_c 										
										INNER JOIN tbl_139_333_sub_c 	ON tbl_139_333_sub_c.conditions_id = tbl_139_333_sub_c_c.conditions_checklists_condition_cb_int 
										INNER JOIN tbl_139_333_sub_c_f 	ON tbl_139_333_sub_c_f.facility_id = tbl_139_333_sub_c.condition_facility_cb_int 
										INNER JOIN tbl_inventory_sub_e	ON tbl_inventory_sub_e.equipment_id = tbl_139_333_sub_c.condition_tied_id 
										WHERE tbl_139_333_sub_c_c.conditions_checklists_inspection_cb_int = ".$inspectionid." 
										ORDER BY equipment_name,facility_name";
								
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
														if($number_of_rows >=1) {
																
																$checklistHTML_i = "
																				<tr>		
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Checklist Information
																						</td>
																					</tr>
																				<tr>
																					<td class='table_dashpanel_container_summary_rowheader' width='45%'>
																						Facility / Equipment
																						</td>
																					<td class='table_dashpanel_container_summary_rowheader'>
																						Result
																						</td>																							
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $checklistHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															
														while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
													
																$basicvalue = $objarray2['conditions_checklist_values']; 
													
																if($objarray2['facility_id'] == 1 OR $objarray2['facility_id'] == 5) {
																		// This is a complex result that needs to be split into parts
																		$resultstring = explode('/',$basicvalue);
																		//echo "here I am";
																		$display = "Inital Angle :".$resultstring[0]." Specification was :".$resultstring[1]." Tollerance is :".$resultstring[2]." Corrected Angle was: ".$resultstring[3]."";
																	}
																	else {
																		$display = gs_conditions_return($basicvalue, "no", $fieldname.'cb', 'hide', $basicvalue,1);
																	}
																

																$checklistHTML = $checklistHTML."									
																				<tr>		
																					<td class='table_dashpanel_container_summary_rowheader'>
																						Check the ".$objarray2['facility_name']." on ".$objarray2['equipment_name']."
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$display."
																						</td>	
																					</tr>
																				";
															}
													}
											}
										if($returnhtml == 0) {
												// Just display the results now
												echo $checklistHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}		
									}									
																		
									
								if($display_archived == 1) {

										// Display all Repaired Information
										$sql2 = "SELECT * FROM tbl_139_333_main_a 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_333_main_a.139333_a_by_cb_int 
										WHERE 139333_a_inspection_id = '".$inspectionid."' AND inspection_archived_yn = 1 
										ORDER BY 139333_a_date,139333_a_time";
										
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
														if($number_of_rows >=1) {
																
																$archivedHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Archieved Information
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $archivedHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															
														while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {

																$archivedHTML = $archivedHTML."
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Date / Time
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['139333_a_date']." / ".$objarray2['139333_a_time']."
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Repaired By
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['emp_firstname']." ".$objarray2['emp_lastname']."
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Comments
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['139333_a_reason']." 
																						</td>
																					</tr>
																				";
															}
													}
											}
										if($returnhtml == 0) {
												// Just display the results now
												echo $archivedHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}		
									}
									
								if($display_error == 1) {	

										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_333_main_e 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_333_main_e.139333_e_by_cb_int 
										WHERE 139333_a_inspection_id = '".$inspectionid."' AND inspection_archived_yn = 1 
										ORDER BY 139333_e_date,139333_e_time";
										
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
														if($number_of_rows >=1) {
																
																$errorHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Error Information
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $errorHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															
														while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
														
																$errorHTML = $errorHTML."
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Date / Time
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['139333_e_date']." / ".$objarray2['139333_e_time']."
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Error By
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['emp_firstname']." ".$objarray2['emp_lastname']."
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Comments
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['139333_e_reason']." 
																						</td>
																					</tr>
																				";
															}
													}
											}	
										if($returnhtml == 0) {
												// Just display the results now
												echo $errorHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}
									}
							}
					}
			}
									
			
		if($returnhtml == 0) {
				// Just display the results now
				echo "</table>";
			}
			else {
				// DO NOT display anything YET!!!!!
				$table_o = "</table>";
			}			
			
		if($returnhtml == 0) {
				// Just display the results now
				// Display Nothing
			}
			else {
				// Assemble a return variable
				// Order Information
				// Basic => Checklist => discrepancies => Archived => Error
				$return_string = $table_i."".$basicHTML."".$checklistHTML_i."".$checklistHTML."".$archievedHTML_i."".$archievedHTML."".$errorHTML_i."".$errorHTML."".$table_o."";
				return $return_string;
			}			
	}
	?>