<?php 
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o		o	ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		oo		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		o o		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o 	o	o	ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  	 o	o	o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	  o	o	o	o	  o		o	o	o		o	o	o   o	  o
//	00000	0		ooooo	o		o	o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document		:	part139327_save_new_report.php
//
//	Purpose of Page			:	Save New Part139.327 Inspection
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page

// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_template/template.list.php");

// Define Variables	
		
		$navigation_page 			= 16;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 16;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures
		
// Start Procedures
	//	This will be a multi step process.
	//	1). Find the temporary inspection record by the known ID
	//		a). Place a copy of the record into the main table
	//		b). Get ID of the new record
	//	2). Find all temporary condition checklists by the known temporary inspection ID
	//		a). Place a copy of each record into the main c_c table
	//		b). ...
	//	3). Find all temporary discrepancies that were selected to be linked
	//		a). Place a copy of each record into the main _sub_d table
	//		b). Find all temporary discrepancy repair orders
	//			1). Place a copy of each record into the main tables
	//			2). ...
	//		c). Find all temporary discrepancies that were created as part of the inspection
	//			1). Place a copy of each record into the main _sub_d table
	//			2). ...
	//	4). Delete temporary records
	//		a). Delete temporary discrepancy repair records
	//		b). Delete temporary discrepancies
	//		c). Delete temporary c_c
	//		d). Delete temporary inspection
	//	5). Conduct Additional Work
	//		a). Find all Discrepancies that are currently NOT fixed and place them the 'tbl_139_327_sub_d_o' table

// Part 1:

				
		//echo "PART ONE : Find the temporary inspection record by the known temporary ID <BR>";
		
		$sql 	= "SELECT * FROM tbl_139_327_main_tmp WHERE inspection_system_id = ".$_POST['recordid']."";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		//echo "[1][a][1] This will be done by searching for this SQL Statement <font size='1'>".$sql."</font> <br>";
		
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "[1][a][2] Connection to temporary main table established <br>";	
				
				$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
				
						//echo "[1][a][2] Store temporary table values into an array for future use <br>";	
						
						$tmpinspectionarray[0] = $objfields['inspection_system_id'];
						$deletetmpinspid 	   = $objfields['inspection_system_id'];
						$tmpinspectionarray[1] = $objfields['type_of_inspection_cb_int'];
						$tmpinspectionarray[2] = $objfields['inspection_completed_by_cb_int'];
						$tmpinspectionarray[3] = $objfields['139327_date'];
						$tmpinspectionarray[4] = $objfields['139327_time'];
						$tmpinspectionarray[5] = $objfields['139327_timestamp'];
						
					}	// End of while loop
			}	// End of active object connection
		
		$sql 	= "INSERT INTO tbl_139_327_main (type_of_inspection_cb_int,inspection_completed_by_cb_int,139327_date,139327_time ) VALUES ( '".$tmpinspectionarray[1]."', '".$tmpinspectionarray[2]."', '".$tmpinspectionarray[3]."', '".$tmpinspectionarray[4]."' )";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		//echo "[1][b][1] Store temporary array values into the main table with this SQL Statement <font size='1'>".$sql."</font> <br>";
		
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			
				//echo "[1][b][2] Connection to temporary main table established <br>";
			
				$objrs 			= mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				$inspectionid 	= mysqli_insert_id($objcon);
				$last_main_id	= $inspectionid;
				
				//echo "[1][b][3] The ID of the new inspection is ".$inspectionid." <br>";
			}

