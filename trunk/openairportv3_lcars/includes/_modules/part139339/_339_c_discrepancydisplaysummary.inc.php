<?php
function display_anomaly_summary($discrepancyid = 0,$detail_level = 0,$returnhtml = 0) {
		// Display Discrepancy Summary
		// Detail Level:
		//					0 : Name and Remark
		//					1 : All Local Table Values
		//					2 : Everything!!!! (1,3,4,5,6,7,8)
		
		$display_basic 		= 0;
		$display_extended 	= 0;
		$display_repaired 	= 0;
		$display_bounced 	= 0;
		$display_closed		= 0;
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
				$display_closed		= 1;
				$display_archived 	= 1;
				$display_duplicate 	= 1;	
				$display_error 		= 1;		
				$display_ownedby 	= 1;		
			}			

			
		$sql 		= "SELECT * FROM tbl_139_339_sub_d 
		INNER JOIN tbl_systemusers 			ON tbl_systemusers.emp_record_id 		= tbl_139_339_sub_d.Discrepancy_by_cb_int 
		INNER JOIN tbl_139_339_main 		ON tbl_139_339_main.139339_main_id 		= tbl_139_339_sub_d.Discrepancy_inspection_id 
		
		INNER JOIN tbl_139_339_sub_c_c		ON tbl_139_339_sub_c_c.139339_cc_ficon_cb_int = tbl_139_339_main.139339_main_id 
		INNER JOIN tbl_139_339_sub_c 		ON tbl_139_339_sub_c.139339_c_id 		= tbl_139_339_sub_c_c.139339_cc_c_cb_int 
		INNER JOIN tbl_139_339_sub_c_f 		ON tbl_139_339_sub_c_f.139339_f_id 		= tbl_139_339_sub_c.139339_c_facility_cb_int  
		
		INNER JOIN tbl_139_339_sub_t 		ON tbl_139_339_sub_t.139339_type_id		= tbl_139_339_main.139339_type_cb_int 
		INNER JOIN tbl_general_conditions 	ON tbl_general_conditions.general_condition_id = tbl_139_339_sub_d.discrepancy_priority ";
		
		
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
						
								$discrepancyid = $objarray['Discrepancy_id'];
								
								$basicHTML = "
												<tr>
													<td colspan='2' class='formoptionsavilabletop'>
														<font size='1'><b>Basic Information</b></font>
														</td>
													</tr>
												<tr>		
													<td align='center' valign='middle' class='formoptions'>
														ID
														</td>
													<td class='formanswers'>
															<a href='part139339_c_discrepancy_report_display.php?recordid=".$discrepancyid."' target='_newreportwindowd'>".$discrepancyid."</a>
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
																$objarray['Discrepancy_inspection_id'].":".$objarray['139339_type']."
																</td>
															</tr>
														<tr>		
															<td align='center' valign='middle' class='formoptions'>
																Facility / Condition
																</td>
															<td class='formanswers'>".
																$objarray['139339_f_name']." / ".$objarray['139339_c_name']." 
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
				$return_string = $table_i."".$basicHTML."".$extendedHTML."".$repairedHTML_i."".$repairedHTML."".$bouncedHTML_i."".$bouncedHTML."".$closedHTML_i."".$closedHTML."".$ownedbyHTML_i."".$ownedbyHTML."".$archievedHTML_i."".$archievedHTML."".$duplicateHTML_i."".$duplicateHTML."".$errorHTML_i."".$errorHTML."".$table_o."";
				return $return_string;
			}			
	}
	?>