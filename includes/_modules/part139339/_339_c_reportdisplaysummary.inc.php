<?php
function _339_c_display_report_summary($inspectionid = 0,$detail_level = 0,$returnhtml = 0) {
		// Display Discrepancy Summary
		// Detail Level:
		//					0 : Name and Remark
		//					1 : All Local Table Values   <--- NOT DEFINED, useless
		//					2 : Everything!!!! (1,3,4,5,6,7,8)
		//					3 : 0 + Archieved
		//					4 : 0 + Error
		//					5 : 0 + Checklist items
		//					6 : 0 + Discrepancies
		//					7 : 0 + Also Owned By		<--- NOT DEFINED, useless
		
		
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
				
			
		$sql 		= "SELECT * FROM tbl_139_339_main 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_339_main.139339_by_cb_int 
		INNER JOIN tbl_139_339_sub_t 	ON tbl_139_339_sub_t.139339_type_id = tbl_139_339_main.139339_type_cb_int ";
		
		if($inspectionid == 0) {
				// No discrepancy is defined, find all
			}
			else {
				// Use the specific entry
				$sql = $sql."WHERE 139339_main_id = '".$inspectionid."' ";
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
						
								//$inspectionid = $objarray['inspection_system_id'];
								
								$basicHTML = "
												<tr>
													<td colspan='2' class='formoptionsavilabletop'>
														<font size='1'><b>Basic Information</b></font>
														</td>
													</tr>
												<tr>		
													<td class='formoptions'>
														ID
														</td>
													<td class='formanswers'>
															<a href='part139339_c_report_display_new.php?recordid=".$inspectionid."' target='_newreportwindowd'>".$inspectionid."</a>
														</td>
													</tr>
												<tr>		
													<td class='formoptions'>
														Date / Time 
														</td>
													<td class='formanswers'>".
														$objarray['139339_date']." / ".$objarray['139339_time']." 
														</td>
													</tr>													
												<tr>		
													<td class='formoptions'>
														Type
														</td>
													<td class='formanswers'>".
														$objarray['139339_type']." (".$objarray['139339_type_short_name'].") 
														</td>
													</tr>
												<tr>		
													<td class='formoptions'>
														Inspection By 
														</td>
													<td class='formanswers'>".
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
										$sql2 = "SELECT * FROM tbl_139_339_sub_c_c 										
										INNER JOIN tbl_139_339_sub_c 	ON tbl_139_339_sub_c.139339_c_id = tbl_139_339_sub_c_c.139339_cc_c_cb_int  
										INNER JOIN tbl_139_339_sub_c_f 	ON tbl_139_339_sub_c_f.139339_f_id = tbl_139_339_sub_c.139339_c_facility_cb_int  
										WHERE tbl_139_339_sub_c_c.139339_cc_ficon_cb_int = ".$inspectionid." 
										ORDER BY 139339_f_name,139339_c_name";
								
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
													
																//$founddiscrepancy = $objarray2['conditions_checklist_discrepancy_yn'];
																if($objarray2['139339_cc_d_yn'] == 0) {
																		$tmp_text = "NO";
																}
																else {
																		$tmp_text = "YES";
																}
																if($objarray2['139339_cc_d_yn'] > 1) {
																		$tmp_text = $objarray2['139339_cc_d_yn'];
																}
																if($objarray2['139339_cc_d_yn'] == "") {
																		$tmp_text = "No Conditon Provided";
																}

																$checklistHTML = $checklistHTML."									
																				<tr>		
																					<td class='formresults'>".
																						$objarray2['139339_f_name']." / ".$objarray2['139339_c_name']."
																						</td>
																					<td class='formresults'>".
																						$tmp_text."
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
										$sql2 = "SELECT * FROM tbl_139_339_sub_d 									
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id =  tbl_139_339_sub_d.Discrepancy_by_cb_int 
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
																						Single Anomaly Info
																						</td>
																					</tr>	
																				<tr>		
																					<td align='center' valign='middle' class='formresults'>
																						ID
																						</td>
																					<td class='formresults'>
																						<a href='".$webroot."part139339_c_discrepancy_report_display.php?recordid=".$objarray2['Discrepancy_id']."' target='_newreportwindowd'>".$objarray2['Discrepancy_id']."</a>
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
									
								if($display_archived == 1) {

										// Display all Repaired Information
										$sql2 = "SELECT * FROM tbl_139_339_sub_a 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_339_sub_a.139339_a_by_cb_int  
										WHERE 139339_a_inspection_id = '".$inspectionid."' AND 139339_a_yn = 1 
										ORDER BY 139339_a_date, 139339_a_time";
										
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
																						$objarray2['139339_a_date']." / ".$objarray2['139339_a_time']."
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
																						$objarray2['139339_a_reason']." 
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
										$sql2 = "SELECT * FROM tbl_139_339_sub_e 
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_339_sub_e.139339_eoo_by_cb_int 
										WHERE 139339_eoo_i_id = '".$inspectionid."' AND 139339_eoo_yn = 1  
										ORDER BY 139339_eoo_date, 139339_eoo_time";
										
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
																						$objarray2['139339_eoo_date']." / ".$objarray2['139339_eoo_time']." 
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
																						$objarray2['139339_eoo_reason']." 
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