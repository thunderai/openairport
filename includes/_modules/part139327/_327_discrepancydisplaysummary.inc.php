<?php
function display_discrepancy_summary($discrepancyid = 0,$detail_level = 0,$returnhtml = 0) {
		// Display Discrepancy Summary
		// Detail Level:
		//					0 : Name and Remark
		//					1 : All Local Table Values
		//					2 : Everything!!!! (1,3,4,5,6,7,8)
		//					3 : 1 + Bounced
		//					4 : 1 + Repaired
		//					5 : 1 + Archived
		//					6 : 1 + Duplicate
		//					7 : 1 + Error
		//					8 : 1 + Owned
		
		$display_basic 		= 0;
		$display_extended 	= 0;
		$display_repaired 	= 0;
		$display_bounced 	= 0;
		$display_archived 	= 0;
		$display_duplicate 	= 0;	
		$display_error 		= 0;		
		$display_ownedby 	= 0;
		
				$webroot			= "http://localhost/openairportv3t/";
		
		if($detail_level == 0) {
				$display_basic 		= 1;
		
			}
		if($detail_level == 1) {
				$display_basic 		= 1;
				$display_extended 	= 1;

			}			
		if($detail_level == 2) {
				$display_basic 		= 1;
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_repaired 	= 1;
				$display_bounced 	= 1;
				$display_archived 	= 1;
				$display_duplicate 	= 1;	
				$display_error 		= 1;		
				$display_ownedby 	= 1;		
			}			
		if($detail_level == 3) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_bounced 	= 1;		
			}		
		if($detail_level == 4) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_repaired 	= 1;	
			}
		if($detail_level == 5) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_archived	= 1;				
			}	
		if($detail_level == 6) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_duplicate 	= 1;				
			}		
		if($detail_level == 7) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_error  	= 1;				
			}				
		if($detail_level == 8) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_ownedby  	= 1;				
			}	
			
			
			
		$sql 		= "SELECT * FROM tbl_139_327_sub_d 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d.Discrepancy_by_cb_int 
		INNER JOIN tbl_139_327_main 	ON tbl_139_327_main.inspection_system_id = tbl_139_327_sub_d.Discrepancy_inspection_id 
		INNER JOIN tbl_139_327_sub_t 	ON tbl_139_327_sub_t.inspection_type_id = tbl_139_327_main.type_of_inspection_cb_int 
		INNER JOIN tbl_139_327_sub_c 	ON tbl_139_327_sub_c.conditions_id = tbl_139_327_sub_d.discrepancy_checklist_id  
		INNER JOIN tbl_139_327_sub_c_f 	ON tbl_139_327_sub_c_f.facility_id = tbl_139_327_sub_c.condition_facility_cb_int 
		INNER JOIN tbl_general_conditions ON tbl_general_conditions.general_condition_id = tbl_139_327_sub_d.discrepancy_priority ";
		
		if($discrepancyid == 0) {
				// No discrepancy is defined, find all
			}
			else {
				// Use the specific entry
				$sql = $sql."WHERE Discrepancy_id = '".$discrepancyid."' ";
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
						
								$discrepancyid = $objarray['Discrepancy_id'];
								
								$basicHTML = "
												<tr>
													<td colspan='2' class='tableheaderleft'>
														<b>Basic Information</b>
														</td>
													</tr>
												<tr>		
													<td align='center' valign='middle' class='formoptions'>
														ID
														</td>
													<td class='formanswers'>
															<a href='".$webroot."part139327_discrepancy_report_display.php?recordid=".$discrepancyid."' target='_newreportwindowd'>".$discrepancyid."</a>
														</td>
													</tr>													
												<tr>		
													<td align='center' valign='middle' class='formoptions'>
														Name
														</td>
													<td class='formanswers'>".
														$objarray['Discrepancy_name']."
														</td>
													</tr>
												<tr>		
													<td align='center' valign='middle' class='formoptions'>
														Description
														</td>
													<td class='formanswers'>".
														$objarray['discrepancy_remarks']."
														</td>
													</tr>";

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
															<td colspan='2' class='tableheaderleft'>
																<b>Extended Information</b>
																</td>
															</tr>									
														<tr>		
															<td align='center' valign='middle' class='formoptions'>
																Entered Durring Inspection ID
																</td>
															<td class='formanswers'>".
																$objarray['Discrepancy_inspection_id'].":".$objarray['inspection_type']."
																</td>
															</tr>
														<tr>		
															<td align='center' valign='middle' class='formoptions'>
																Facility / Condition
																</td>
															<td class='formanswers'>".
																$objarray['facility_name']." / ".$objarray['condition_name']." 
																</td>
															</tr>
														<tr>		
															<td align='center' valign='middle' class='formoptions'>
																Recorded By
																</td>
															<td class='formanswers'>".
																$objarray['emp_firstname']." ".$objarray['emp_lastname']." 
																</td>
															</tr>									
														<tr>		
															<td align='center' valign='middle' class='formoptions'>
																Date / Time
																</td>
															<td class='formanswers'>".
																$objarray['Discrepancy_date']." / ".$objarray['Discrepancy_time']." 
																</td>
															</tr>		
														<tr>		
															<td align='center' valign='middle' class='formoptions'>
																Priority
																</td>
															<td class='formanswers'>".
																$objarray['general_condition_priority']." 
																</td>
															</tr>
														<tr>		
															<td align='center' valign='middle' class='formoptions'>
																Location
																</td>
															<td class='formanswers'>
																X:".$objarray['Discrepancy_location_x'].", Y:".$objarray['Discrepancy_location_y']." 
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
								
								if($display_repaired == 1) {

										// Display all Repaired Information
										$sql2 = "SELECT * FROM tbl_139_327_sub_d_r 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d_r.discrepancy_repaired_by_cb_int 
										WHERE discrepancy_repaired_inspection_id = '".$discrepancyid."' AND discrepancy_repaired_archived_yn = 0 
										ORDER BY discrepancy_repaired_date,discrepancy_repaired_time";
										
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
																
																$repairedHTML_i = "
																				<tr>
																					<td colspan='2' class='tableheaderleft'>
																						<b>Repaired Information</b>
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $repairedHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															else {
															
																$repairedHTML_i = "
																				<tr>
																					<td colspan='2' class='tableheaderleft'>
																						<b>Repaired Information</b>
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='formanswers'>
																						<b>There are no records to display</b>
																						</td>
																					</tr>																					
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $repairedHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}															
															}
															
														while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {

																$repairedHTML = $repairedHTML."
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Date / Time
																						</td>
																					<td class='formanswers'>".
																						$objarray2['discrepancy_repaired_date']." / ".$objarray2['discrepancy_repaired_time']."
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
																						$objarray2['discrepancy_repaired_comments']." 
																						</td>
																					</tr>
																				";
															}
													}
											}
										if($returnhtml == 0) {
												// Just display the results now
												echo $repairedHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}		
									}
									
								if($display_bounced == 1) {	

										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_327_sub_d_b 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d_b.discrepancy_bounced_by_cb_int 
										WHERE discrepancy_bounced_inspection_id = '".$discrepancyid."' AND discrepancy_bounced_archived_yn = 0 
										ORDER BY discrepancy_bounced_date,discrepancy_bounced_time";
										
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
																
																$bouncedHTML_i = "
																				<tr>
																					<td colspan='2' class='tableheaderleft'>
																						<b>Bounced Information</b>
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $bouncedHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															else {
															
																$bouncedHTML_i = "
																				<tr>
																					<td colspan='2' class='tableheaderleft'>
																						<b>Bounced Information</b>
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='formanswers'>
																						<b>There are no records to display</b>
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $bouncedHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}															
															}
															
														while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
														
																$bouncedHTML = $bouncedHTML."
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Date / Time
																						</td>
																					<td class='formanswers'>".
																						$objarray2['discrepancy_bounced_date']." / ".$objarray2['discrepancy_bounced_time']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Bounced By
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
																						$objarray2['discrepancy_bounced_comments']." 
																						</td>
																					</tr>
																				";
															}
													}
											}	
										if($returnhtml == 0) {
												// Just display the results now
												echo $bouncedHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}
									}
									
								if($display_archived == 1) {	

										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_327_sub_d_a 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d_a.discrepancy_archieved_by_cb_int 
										WHERE discrepancy_archeived_inspection_id = '".$discrepancyid."' AND discrepancy_archieved_yn = 0 
										ORDER BY discrepancy_archieved_date,discrepancy_archieved_time";
										
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
																					<td colspan='2' class='tableheaderleft'>
																						<b>Archived Information</b>
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
															else {
															
																$archievedHTML_i = "
																				<tr>
																					<td colspan='2' class='tableheaderleft'>
																						<b>Archived Information</b>
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='formanswers'>
																						<b>There are no records to display</b>
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
																						$objarray2['discrepancy_archieved_date']." / ".$objarray2['discrepancy_archieved_time']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Bounced By
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
																						$objarray2['discrepancy_archieved_reason']." 
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

								if($display_duplicate == 1) {	

										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_327_sub_d_d 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d_d.discrepancy_duplicate_by_cb_int 
										WHERE discrepancy_duplicate_inspection_id = '".$discrepancyid."' AND discrepancy_duplicate_yn = 0 
										ORDER BY discrepancy_duplicate_date,discrepancy_duplicate_time";
										
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
																
																$duplicateHTML_i = "
																				<tr>
																					<td colspan='2' class='tableheaderleft'>
																						<b>Duplicate Information</b>
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $duplicateHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															else {
															
																	$duplicateHTML_i = "
																				<tr>
																					<td colspan='2' class='tableheaderleft'>
																						<b>Duplicate Information</b>
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='formanswers'>
																						<b>There are no records to display</b>
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $duplicateHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}															
															}
															
														while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	
														
																$duplicateHTML = $duplicateHTML."
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Date / Time
																						</td>
																					<td class='formanswers'>".
																						$objarray2['discrepancy_duplicate_date']." / ".$objarray2['discrepancy_duplicate_time']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Bounced By
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
																						$objarray2['discrepancy_duplicate_reason']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Duplicate of
																						</td>
																					<td class='formanswers'>".
																						$objarray2['discrepancy_duplicate_number']." 
																						</td>
																					</tr>
																				";
															}
													}
											}	
										if($returnhtml == 0) {
												// Just display the results now
												echo $duplicateHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}
									}					
									
								if($display_error == 1) {	

										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_327_sub_d_e 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d_e.discrepancy_error_by_cb_int 
										WHERE discrepancy_error_inspection_id = '".$discrepancyid."' AND discrepancy_error_yn = 0 
										ORDER BY discrepancy_error_date,discrepancy_error_time";
										
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
															else {
															
																$errorHTML_i = "
																				<tr>
																					<td colspan='2' class='tableheaderleft'>
																						<b>Error Information</b>
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='formanswers'>
																						<b>There are no records to display</b>
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
																						$objarray2['discrepancy_error_date']." / ".$objarray2['discrepancy_error_time']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='formoptions'>
																						Bounced By
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
																						$objarray2['discrepancy_error_reason']." 
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
									
								if($display_ownedby == 1) {	

										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_327_sub_d_o 
										WHERE disdis_id = '".$discrepancyid."' AND dishidden_yn = 0 
										ORDER BY disinspection_id,disdis_id";
										
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
																						<b>Owned By Information</b>
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
															else {
															
																$ownedbyHTML_i = "
																				<tr>
																					<td colspan='2' class='tableheaderleft'>
																						<b>Owned By Information</b>
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='formanswers'>
																						<b>There are no records to display</b>
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
																					<td align='center' valign='middle' class='formoptions'>
																						Inspection ID
																						</td>
																					<td class='formanswers'>
																						<a href='".$webroot."part139327_report_display_new.php?recordid=".$objarray2['disinspection_id']."' target='_newreportwindow'>".$objarray2['disinspection_id']."</a>
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
				$return_string = $table_i."".$basicHTML."".$extendedHTML."".$repairedHTML_i."".$repairedHTML."".$bouncedHTML_i."".$bouncedHTML."".$ownedbyHTML_i."".$ownedbyHTML."".$archievedHTML_i."".$archievedHTML."".$duplicateHTML_i."".$duplicateHTML."".$errorHTML_i."".$errorHTML."".$table_o."";
				return $return_string;
			}			
	}
	?>