// Part 2: Find all condition checklists and copy them into the main tables

		//echo "PART TWO : Find the temporary inspection condition checklists by the known temporary ID <BR>";
		
		$sql = "SELECT * FROM tbl_139_327_sub_c_c_tmp WHERE conditions_checklists_inspection_cb_int = ".$_POST['recordid']."";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		//echo "[2][a][1] This will be done by searching for this SQL Statement <font size='1'>".$sql."</font> <br>";

		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
				
				//echo "[2][a][2] Connection to temporary _c_c_tmp table established <br>";	
				
				$dccc = 0;
				
				$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
						//echo "[2][a][2] Store temporary table values into an array for future use <br>";	
						
						$tmpinspectionccarray[0] = $objfields['conditions_checklists_id'];
						$deleteccarray[$dccc]	 = $objfields['conditions_checklists_id'];
						$tmpinspectionccarray[1] = $objfields['conditions_checklists_condition_cb_int'];
						$tmpinspectionccarray[2] = $objfields['conditions_checklists_inspection_cb_int'];
						$tmpinspectionccarray[3] = $objfields['conditions_checklist_discrepancy_yn'];
								
						//echo "[2][a][3] Store temporary array values into the _c_c table <br>";	
						
						$sql2 = "INSERT INTO tbl_139_327_sub_c_c (conditions_checklists_condition_cb_int,conditions_checklists_inspection_cb_int,conditions_checklist_discrepancy_yn ) VALUES ( '".$tmpinspectionccarray[1]."', '".$inspectionid."', '".$tmpinspectionccarray[3]."' )";
						$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
						//echo "[2][a][4] This will be done by searching for this SQL Statement <font size='1'>".$sql2."</font> <br>";
		
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}		
							else {
								
								//echo "[2][a][5] Connection Established with _c_c table <br>";	
								
								$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
								$lastchkid = mysqli_insert_id($objcon2);
								
								// We need to know what ID this became for the discrepancy to use it								
								$checklistwas[$tmpinspectionccarray[0]] = $lastchkid;
								
								//echo "[2][a][6] The old condition checklist ".$tmpinspectionccarray[0]." has been added to the _c_c table as ".$lastchkid." <br>";
								
							}	// End of else statement
							
						$dccc = ($dccc + 1);	
						
					}	// End of while loop
			}	// End of active object connection
			
