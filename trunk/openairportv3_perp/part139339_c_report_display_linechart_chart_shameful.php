<?php 
		$sql = "SELECT * FROM tbl_139_339_sub_c_c 
		INNER JOIN tbl_139_339_sub_c	ON tbl_139_339_sub_c.139339_c_id 	= tbl_139_339_sub_c_c.139339_cc_c_cb_int 
		INNER JOIN tbl_139_339_sub_c_f	ON tbl_139_339_sub_c_f.139339_f_id	= tbl_139_339_sub_c.139339_c_facility_cb_int 
		INNER JOIN tbl_139_339_sub_t	ON tbl_139_339_sub_t.139339_type_id	= tbl_139_339_sub_c.139339_c_type_cb_int 
		INNER JOIN tbl_139_339_main		ON tbl_139_339_main.139339_main_id	= tbl_139_339_sub_c_c.139339_cc_ficon_cb_int 
		WHERE tbl_139_339_sub_c.139339_cc_type = 0 
				AND tbl_139_339_sub_c_f.139339_f_id = ".$facility_id." ".$msql_s." 
				AND tbl_139_339_main.139339_date 	>=	'".$use_start_date."'  
				AND tbl_139_339_main.139339_date 	<= '".$use_end_date."'  	
				
		ORDER BY 139339_f_name, 139339_c_name, 139339_cc_xloc, 139339_date";
		
		
		//echo $sql;
		
		
		$running_total 	= 0;
		$i				= 0;
		$previous_c_id	= 0;					// Is the current condition the same as the last one?
		$interal_loop	= 0;
		$external_loop	= -1;

		$muarray		= array();
		$muarray_s		= array();
		$muarray_d		= array();
		$isrunway		= array();
		
		$wasarunway		= 0;
		$has_run		= 0;
		
		$lineheight		= 0;					// What is the hight of the table
		$lineheightrate = 4.85410197;			// what is the ratio of height to max value?
		$linemultiplyer = 3;					// How large should bars be adjusted?
		$bar			= 0;					// Image of the bar colum in bar chart
		
		$array_of_settings = array($use_start_date,$use_end_date,$lineheightrate,$linemultiplyer);	
		
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
						
						//echo "<br>-----------------------------<br>";

						while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
								
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

								$checklist_item_id		= $objfields['139339_cc_id'];				// ID of the checklist item
								$checklist_item_disc	= $objfields['139339_cc_d_yn'];				// Value of the discrepancy (could be Mu value, a surface description, or a checkbox toggle).
								
								$main_id				= $objfields['139339_main_id'];
								$main_time				= $objfields['139339_time'];
								$main_date				= $objfields['139339_date'];
								
								
								// Special variables due to spacing issues
								$condition_name_str		= str_replace(" ","",$condition_name);
								
								
										// Is this the same facility we just displayed?
										// Keep doing whatever we were doing
										
										// Is this a runway?
										//	if it is, it will have nine friction values that we will need to sort.
										//	runway facility is stored in var " 139339_f_rwy_yn " with a value of 1
										
										//	runway type is stored in var " 139339_c_type_cb_int " with a value of 1
										
										if($checklist_item_disc == 0 OR $checklist_item_disc == "") {
												if($include_0 == 1) {
														$include = 1;
													}
													else {
														$include = 0;
													}
													
											}
										if($checklist_item_disc >= 40 ) {
												if($include_40 == 1) {
														$include = 1;
													}
													else {
														$include = 0;
													}
											}
										
										if($facility_is_runway == 1) {
												$wasarunway	= 1;
												$has_run	= 1;
												// This is a runway do runway sorting procedures
												//echo "This is a runway <br>";
												// General thoughts:
												// Loop through the facility
												// Store all variables for the same condition name, then loop reset for the next name
												//	Store next condition in another array
												// Facity is : 139339_f_id
												if($include == 1) {
														if($condition_id == $previous_c_id) {
																// This is the same condition as last time
																// display only the Mu value field
																//echo "Condition ID: ".$condition_id." ";
																//echo "Mu Value: ".$checklist_item_disc." ";
																//echo "I Loop #: ".$interal_loop." ";
																//echo "E Loop #: ".$external_loop." ";
																//echo "Previous ID: ".$previous_c_id."<br>";
																
																$interal_loop 	= $interal_loop + 1;
														}
														else {
																// The condition is different
																// Display all fields
													
																$previous_c_id 	= $condition_id;
																$interal_loop 	= 0;
																$external_loop	= $external_loop + 1;
																
																//echo "---------------------<br>";
																//echo "Facility Name: ".$facility_name.", Condition Name: ".$condition_name_str.", I Loop #: ".$interal_loop.", E Loop #: ".$external_loop." Mu Value: ".$checklist_item_disc." <br>";
																
																
																
														}
														
														//echo "<br> SAVE DATA----------------------<br>";
														//echo "Condition ID: ".$condition_id." ";
														//echo "Mu Value: ".$checklist_item_disc." ";
														//echo "I Loop #: ".$interal_loop." ";
														//echo "E Loop #: ".$external_loop." ";
														//echo "Previous ID: ".$previous_c_id."<br>";
																
														$muarray_s[0]								= $facility_id;
														
														$muarray_d[$external_loop][$interal_loop]	= $main_date;
														$muarray_t[$external_loop][$interal_loop]	= $main_time;
														$muarray_i[$external_loop][$interal_loop]	= $main_id;
														
														$isrunway[$external_loop][$interal_loop] 	= $checklist_item_disc;
														
														//$interal_loop 	= $interal_loop + 1;
												}

										
										}
										else {
											$wasarunway	= 0;
											$has_run	= 1;
												// This is not a runway.  Assumption is that it must be a taxiway or ramp. 
												
												$tmpcondnamestr			= str_replace(" ","",$tmpcondname);
												
												switch ($condition_field_type) {
													case 0:
															
															
															if($include == 1) {
																										
																	//echo $objfields["139339_cc_d_yn"];
																	$running_total 	= $running_total + $checklist_item_disc;
																	$muarray[$i] 	= $checklist_item_disc;
																	
																	$muarray_d[$i]	= $main_date;
																	$muarray_t[$i]	= $main_time;
																	
																	$muarray_s[0]	= $facility_id;
																	$muarray_i[$i]	= $main_id;
																	
																	//echo "<br> Array ".$muarray[$i]."<br>";
																	
																	$i = $i + 1;
																}
															
															
															break;

													}
													
										}	// END OF IS THIS A RUNWAY TEST...
									
	
								$include		= 1;
								//$external_loop	= $external_loop + 1;
								//$previous_c_id 	= $condition_id;
								
								$previous_facility_id = $facility_id;
								
								
						}


				}
				else {
					echo "Test";
				}
		}

		if($wasarunway	== 1) {

				drawarunway($isrunway,$array_of_settings,$muarray_s,$muarray_d,$muarray_t,$muarray_i);
		}
		else {
				drawnotarunway($muarray,$array_of_settings,$muarray_s,$muarray_d,$muarray_t,$muarray_i);
		}

?>	