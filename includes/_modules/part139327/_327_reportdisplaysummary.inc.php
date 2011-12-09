<?php
function _327_display_report_summary($inspectionid = 0,$detail_level = 0,$returnhtml = 0) {
		// Display Discrepancy Summary
		// Detail Level:
		//					0 : Name and Remark
		//					1 : All Local Table Values   <--- NOT DEFINED, useless
		//					2 : Everything!!!! (1,3,4,5,6,7,8)
		//					3 : 0 + Archieved
		//					4 : 0 + Error
		//					5 : 0 + Checklist items
		//					6 : 0 + Discrepancies
		//					7 : 0 + Also Owned By
		
		
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
			
		$sql 		= "SELECT * FROM tbl_139_327_main 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_327_main.inspection_completed_by_cb_int 
		INNER JOIN tbl_139_327_sub_t 	ON tbl_139_327_sub_t.inspection_type_id = tbl_139_327_main.type_of_inspection_cb_int ";
		
		if($inspectionid == 0) {
				// No discrepancy is defined, find all
			}
			else {
				// Use the specific entry
				$sql = $sql."WHERE inspection_system_id = '".$inspectionid."' ";
			}
		
		//echo $sql;
		$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		if($returnhtml == 0) {
				// Just display the results now
				echo "<table width='100%' cellpaddin='1' cellspacing='1' border='0'>";
			}
			else {
				// DO NOT display anything YET!!!!!
				$table_i = "<table width='100%' cellpaddin='1' cellspacing='1' border='0'>";
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
						
								$inspectionid = $objarray['inspection_system_id'];
								
								$basicHTML = "
												<tr>
													<td colspan='2' class='tableheaderleft'>
														<b>Basic Information</b>
														</td>
													</tr>
												<tr>		
													<td class='formresults'>
														ID
														</td>
													<td class='formresults'>
															<a href='".$webroot."part139327_report_display_new.php?recordid=".$inspectionid."' target='_newreportwindowd'>".$inspectionid."</a>
														</td>
													</tr>													
												<tr>		
													<td class='formresults'>
														Type
														</td>
													<td class='formresults'>".
														$objarray['inspection_type']." (".$objarray['inspection_type_short_name'].") 
														</td>
													</tr>
												<tr>		
													<td class='formresults'>
														Inspection By 
														</td>
													<td class='formresults'>".
														$objarray['emp_firstname']." ".$objarray['emp_lastname']." 
														</td>
													</tr>
												<tr>		
													<td class='formresults'>
														Date / Time 
														</td>
													<td class='formresults'>".
														$objarray['139327_date']." / ".$objarray['139327_time']." 
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
										$sql2 = "SELECT * FROM tbl_139_327_sub_c_c 										
										INNER JOIN tbl_139_327_sub_c 	ON tbl_139_327_sub_c.conditions_id = tbl_139_327_sub_c_c.conditions_checklists_condition_cb_int 
										INNER JOIN tbl_139_327_sub_c_f 	ON tbl_139_327_sub_c_f.facility_id = tbl_139_327_sub_c.condition_facility_cb_int 
										WHERE tbl_139_327_sub_c_c.conditions_checklists_inspection_cb_int = ".$inspectionid." 
										ORDER BY facility_name,condition_name";
								
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
																					<td colspan='2' class='tableheaderleft'>
																						<b>Checklist Information</b>
																						</td>
																					</tr>
																				<tr>
																					<td class='formoptions' width='45%'>
																						Facility / Condition
																						</td>
																					<td class='formoptions'>
																						Discrepancy
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
													
																$founddiscrepancy = $objarray2['conditions_checklist_discrepancy_yn'];
																if($founddiscrepancy == 0) {
																		//Nothing Found
																		$txt_found = "No Discrepancy Noted";
																	}
																	else {
																		$txt_found = "<b>Discrepancy Noted</b>";
																	}

																$checklistHTML = $checklistHTML."									
																				<tr>		
																					<td class='formresults'>".
																						$objarray2['facility_name']." / ".$objarray2['condition_name']."
																						</td>
																					<td class='formresults'>".
																						$txt_found."
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
									
								if($display_discrep == 1) {	
									
										// Display all Repaired Information
										$sql2 = "SELECT * FROM tbl_139_327_sub_d 									
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id =  tbl_139_327_sub_d.Discrepancy_by_cb_int 
										WHERE Discrepancy_inspection_id = '".$inspectionid."' ";
								
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
																
																$discrepHTML_i = "
																				<tr>
																					<td colspan='2' class='tableheaderleft'>
																						<b>Discrepancy Information</b>
																						</td>																						
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $discrepHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															
													while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {

																$discrepHTML = $discrepHTML."		
																				<tr>		
																					<td colspan='2' class='formoptions'>
																						Single Discrepancy Info
																						</td>
																					</tr>	
																				<tr>		
																					<td align='center' valign='middle' class='formresults'>
																						ID
																						</td>
																					<td class='formresults'>
																						<a href='".$webroot."part139327_discrepancy_report_display.php?recordid=".$objarray2['Discrepancy_id']."' target='_newreportwindowd'>".$objarray2['Discrepancy_id']."</a>
																						</td>
																					</tr>																					
																				<tr>		
																					<td align='center' valign='middle' class='formresults'>
																						Date / Time
																						</td>
																					<td class='formresults'>".
																						$objarray2['Discrepancy_date']." / ".$objarray2['Discrepancy_time']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formresults'>
																						Error Reported By
																						</td>
																					<td class='formresults'>".
																						$objarray2['emp_firstname']." ".$objarray2['emp_lastname']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formresults'>
																						Name
																						</td>
																					<td class='formresults'>".
																						$objarray2['Discrepancy_name']." 
																						</td>
																					</tr>																					
																				<tr>		
																					<td align='center' valign='middle' class='formresults'>
																						Comments
																						</td>
																					<td class='formresults'>".
																						$objarray2['discrepancy_remarks']." 
																						</td>
																					</tr>
																				";
															}
													}
											}
										if($returnhtml == 0) {
												// Just display the results now
												echo $discrepHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}		
									}	

								if($display_ownedby == 1) {	
									
										// Display all Repaired Information
										$sql2 = "SELECT * FROM tbl_139_327_sub_d_o 
										INNER JOIN tbl_139_327_main		ON tbl_139_327_main.inspection_system_id = tbl_139_327_sub_d_o.disinspection_id 
										INNER JOIN tbl_139_327_sub_d	ON tbl_139_327_sub_d.Discrepancy_id = tbl_139_327_sub_d_o.disdis_id 
										INNER JOIN tbl_systemusers		ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d.Discrepancy_by_cb_int 
										WHERE tbl_139_327_sub_d_o.disinspection_id = '".$inspectionid."' ";
								
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
																
																$ownedbyHTML_i = "
																				<tr>
																					<td colspan='2' class='tableheaderleft'>
																						<b>Also Owns Information</b>
																						</td>																						
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $ownedbyHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															
													while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {

																$ownedbyHTML = $ownedbyHTML."		
																				<tr>		
																					<td colspan='2' class='formoptions'>
																						Single Discrepancy Info
																						</td>
																					</tr>	
																				<tr>		
																					<td align='center' valign='middle' class='formresults'>
																						ID
																						</td>
																					<td class='formresults'>
																						<a href='".$webroot."part139327_discrepancy_report_display.php?recordid=".$objarray2['Discrepancy_id']."' target='_newreportwindowd'>".$objarray2['Discrepancy_id']."</a>
																						</td>
																					</tr>																					
																				<tr>		
																					<td align='center' valign='middle' class='formresults'>
																						Date / Time
																						</td>
																					<td class='formresults'>".
																						$objarray2['Discrepancy_date']." / ".$objarray2['Discrepancy_time']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formresults'>
																						Error Reported By
																						</td>
																					<td class='formresults'>".
																						$objarray2['emp_firstname']." ".$objarray2['emp_lastname']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formresults'>
																						Name
																						</td>
																					<td class='formresults'>".
																						$objarray2['Discrepancy_name']." 
																						</td>
																					</tr>																					
																				<tr>		
																					<td align='center' valign='middle' class='formresults'>
																						Comments
																						</td>
																					<td class='formresults'>".
																						$objarray2['discrepancy_remarks']." 
																						</td>
																					</tr>
																				";
															}
													}
											}
										if($returnhtml == 0) {
												// Just display the results now
												echo $ownedbyHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}		
									}										
									
								if($display_archived == 1) {

										// Display all Repaired Information
										$sql2 = "SELECT * FROM tbl_139_327_main_a 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_327_main_a.inspection_archived_by_cb_int 
										WHERE inspection_archived_inspection_id = '".$inspectionid."' AND inspection_archived_yn = 1 
										ORDER BY inspection_archived_date,inspection_archived_time";
										
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
																					<td colspan='2' class='tableheaderleft'>
																						<b>Archieved Information</b>
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
																					<td align='center' valign='middle' class='formoptions'>
																						Date / Time
																						</td>
																					<td class='formanswers'>".
																						$objarray2['inspection_archived_date']." / ".$objarray2['inspection_archived_time']."
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Repaired By
																						</td>
																					<td class='formanswers'>".
																						$objarray2['emp_firstname']." ".$objarray2['emp_lastname']."
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Comments
																						</td>
																					<td class='formanswers'>".
																						$objarray2['inspection_archived_reason']." 
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
										$sql2 = "SELECT * FROM tbl_139_327_main_e 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_327_main_e.inspection_error_by_cb_int 
										WHERE inspection_error_inspection_id = '".$inspectionid."' AND inspection_error_yn = 1  
										ORDER BY inspection_error_date,inspection_error_time";
										
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
																					<td colspan='2' class='tableheaderleft'>
																						<b>Error Information</b>
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
																					<td align='center' valign='middle' class='formoptions'>
																						Date / Time
																						</td>
																					<td class='formanswers'>".
																						$objarray2['inspection_error_date']." / ".$objarray2['inspection_error_time']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Error Reported By
																						</td>
																					<td class='formanswers'>".
																						$objarray2['emp_firstname']." ".$objarray2['emp_lastname']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Comments
																						</td>
																					<td class='formanswers'>".
																						$objarray2['inspection_error_reason']." 
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
				$return_string = $table_i."".$basicHTML."".$checklistHTML_i."".$checklistHTML."".$discrepHTML_i."".$discrepHTML."".	$ownedbyHTML_i."".$ownedbyHTML."".$archievedHTML_i."".$archievedHTML."".$errorHTML_i."".$errorHTML."".$table_o."";
				return $return_string;
			}			
	}
	?>