// Part 3: Find all linked discrepancies and copy them into the main tables	
	
		//echo "PART THREE : Find the temporary discrepancy records <BR>";
	
		$sql = "SELECT * FROM tbl_139_327_sub_d_tmp";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		//echo "[3][a][1] This will be done by searching for this SQL Statement <font size='1'>".$sql."</font> <br>";
		
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
				
				//echo "[3][a][2] : Connection Established with _sub_d_tmp table <BR>";
				
				$dd = 0;
				
				$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {	
				
						//echo "[3][a][3] : Save temporary values to an array for future use <BR>";
				
						$tmpinspectionsdarray[0]	= $objfields['Discrepancy_id'];
						$deletedidarray[$dd]		= $objfields['Discrepancy_id'];
						$tmpinspectionsdarray[1]	= $objfields['discrepancy_checklist_id'];						
						$tmpinspectionsdarray[2]	= $objfields['Discrepancy_inspection_id'];
						$tmpinspectionsdarray[3]	= $objfields['Discrepancy_by_cb_int'];
						$tmpinspectionsdarray[4]	= $objfields['Discrepancy_name'];
						$tmpinspectionsdarray[5]	= $objfields['discrepancy_remarks'];
						$tmpinspectionsdarray[6]	= $objfields['Discrepancy_date'];
						$tmpinspectionsdarray[7]	= $objfields['Discrepancy_time'];
						$tmpinspectionsdarray[8]	= $objfields['discrepancy_timestamp'];
						$tmpinspectionsdarray[9]	= $objfields['Discrepancy_location_x'];
						$tmpinspectionsdarray[10]	= $objfields['Discrepancy_location_y'];
						$tmpinspectionsdarray[11]	= $objfields['discrepancy_priority'];
						$tmpinspectionsdarray[12]	= $objfields['discrepancy_quadrent'];
						$tmpinspectionsdarray[13]	= $objfields['discrepancy_enteredonpda'];
						$tmpinspectionsdarray[14]	= $objfields['discrepancy_photo'];
						$tmpinspectionsdarray[15]	= $objfields['discrepancy_sketch'];
						$tmpinspectionsdarray[16]	= $objfields['discrepancy_signature'];
						$tmpinspectionsdarray[17]	= $objfields['Discrepancy_equipment_id'];
						
						$tmpstring	 	= (string) $tmpinspectionsdarray[0];
						$tmpa 			= $tmpstring."za";
						$tmpd			= $tmpstring."zd";
						
						//echo "[3][a][4] : Discrepancy is form field ".$tmpd." with a value of ".$_POST[$tmpd]." <BR>";
						
						if(!isset($_POST[$tmpd])) {
								// No variable exists
								$tmpdiscrepancy		= 0;
							}
							else {
								// Variable Exists
								$tmpdiscrepancy		= $_POST[$tmpd];
								}
	
						//echo "[3][a][5] : Will Discrepancy be added to the current inspection? [1/yes] [0/no] ".$tmpdiscrepancy." <BR>";
	
						if ($tmpdiscrepancy == 1) {
						
								//echo "[3][a][6] : Discrepancy will be added to the inspection by pacing it into the main sub_d table <BR>";
								
								$sql2 = "INSERT INTO tbl_139_327_sub_d (discrepancy_checklist_id, discrepancy_inspection_id, discrepancy_by_cb_int, discrepancy_name, discrepancy_remarks, discrepancy_date, discrepancy_time, discrepancy_location_x, discrepancy_location_y, discrepancy_priority, discrepancy_timestamp,Discrepancy_equipment_id)
								VALUES ( 	'".$tmpinspectionsdarray[1]."', 
											'".$inspectionid."', 
											'".$tmpinspectionsdarray[3]."', 
											'".$tmpinspectionsdarray[4]."', 
											'".$tmpinspectionsdarray[5]."', 
											'".$tmpinspectionsdarray[6]."', 
											'".$tmpinspectionsdarray[7]."', 
											'".$tmpinspectionsdarray[9]."', 
											'".$tmpinspectionsdarray[10]."', 
											'".$tmpinspectionsdarray[11]."',
											'".$tmpinspectionsdarray[8]."',
											'".$tmpinspectionsdarray[17]."'
											)";

								$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
								
								//echo "[3][a][7] This will be done by searching for this SQL Statement <font size='1'>".$sql2."</font> <br>";
								
								if (mysqli_connect_errno()) {
										// there was an error trying to connect to the mysql database
										printf("connect failed: %s\n", mysqli_connect_error());
										exit();
									}		
									else {
									
										//echo "[3][a][8] : Connection with _sub_d table established <BR>";
									
										$objrs2 			= mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
										$newdiscrepancyid 	= mysqli_insert_id($objcon2);
										
										//echo "[3][a][9] : Discrepancy has been issued a new ID ".$newdiscrepancyid." in the main _sub_d table <BR>";
									}
						
								//echo "[3][b][1] : Find Discrepancy Repair records from the temporary table if they exisit <BR>";
						
								$sql2 = "SELECT * FROM tbl_139_327_sub_d_r_tmp WHERE discrepancy_repaired_inspection_id = ".$tmpinspectionsdarray[0]."";
								$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									
								//echo "[3][b][2] This will be done by searching for this SQL Statement <font size='1'>".$sql2."</font> <br>";

								if (mysqli_connect_errno()) {
										// there was an error trying to connect to the mysql database
										printf("connect failed: %s\n", mysqli_connect_error());
										exit();
									}		
									else {
										
										//echo "[3][b][3] : Connection Established with table '<i> tbl_139_327_sub_d_r_tmp </i>' <BR>";
										
										$ddr = 0;
										
										$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
										while ($objfields = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
										
												//echo "[3][b][4] : Save temporary values to an array for future use <BR>";
										
												$tmpinspectionsdrarray[0]	= $objfields['discrepancy_repaired_id'];
												$deletedridarray[$ddr]		= $objfields['discrepancy_repaired_id'];
												$tmpinspectionsdrarray[1]	= $objfields['discrepancy_repaired_inspection_id'];
												$tmpinspectionsdrarray[2]	= $objfields['discrepancy_repaired_by_cb_int'];
												$tmpinspectionsdrarray[3]	= $objfields['discrepancy_repaired_comments'];
												$tmpinspectionsdrarray[4]	= $objfields['discrepancy_repaired_date'];	
												$tmpinspectionsdrarray[5]	= $objfields['discrepancy_repaired_time'];	
												$tmpinspectionsdrarray[6]	= $objfields['discrepancy_repaired_yn'];	
												$tmpinspectionsdrarray[7]	= $objfields['discrepancy_repaired_timestamp'];	
												$tmpinspectionsdrarray[8]	= $objfields['discrepancy_repaired_signature'];													
							
												//echo "[3][b][5] : Use temporary values to save to the main table <BR>";
							
												$sql3 = "INSERT INTO tbl_139_327_sub_d_r (discrepancy_repaired_inspection_id, discrepancy_repaired_by_cb_int, discrepancy_repaired_comments, discrepancy_repaired_date, discrepancy_repaired_time, discrepancy_repaired_yn)
												VALUES ( 	'".$newdiscrepancyid."', 
															'".$tmpinspectionsdrarray[2]."', 
															'".$tmpinspectionsdrarray[3]."', 
															'".$tmpinspectionsdrarray[4]."', 
															'".$tmpinspectionsdrarray[5]."',
															'".$tmpinspectionsdrarray[6]."')";
												
												$objcon3 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
												
												//echo "[3][b][6] This will be done by searching for this SQL Statement <font size='1'>".$sql3."</font> <br>";
												
												if (mysqli_connect_errno()) {
														// there was an error trying to connect to the mysql database
														printf("connect failed: %s\n", mysqli_connect_error());
														exit();
													}		
													else {
													
														//echo "[3][b][7] : Connection Established with main table <BR>";
													
														$objrs3 = mysqli_query($objcon3, $sql3) or die(mysqli_error($objcon3));
														$discrepancyrepairID = mysqli_insert_id($objcon3);
														
														//echo "[3][b][8] : Discrepancy repair has a new ID of ".$discrepancyrepairID." <BR>";
													}	
													
												$ddr = ($ddr + 1);	
													
											}
									}
							}
							
						$dd = ($dd + 1);		
							
					}	//	End of While Loop
			}

			
