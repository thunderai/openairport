<?php
function _303_c_display_report_summary($discrepancyid = 0,$detail_level = 0,$returnhtml = 0) {
		// Display Discrepancy Summary
		// Detail Level:
		//					0 : Name and Remark
		//					1 : All Local Table Values
		//					2 : Everything!!!! (1,3,4,5,6,7,8,etc...)
		//					3 : 1 + Archieved
		//					4 : 1 + Error
		//					5 : 1 + Student List
		//					6 : 1 + Topic Notes
		//					7 : 1 + Checklist Items
		
		$display_basic 		= 0;
		$display_extended 	= 0;
		$display_archived	= 0;
		$display_error		= 0;
		$display_student	= 0;
		$display_topicnotes	= 0;
		$display_checklists	= 0;

		$webroot			= "http://localhost/openairportv3_lcars/";
		
		if($detail_level == 0) {
				$display_basic 		= 1;
				$display_extended 	= 0;
				$display_archived	= 0;
				$display_error		= 0;
				$display_student	= 0;
				$display_topicnotes	= 0;
				$display_checklists	= 0;
		
			}
		if($detail_level == 1) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_archived	= 0;
				$display_error		= 0;
				$display_student	= 0;
				$display_topicnotes	= 0;
				$display_checklists	= 0;
			}			
		if($detail_level == 2) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_archived	= 1;
				$display_error		= 1;
				$display_student	= 1;
				$display_topicnotes	= 1;
				$display_checklists	= 1;
		
			}
		if($detail_level == 3) {
				$display_basic 		= 1;
				$display_extended 	= 0;
				$display_archived	= 1;
				$display_error		= 0;
				$display_student	= 0;
				$display_topicnotes	= 0;
				$display_checklists	= 0;
		
			}			
		if($detail_level == 4) {
				$display_basic 		= 1;
				$display_extended 	= 0;
				$display_archived	= 0;
				$display_error		= 1;
				$display_student	= 0;
				$display_topicnotes	= 0;
				$display_checklists	= 0;
				
			}	
		if($detail_level == 5) {
				$display_basic 		= 1;
				$display_extended 	= 0;
				$display_archived	= 0;
				$display_error		= 0;
				$display_student	= 1;
				$display_topicnotes	= 0;
				$display_checklists	= 0;
				
			}
		if($detail_level == 6) {
				$display_basic 		= 1;
				$display_extended 	= 0;
				$display_archived	= 0;
				$display_error		= 0;
				$display_student	= 0;
				$display_topicnotes	= 1;
				$display_checklists	= 0;
				
			}		
		if($detail_level == 7) {
				$display_basic 		= 1;
				$display_extended 	= 0;
				$display_archived	= 0;
				$display_error		= 0;
				$display_student	= 0;
				$display_topicnotes	= 0;
				$display_checklists	= 1;
				
			}			
			
		$sql 	= "SELECT * FROM tbl_139_303_c_main
					INNER JOIN tbl_systemusers			ON tbl_systemusers.emp_record_id = tbl_139_303_c_main.139_303_by_cb_int
					INNER JOIN tbl_139_303_c_sub_t		ON tbl_139_303_c_sub_t.inspection_type_id = tbl_139_303_c_main.139_303_type_cb_int ";
		
		if($discrepancyid == 0) {
				// No discrepancy is defined, find all
			}
			else {
				// Use the specific entry
				$sql = $sql."WHERE 139_303_id = '".$discrepancyid."' ";
			}
		
		//echo $sql;
		$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		if($returnhtml == 0) {
				// Just display the results now
				echo "<table width='100%' cellpadding='1' cellspacing='1' border='0' />";
	}
			else {
				// DO NOT display anything YET!!!!!
				$table_i = "<table width='100%' cellpadding='1' cellspacing='1' border='0' />";
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
						
								//$discrepancyid = $objarray['emp_record_id'];
								
								$basicHTML = "
												<tr>		
													<td class='table_dashpanel_container_summary_rowheader'>	
														ID
														</td>
													<td class='table_dashpanel_container_summary_rowresult'>
														<a class='table_dashpanel_container_summary_link' href='#' onclick='openmapchild(&quot;part139303_c_report_display.php?recordid=".$discrepancyid."&quot;,&quot;SummaryWindow&quot;)'; />".$discrepancyid."</a>
														</td>
													</tr>
												<tr>		
													<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
														First / Last  (initials)
														</td>
													<td class='table_dashpanel_container_summary_rowresult'>".
														$objarray['emp_firstname']." / ".$objarray['emp_lastname']." (".$objarray['emp_initials'].") 
														</td>
													</tr>
												<tr>		
													<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
														Type of Class
														</td>
													<td class='table_dashpanel_container_summary_rowresult'>".
														$objarray['inspection_type']." 
														</td>
													</tr>													
													";

								if($returnhtml == 0) {
										// Just display the results now
										echo $basicHTML;
									}
									else {
										// DO NOT display anything YET!!!!!
									}

								if($display_extended == 1) {
							
										$extendedHTML = "
														<tr>
															<td colspan='2' class='table_dashpanel_container_summary_header'>
																Extended Information
																</td>
															</tr>									
														<tr>		
															<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																Date
																</td>
															<td class='table_dashpanel_container_summary_rowresult'>".
																$objarray['139_303_date']."
																</td>
															</tr>
														<tr>		
															<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																Time
																</td>
															<td class='table_dashpanel_container_summary_rowresult'>".
																$objarray['139_303_time']."
																</td>
															</tr>
														<tr>		
															<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																Attendance Sheet
																</td>
															<td class='table_dashpanel_container_summary_rowresult'>".
																$objarray['139_303_attendance']." 
																</td>
															</tr>	
														<tr>		
															<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																Sylabus Sheet(s)
																</td>
															<td class='table_dashpanel_container_summary_rowresult'>".
																$objarray['139_303_sylabus']."
																</td>
															</tr>															
															";

										if($returnhtml == 0) {
												// Just display the results now
												echo $extendedHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}								
									}
								
								if($display_archived == 1) {	

										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_303_c_main_a 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_303_c_main_a.139303_c_a_by_cb_int   
										WHERE 139303_c_a_inspection_id = '".$discrepancyid."' 
										ORDER BY 139303_c_a_date,139303_c_a_time";
										
										//echo $sql2;
										
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
																
																$archievedHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Archived Information
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $archievedHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															else {
															
																$archievedHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Archived Information
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_rowresult'>
																						There are no records to display
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $archievedHTML_i;
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
																						$objarray2['139303_c_a_date']." / ".$objarray2['139303_c_a_time']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Archieved By
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
																						$objarray2['139303_c_a_reason']." 
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
										$sql2 = "SELECT * FROM tbl_139_303_c_main_e 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_303_c_main_e.139303_c_e_by_cb_int  
										WHERE 139303_c_e_inspection_id = '".$discrepancyid."' 
										ORDER BY 139303_c_e_date,1393903_c_e_time";
										
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
																		echo $archievedHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															else {
															
																$errorHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Error Information
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_rowresult'>
																						There are no records to display
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
														
																$archivedHTML = $errorHTML."
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Date / Time
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['139303_c_e_date']." / ".$objarray2['139303_c_e_time']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Archieved By
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
																						$objarray2['139303_c_e_reason']." 
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
								if($display_student == 1) {	

										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_303_c_sub_sa 
										INNER JOIN tbl_systemusers 			ON tbl_systemusers.emp_record_id = tbl_139_303_c_sub_sa.discrepancy_student_cb_int 
										WHERE tbl_139_303_c_sub_sa.Discrepancy_inspection_id = '".$discrepancyid."' 
										ORDER BY emp_lastname,emp_firstname";
										
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
																
																$studentHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Student Information
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $studentHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															else {
															
																$studentHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Student Information
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_rowresult'>
																						There are no records to display
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $studentHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}																
															}
															
														while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	
														
																$studentHTML = $studentHTML."
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Student Name
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['emp_lastname'].", ".$objarray2['emp_firstname']." (".$objarray2['emp_initials'].") 
																						</td>
																					</tr>
																				";
															}
													}
											}
										if($returnhtml == 0) {
												// Just display the results now
												echo $studentHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}
									}
									
								if($display_topicnotes == 1) {	

										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_303_c_sub_d 
										WHERE Discrepancy_inspection_id = '".$discrepancyid."' 
										ORDER BY Discrepancy_name";
										
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
																
																$topicHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Topic Notes
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $topicHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															else {
															
																$topicHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Topic Notes
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_rowresult'>
																						There are no records to display
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $topicHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}																
															}
															
														while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	
														
																$topicHTML = $topicHTML."
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Name of Topic
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['Discrepancy_name']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Remarks
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['discrepancy_remarks']." 
																						</td>
																					</tr>	
																				";
															}
													}
											}
										if($returnhtml == 0) {
												// Just display the results now
												echo $topicHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}
									}
									
								if($display_checklists == 1) {	

										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_303_c_sub_c_c 
										INNER JOIN tbl_139_303_c_sub_c		ON tbl_139_303_c_sub_c.conditions_id = tbl_139_303_c_sub_c_c.conditions_checklists_condition_cb_int 
										INNER JOIN tbl_139_303_c_sub_c_f	ON tbl_139_303_c_sub_c_f.facility_id = tbl_139_303_c_sub_c.condition_facility_cb_int 	
										WHERE tbl_139_303_c_sub_c_c.conditions_checklists_inspection_cb_int = '".$discrepancyid."' 
										ORDER BY facility_name";
										
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
																						Checklist Items
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
															else {
															
																$checklistHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Checklist Items
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_rowresult'>
																						There are no records to display
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
														
																$checklistHTML = $checklistHTML."
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Facility
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['facility_name']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Condition
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['condition_name']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Training Time
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['conditions_checklist_hours']." MInutes
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
				$return_string = $table_i."".$basicHTML."".$extendedHTML."".$archievedHTML_i."".$archievedHTML."".$errorHTML_i."".$errorHTML."".$studentHTML_i."".$studentHTML."".$topicHTML_i."".$topicHTML."".$checklistHTML_i."".$checklistHTML."".$table_o."";
				return $return_string;
			}			
	}
	?>