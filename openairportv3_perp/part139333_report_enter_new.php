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
//	Name of Document		:	part139333_report_enter_new.php
//
//	Purpose of Page			:	Enter New Part139.333 Protection of Navaid Inspection
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

		include("includes/_modules/part139333/part139333.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 19;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 16;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions	

if (!isset($_POST["formsubmit"])) {
		// This FORM has not been submitted before

//	Start Form Set Variables

	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "edittable";													// HTML Name for Form
			$formaction			= '';															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= '';															// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= getnameofmenuitemid_return_nohtml($strmenuitemid		, "long"	, 4			, "#FFFFFF"	,$_SESSION['user_id']);							// Name of the FORM, shown to the user
			$form_subh			= getpurposeofmenuitemid_return_nohtml($strmenuitemid	, 1			, "#FFFFFF"	,$_SESSION['user_id']);									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Enter New Navaid Inspection Report";							// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= '';													// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= '';													// See Summary Function for how to use this number
				$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
				
		include("includes/_template/_tp_blockform_form_header.binc.php");
		
	// Template Form Modification (for AJAX Compatability)
		?>
	</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" />
	<tr>
		<td class="item_name_active" />
			Type of Inspection
			</td>
		<td class="item_name_inactive" />
			<?php 
			part139333typescombobox("all", "all", "InspCheckList", "show", "");
			?>
			</td>
		<td class="item_right_inactive" />
			<?php
			$param = $_SESSION['user_id'].','.$formname;
			
			_tp_control_function_button_ajax('call_server_part139333',$param,'Get Checklist');
			_tp_control_function_submit($formname,'Save Report');
			?>
			</td>
		</tr>
	<tr>
		<td colspan="3" >
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<?php
				form_new_table_b($formname);
				form_new_control("frmdate"			,"Date"				, "Enter the date this discrepancy was found"															,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"				,1		,7		,0		,'current'				,0);
				form_new_control("frmtime"			,"Time"				, "Enter the time this discrepancy was found"															,"The current time has automatically been provided!"	,"(hh:mm:ss) - 24 hours"	,1		,7		,0		,"current"				,0);
						?>
				</table>
			</td>
		</tr>
	<tr>
		<td colspan="4" name="CheckListData" id="CheckListData" class="ajax_results_area">
			After clicking the 'Get Checklist' button, please wait a moment while the checklist loads
				<?
				for ($i=0; $i<15; $i=$i+1) {
						?>
						<br>
						<?
					}
					
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 1;															// 1: Display Submit Button,	0: No
				$submitbuttonname	= 'Save Record';												// Name of the Submit Button
			$display_close			= 0;															// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;															// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;															// 1: Display Refresh Button, 	0: No
			$display_quickaccess	= 1;
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");
	}
	else {
	
	
		//$tmpdate = AmerDate2SqlDateTime($_POST['frmdate']);
		$tmpdate = ($_POST['frmdate']);
		
		$sql = "INSERT INTO tbl_139_333_main (139333_type_cb_int,139333_by_cb_int,139333_date,139333_time ) VALUES ( '".$_POST['InspCheckList']."', '".$_POST['inspector']."', '".$tmpdate."', '".$_POST['frmtime']."' )";
				
		//echo $sql;

		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid 		= mysqli_insert_id($mysqli);
						$last_main_id	= $lastid;
						$lastNavAididi 	= mysqli_insert_id($mysqli);
						//echo $tmp;
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}
						
	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "edittable";													// HTML Name for Form
			$formaction			= '';															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= '';															// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= getnameofmenuitemid_return_nohtml($strmenuitemid		, "long"	, 4			, "#FFFFFF"	,$_SESSION['user_id']);							// Name of the FORM, shown to the user
			$form_subh			= getpurposeofmenuitemid_return_nohtml($strmenuitemid	, 1			, "#FFFFFF"	,$_SESSION['user_id']);									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Here is a Summary of the information you entered";			// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= '';													// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= '';													// See Summary Function for how to use this number
				$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
					
		include("includes/_template/_tp_blockform_form_header.binc.php");
		
		
		//echo "Begin the process of doing all this impossible work";
		?>
		</form>
		<tr>
			<td colspan="3" class="item_space_inactive">
				Part 139.333 Inspection has been sucssesfully added to the system.  You may print the report out for your own records.
				</td>
			</tr>		
			<tr>
				<form style="margin-bottom:0;" action="part139333_report_display.php" method="POST" name="printform" id="printform" target="_printerfriendlyreport" onsubmit="open_new_report_window('','_printerfriendlyreport');" />
				<td class="item_name_active" colspan="3">
					<input type="hidden" name="recordid" 			value="<?php echo $lastid;?>">
					<input type="hidden" name="InspCheckList" 			value="<?php echo $_POST['InspCheckList'];?>">
					<?php
					_tp_control_function_submit('printform','Print Report');
					?>
					</td>
					</form>
				</tr>
			</table>
	
		<?php
		
		
	// Template Form Modification (for AJAX Compatability)	
										
		// Form has been submitted
		// There are two things that must be done initialy before we go off to the discrepancy page.
		// Step 1). Add the Inspection Header information to the database
		// Step 2). Add each checklist item to the database for that inspection.
		

						
	// Inspection Header has been entered into the Database 

	// This next step always sucks...
	
	// This has to be done in two steps.
	//	a). Find all condition checklist items for this type of inspection
						
				$sql = "SELECT * FROM tbl_139_333_sub_c WHERE condition_type_cb_int = '".$_POST['InspCheckList']."' AND condition_archived_yn = 0";
				$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
				//echo "[1] SQL Statement to Select _sub_c is ".$sql." <br>";
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
						//mysql_insert_id();
						$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {		
							
								//Now it is important to know how each field is named.  Their names could be:
								//	ID of condition<?php echo $fieldname.'i'
								$tmpid2 		= $objfields['conditions_id'];
								$fieldname 		= $tmpid2."_";
								
								$tmpfacid2		= $objfields['condition_facility_cb_int'];
								
								$tmpdiscrepancy = 0;								// <- Were lazy and don't care
								
								if($tmpfacid2 == 1 OR $tmpfacid2 == 5) {
										
										$cellnamei = $fieldname.'i';
										$cellnames = $fieldname.'s';
										$cellnamee = $fieldname.'e';
										$cellnamec = $fieldname.'c';
										
										$cellvaluei = $_POST[$cellnamei];
										$cellvalues = $_POST[$cellnames];
										$cellvaluee = $_POST[$cellnamee];
										$cellvaluec = $_POST[$cellnamec];
										
										$complatecellvalue = $cellvaluei."/".$cellvalues."/".$cellvaluee."/".$cellvaluec."";
									}
									else {
									
										$cellnamec 	= $fieldname.'cb';
										
										$cellvaluec = $_POST[$cellnamec];
										
										$complatecellvalue = $cellvaluec;
									}
									
	//	b). Involved creating a _c_c entry for each of the _c entries.
	
								$sql2 = "INSERT INTO tbl_139_333_sub_c_c (conditions_checklists_condition_cb_int,conditions_checklists_inspection_cb_int,conditions_checklist_discrepancy_yn,conditions_checklist_values ) VALUES ( '".$tmpid2."', '".$lastid."', '".$tmpdiscrepancy."','".$complatecellvalue."' )";
								$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
								//echo "[2] SQL Statement to Select _sub_c is ".$sql2." <br>";
								
								//echo $sql."<br><br>";
								if (mysqli_connect_errno()) {
										// there was an error trying to connect to the mysql database
										printf("connect failed: %s\n", mysqli_connect_error());
										exit();
									}		
									else {
										//mysql_insert_id();
										$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
										$lastchkid = mysqli_insert_id($objcon2);
										}

							}	// End of While Loop
							
					}	// End of Object Record Set
					
		//echo "[3] Main NavAid Inspection has been entered. <br>";	

	//	c). Completed Entry of Inspection of Navaid.  Now for the injection of the Periodic Inspection Record.
									
		// To start this off, we need to know if this is something we even need to do.

		$sql = "SELECT * FROM tbl_139_327_sub_d_tmp WHERE discrepancy_madebynavaid = '1' ";
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		//echo "[4] Now to Test if there is a discrepancy issued. <br>";
		//echo "[5] The SQL test for this is ".$sql." <br>";
		
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
			//mysql_insert_id();
				$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));				
				if ($objrs) {
					$number_of_rows = mysqli_num_rows($objrs);
					}
			}
		
		//echo "[6] There are [".$number_of_rows."] that need a new Periodic Inspection <br>";
		
		if($number_of_rows > 0) {
				
				//echo "Damn, I need to add a new Inspection <br>";
				$addedinspection = 1;
				
				// Start by Assembling the Inspection 327 Header
				
						$sql 	= "INSERT INTO tbl_139_327_main (type_of_inspection_cb_int,inspection_completed_by_cb_int,139327_date,139327_time ) VALUES ( '3', '".$_POST['inspector']."', '".$tmpdate."', '".$_POST['frmtime']."' )";
						$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

						//echo "[7] Insert into 327_main the following SQL Statement <font size='1'>".$sql."</font> <br>";
						
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}		
							else {
							
								//echo "[1][b][2] Connection to temporary main table established <br>";
							
								$objrs 				= mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
								$inspectionid 		= mysqli_insert_id($objcon);
								$inspectionlinked2	= mysqli_insert_id($objcon);
								
								//echo "[8] The ID of the new inspection is ".$inspectionid." <br>";
							}
					
				//	Now Loop through the conditions for this type of checklist
				
						$sql = "SELECT * FROM tbl_139_327_sub_c WHERE condition_type_cb_int = '3' AND condition_archived_yn = 0";
						$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
						
						//echo "[9] Loop through the _sub_c for the following SQL Statement <font size='1'>".$sql."</font> <br>";
						
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}		
							else {
								//mysql_insert_id();
								$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
								while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										// We now are inside each record of each type of condition that is part of the selected checklist, now we need to add a new record to another table for each of these records.
										// That means establishing a new connection to the database while this one is still open.
										$tmpid 			= $objfields['conditions_id'];
										$tmpfacilityid	= $objfields['condition_facility_cb_int'];
										$tmpcondname	= $objfields['condition_name'];
										$tmpstring	 	= (string) $tmpid;
										$tmpa 			= $tmpstring."za";
										$tmpd			= $tmpstring."zd";
									
				//	Insert this condition into the checklist
				
										$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
										
										if($tmpid == 46) {
												$discrepancy = 1;
											}
											else {
												$discrepancy = 0;
											}
											
										$sql2 = "INSERT INTO tbl_139_327_sub_c_c (conditions_checklists_condition_cb_int,conditions_checklists_inspection_cb_int,conditions_checklist_discrepancy_yn ) VALUES ( '".$tmpid."', '".$inspectionid."', '".$discrepancy."' )";
		
										//echo "[10] Insert into _c_c the following SQL Statement <font size='1'>".$sql."</font> <br>";
					
										//echo $sql2."<br><br>";
										if (mysqli_connect_errno()) {
												// there was an error trying to connect to the mysql database
												printf("connect failed: %s\n", mysqli_connect_error());
												exit();
											}		
											else {
												//mysql_insert_id();
												$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
												$lastchkid = mysqli_insert_id($objcon2);
											}
											
									}
									
							}
							
					//echo "[11] All Inspection Stuff completed.  Now to look for discrepancies <br>";
				
				//	Now find all Discrepancies with the NAVAID flag, and insert them into this new inspection
				
						$sql = "SELECT * FROM tbl_139_327_sub_d_tmp WHERE discrepancy_madebynavaid = 1";
						$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

						//echo "[12] Select from _d_tmp the following SQL Statement <font size='1'>".$sql."</font> <br>";
						
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}		
							else {
							//mysql_insert_id();
								$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
								//$lastid 		= mysqli_insert_id($mysqli);
								//$lastNavAididi 	= mysqli_insert_id($mysqli);
								//echo $tmp;
								//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
								//echo mysql_insert_id($mysqli);					
								if ($objrs) {
										$number_of_rows = mysqli_num_rows($objrs);
										$dd = 0;
										while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {

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
												$tmpinspectionsdarray[17]	= $objfields['discrepancy_madebynavaid'];
												$tmpinspectionsdarray[14]	= $objfields['discrepancy_photo'];
												$tmpinspectionsdarray[15]	= $objfields['discrepancy_sketch'];
												$tmpinspectionsdarray[16]	= $objfields['discrepancy_signature'];
										
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
												
												//echo "[13] Insert into 327_sub_d the following SQL Statement <font size='1'>".$sql2."</font> <br>";
												
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
										
										
												$sql2 = "SELECT * FROM tbl_139_327_sub_d_r_tmp WHERE discrepancy_repaired_inspection_id = '".$tmpinspectionsdarray[0]."' ";
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
																
																//echo "[14] Insert into 327_sub_d_r the following SQL Statement <font size='1'>".$sql."</font> <br>";
												
																
																
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
													
											$dd = ($dd + 1);	
											}
											
											
									}
							}							
								
								
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
										
	

	//	Tell the Main Inspection what the ID was of the new inspection
	
				$sql = "UPDATE `tbl_139_333_main` SET `139333_linked_327_int`= '".$inspectionlinked2."' WHERE 139333_main_id = '".$lastNavAididi."' ";
				$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					
						$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						$discrepancyrepairID = mysqli_insert_id($objcon);
						
					}
	
			}
			
	}
	
// Define Variables...
//						for Auto Entry Function {End of Page}

		if (!isset($last_main_id)) {
				// Not defined, set to zero
				$last_main_id = 0;
			} else {
				$last_main_id = $lastNavAididi;
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