// Part 3(c): Find all linked discrepancies and copy them into the main tables	
	
		//echo "PART THREE(2) : Find the temporary discrepancy records based on the known Records ID <BR>";	
	
		$sql = "SELECT * FROM tbl_139_327_sub_d_tmp WHERE Discrepancy_inspection_id=".$_POST['recordid']."";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		//echo "[3][a][1] This will be done by searching for this SQL Statement <font size='1'>".$sql."</font> <br>";
		
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
				
				//echo "[3][a][2] : Connection Established with _sub_d_tmp table <BR>";
				
				//$dd = 0;
				
				$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
				while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {	
				
						//echo "[3][a][3] : Save temporary values to an array for future use <BR>";
				
						$tmpinspectionsdarray[0]	= $objfields['Discrepancy_id'];
						$deletedidarray[$dd]		= $objfields['Discrepancy_id'];
						$tmpinspectionsdarray[1]	= $objfields['discrepancy_checklist_id'];						
						$tmpinspectionsdarray[2]	= $objfields['Discrepancy_inspection_id'];
						$tmpinspectionsdarray[3]	= $objfields['Discrepancy_by_cb_int'];
						$tmpinspectionsdarray[4]	= $objfields['Discrepancy_name'];
						$tmpinspectionsdarray[5]	= $objfields['discrepancy_remarks'];
						$tmpinspectionsdarray[6]	= $objfields['Discrepancy_date'];
						$tmpinspectionsdarray[7]	= $objfields['Discrepancy_time'];
						$tmpinspectionsdarray[8]	= $objfields['discrepancy_timestamp'];
						$tmpinspectionsdarray[9]	= $objfields['Discrepancy_location_x'];
						$tmpinspectionsdarray[10]	= $objfields['Discrepancy_location_y'];
						$tmpinspectionsdarray[11]	= $objfields['discrepancy_priority'];
						$tmpinspectionsdarray[12]	= $objfields['discrepancy_quadrent'];
						$tmpinspectionsdarray[13]	= $objfields['discrepancy_enteredonpda'];
						$tmpinspectionsdarray[14]	= $objfields['discrepancy_photo'];
						$tmpinspectionsdarray[15]	= $objfields['discrepancy_sketch'];
						$tmpinspectionsdarray[16]	= $objfields['discrepancy_signature'];
						$tmpinspectionsdarray[17]	= $objfields['Discrepancy_equipment_id'];
						
						$tmpdiscrepancy 			= 1;
						//echo "[3][a][4] : Steps [4/5] Not Applicable <BR>";
	
						if ($tmpdiscrepancy == 1) {
						
								//echo "[3][a][6] : Discrepancy will be added to the inspection by pacing it into the main sub_d table <BR>";
								
								$sql2 = "INSERT INTO tbl_139_327_sub_d (discrepancy_checklist_id, discrepancy_inspection_id, discrepancy_by_cb_int, discrepancy_name, discrepancy_remarks, discrepancy_date, discrepancy_time, discrepancy_location_x, discrepancy_location_y, discrepancy_priority, discrepancy_timestamp,Discrepancy_equipment_id)
								VALUES ( 	'".$tmpinspectionsdarray[1]."', 
											'".$inspectionid."', 
											'".$tmpinspectionsdarray[3]."', 
											'".$tmpinspectionsdarray[4]."', 
											'".$tmpinspectionsdarray[5]."', 
											'".$tmpinspectionsdarray[6]."', 
											'".$tmpinspectionsdarray[7]."', 
											'".$tmpinspectionsdarray[9]."', 
											'".$tmpinspectionsdarray[10]."', 
											'".$tmpinspectionsdarray[11]."',
											'".$tmpinspectionsdarray[8]."',
											'".$tmpinspectionsdarray[17]."'
											)";

								$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
								
								//echo "[3][a][7] This will be done by searching for this SQL Statement <font size='1'>".$sql2."</font> <br>";
								
								if (mysqli_connect_errno()) {
										// there was an error trying to connect to the mysql database
										printf("connect failed: %s\n", mysqli_connect_error());
										exit();
									}		
									else {
									
										//echo "[3][a][8] : Connection with _sub_d table established <BR>";
									
										$objrs2 			= mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
										$newdiscrepancyid 	= mysqli_insert_id($objcon2);
										
										//echo "[3][a][9] : Discrepancy has been issued a new ID ".$newdiscrepancyid." in the main _sub_d table <BR>";
									}
						
								//echo "[3][b][1] : Find Discrepancy Repair records from the temporary table if they exisit <BR>";
						
								$sql2 = "SELECT * FROM tbl_139_327_sub_d_r_tmp WHERE discrepancy_repaired_inspection_id = ".$tmpinspectionsdarray[0]."";
								$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									
								//echo "[3][b][2] This will be done by searching for this SQL Statement <font size='1'>".$sql2."</font> <br>";

								if (mysqli_connect_errno()) {
										// there was an error trying to connect to the mysql database
										printf("connect failed: %s\n", mysqli_connect_error());
										exit();
									}		
									else {
										
										//echo "[3][b][3] : Connection Established with table '<i> tbl_139_327_sub_d_r_tmp </i>' <BR>";
										
										$ddr = 0;
										
										$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
										while ($objfields = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
										
												//echo "[3][b][4] : Save temporary values to an array for future use <BR>";
										
												$tmpinspectionsdrarray[0]	= $objfields['discrepancy_repaired_id'];
												$deletedridarray[$ddr]		= $objfields['discrepancy_repaired_id'];
												$tmpinspectionsdrarray[1]	= $objfields['discrepancy_repaired_inspection_id'];
												$tmpinspectionsdrarray[2]	= $objfields['discrepancy_repaired_by_cb_int'];
												$tmpinspectionsdrarray[3]	= $objfields['discrepancy_repaired_comments'];
												$tmpinspectionsdrarray[4]	= $objfields['discrepancy_repaired_date'];	
												$tmpinspectionsdrarray[5]	= $objfields['discrepancy_repaired_time'];	
												$tmpinspectionsdrarray[6]	= $objfields['discrepancy_repaired_yn'];	
												$tmpinspectionsdrarray[7]	= $objfields['discrepancy_repaired_timestamp'];	
												$tmpinspectionsdrarray[8]	= $objfields['discrepancy_repaired_signature'];													
							
												//echo "[3][b][5] : Use temporary values to save to the main table <BR>";
							
												$sql3 = "INSERT INTO tbl_139_327_sub_d_r (discrepancy_repaired_inspection_id, discrepancy_repaired_by_cb_int, discrepancy_repaired_comments, discrepancy_repaired_date, discrepancy_repaired_time, discrepancy_repaired_yn)
												VALUES ( 	'".$newdiscrepancyid."', 
															'".$tmpinspectionsdrarray[2]."', 
															'".$tmpinspectionsdrarray[3]."', 
															'".$tmpinspectionsdrarray[4]."', 
															'".$tmpinspectionsdrarray[5]."',
															'".$tmpinspectionsdrarray[6]."')";
												
												$objcon3 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
												
												//echo "[3][b][6] This will be done by searching for this SQL Statement <font size='1'>".$sql3."</font> <br>";
												
												if (mysqli_connect_errno()) {
														// there was an error trying to connect to the mysql database
														printf("connect failed: %s\n", mysqli_connect_error());
														exit();
													}		
													else {
													
														//echo "[3][b][7] : Connection Established with main table <BR>";
													
														$objrs3 = mysqli_query($objcon3, $sql3) or die(mysqli_error($objcon3));
														$discrepancyrepairID = mysqli_insert_id($objcon3);
														
														//echo "[3][b][8] : Discrepancy repair has a new ID of ".$discrepancyrepairID." <BR>";
													}	
													
												$ddr = ($ddr + 1);	
													
											}
									}
							}
							
						$dd = ($dd + 1);		
							
					}	//	End of While Loop
			}			
			
			

			
