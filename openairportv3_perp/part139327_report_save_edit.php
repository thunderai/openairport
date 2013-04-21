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

		$deletedidarray				= array();
		$deletedridarray			= array();
// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures
		
// Start Procedures
	//	This will be a multi step process.

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

// What is the ID of the main record?

		$inspectionid = $_POST['recordid'];
	
	
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

						//echo "TMP Inspection Array ID is ".$tmpinspectionsdarray[1]."<br>";
								
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
								
								$sql2 = "INSERT INTO tbl_139_327_sub_d (discrepancy_checklist_id, discrepancy_inspection_id, discrepancy_by_cb_int, discrepancy_name, discrepancy_remarks, discrepancy_date, discrepancy_time, discrepancy_location_x, discrepancy_location_y, discrepancy_priority, discrepancy_timestamp)
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
											'".$tmpinspectionsdarray[8]."')";

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
						
						$tmpdiscrepancy 			= 1;
						//echo "[3][a][4] : Steps [4/5] Not Applicable <BR>";
	
						if ($tmpdiscrepancy == 1) {
						
								//echo "[3][a][6] : Discrepancy will be added to the inspection by pacing it into the main sub_d table <BR>";
								
								$sql2 = "INSERT INTO tbl_139_327_sub_d (discrepancy_checklist_id, discrepancy_inspection_id, discrepancy_by_cb_int, discrepancy_name, discrepancy_remarks, discrepancy_date, discrepancy_time, discrepancy_location_x, discrepancy_location_y, discrepancy_priority, discrepancy_timestamp)
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
											'".$tmpinspectionsdarray[8]."')";

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

		
// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
	$strmenuitemid	= $_POST["strmenuitemid"];
	$frmstartdate	= $_POST["frmstartdate"];
	$frmenddate		= $_POST["frmenddate"];
	
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
					_tp_control_function_submit('printform','Print Report');
					?>
					</td>
					</form>
				</tr>
			</table>
			<?php

// Establish Page Variables

		if (!isset($lastid)) {
				// Not defined, set to zero
				$last_main_id = 0;
			} else {
				$last_main_id = $lastid;
			}		
		if (!isset($_POST["formsubmit"])) {
				// Not defined, set to zero
				$submit = 0;
			} else {
				$submit = $_POST["formsubmit"];
			}

		$auto_array		= array($navigation_page, $_SESSION["user_id"], $submit, $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 
		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>