// Part 4: Find all used temporary records and delete them.

		//echo "PART FOUR : Delete Records Not needed <BR>";	

		//echo "[4][a][1] Loop Through Deletable Records (tbl_139_327_sub_d_r_tmp) <BR>";	
				
		for ($i=0; $i<count($deletedridarray); $i=$i+1) {

				$sql 	= "DELETE FROM tbl_139_327_sub_d_r_tmp WHERE discrepancy_repaired_id = ".$deletedridarray[$i]."";
				$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
												
				//echo "[4][a][2] This will be done by searching for this SQL Statement <font size='1'>".$sql."</font> <br>";
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					
						//echo "[4][a][3] Connection Established with Temporary Table <BR>";	
					
						$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						$discrepancyrepairID = mysqli_insert_id($objcon);
						
						//echo "[4][a][4] Applicable Temporary Discrepancies Repair Records Deleted <BR>";	
					}
			}
		
		//echo "[4][b][1] Loop Through Deletable Records (tbl_139_327_sub_d_tmp) <BR>";	
		
		for ($i=0; $i<count($deletedidarray); $i=$i+1) {

				$sql 	= "DELETE FROM tbl_139_327_sub_d_tmp WHERE Discrepancy_id = ".$deletedidarray[$i]."";
				$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
												
				//echo "[4][b][2] This will be done by searching for this SQL Statement <font size='1'>".$sql."</font> <br>";
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					
						//echo "[4][b][3] Connection Established with Temporary Table <BR>";	
					
						$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						$discrepancyrepairID = mysqli_insert_id($objcon);
						
						//echo "[4][b][4] Applicable Temporary Discrepancies Deleted <BR>";	
					}
			}		

		//echo "[4][c][1] Loop Through Deletable Records (tbl_139_327_sub_c_c_tmp) <BR>";			
			
		for ($i=0; $i<count($deleteccarray); $i=$i+1) {

				$sql 	= "DELETE FROM tbl_139_327_sub_c_c_tmp WHERE conditions_checklists_id = ".$deleteccarray[$i]."";
				$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
												
				//echo "[4][c][2] This will be done by searching for this SQL Statement <font size='1'>".$sql."</font> <br>";
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					
						//echo "[4][c][3] Connection Established with Temporary Table <BR>";	
					
						$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						$discrepancyrepairID = mysqli_insert_id($objcon);
						
						//echo "[4][c][4] Applicable Temporary Condition Checklists Deleted <BR>";	
					}
			}				

		//for ($i=0; $i<count($deleteccarray); $i=$i+1) {

				$sql 	= "DELETE FROM tbl_139_327_main_tmp WHERE inspection_system_id = ".$deletetmpinspid."";
				$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
												
				//echo "> SQL Statement :".$sql."<br>";
				//echo "> Establishing connection to 327_main_tmp<br>";
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					
						//echo "> Connection with 327_main_tmp established...<br>";
					
						$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						$discrepancyrepairID = mysqli_insert_id($objcon);
						
						//echo ">> Inspection Reocrd has been deleted<br>";
					}
		//	}			

//	5). Conduct Additional Work
//		a). Find all Discrepancies that are currently NOT fixed and place them the 'tbl_139_327_sub_d_o' table
//
//			The trick here is we need to find all discrepancies that have not been fixed at the time this inspection was issued.
//			We have some functions that do this already so we will copy that code and work it into a function latter.
//			We need to know a few things first:
//			Current Inspection ID is: $inspectionid
//
//			Loop Through Discrepancies

		//echo "PART FIVE : Conduct Additional Work <BR>";	

		//echo "Start Looking through all Discrepancies, not currently repaired<br>";
		//
		//	tmpinspectionarray[3] is the date of a 139.327 inspection.
		//	Find all Discrepancies issued prior to the date of the current inspection date.
		$sql 		= "SELECT * FROM tbl_139_327_sub_d WHERE Discrepancy_date <= '".$tmpinspectionarray[3]."' ";
		//echo "SQL is ".$sql." <br>";
		$objconn  	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);
							
				if ($objrs) {
						$number_of_rows = mysqli_num_rows($objrs);
						while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {	
						
								$discrepancy_id 	= $objarray['Discrepancy_id'];
								$tmp_inspectionid	= $objarray['Discrepancy_inspection_id'];
								//echo "Discrepancy ID is ".$discrepancy_id."<br>";								
								$status 			= part139327discrepancy_getstage($discrepancy_id,$tmpinspectionarray[3], $tmpinspectionarray[4],0,1,$tmpinspectionarray[5]);
								//echo "The status of the Discrepancy is ".$status."<br>";
								
								//echo "is the Discrepancy already part of the current inspection ?<br>";
								//echo "> if so, do not add it to the owned by table <br>";
								
								if($tmp_inspectionid == $inspectionid) {
										//echo "> The Discrepancy is part of the current inspection <br>";
									}
									else {		
										//echo "> The Discrepancy is NOT part of the current inspection, own it <br>";
										if($status <> 3) {
												// Discrepancy is anything but closed....
												//		Work Order, 
												//		Bounced, 
												//		Repaired
												//		etc.
												// Insert this discrepancy into the proper table.
												
												$sql2 		= "INSERT INTO tbl_139_327_sub_d_o (disinspection_id,disdis_id) VALUES ( '".$inspectionid."', '".$discrepancy_id."' )";
												//echo "Insert Record SQL is ".$sql2."<br>";
												
												$objcon2 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
												if (mysqli_connect_errno()) {
														printf("connect failed: %s\n", mysqli_connect_error());
														exit();
													}		
													else {
														$objrs2				= mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
														$disowned_id 		= mysqli_insert_id($objcon2);
														
														//echo "New Inspection Discrepancy owned Record has been inserted into 327_sub_d_o<br>";
													}
											}
									}
							}
					}
			}
	
								

		
// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
	$strmenuitemid	= $_POST["strmenuitemid"];
	$frmstartdate	= $_POST["frmstartdate"];
	$frmenddate		= $_POST["$frmenddate"];
	
	//echo "Menu Item ID :".$strmenuitemid;
	
	//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);

// Display end report		
		?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblbrowseformtable" />
		<tr>
			<td class="perp_menuheader" />
				Enter New Part 139.327 Inspection
				</td>			
			</tr>			
		<tr>
			<td class="perp_menusubheader" />
				(
					Inspection Saved
					)
				</td>				
			</tr>
		<tr>
			<td colspan="3" class="item_space_inactive">
				Part 139.327 Inspection has been sucssesfully added to the system.  You may print the report out for your own records.
				</td>
			</tr>		
			<tr>
				<form style="margin-bottom:0;" action="part139327_report_display_new.php" method="POST" name="printform" id="printform" target="_printerfriendlyreport" onsubmit="open_new_report_window('','_printerfriendlyreport');" />
				<td class="item_name_active" colspan="3">
					<input type="hidden" name="recordid" 			value="<?php echo $inspectionid;?>">
					<?php
					_tp_control_function_submit('printform');
					?>
					</td>
					</form>
				</tr>
			</table>
			<?php

// Establish Page Variables

		//$last_main_id	= $last_main_id;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>