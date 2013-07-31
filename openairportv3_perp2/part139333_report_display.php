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
//	Name of Document		:	part139333_report_edit.php
//
//	Purpose of Page			:	Edit existing Part139.333 Protection of Navaid Inspection
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
		
// Collect POST Information
		
		
if (!isset($_POST["recordid"])) {
		// No Record ID defined in POST, use GET record id
		$inspection_id			= $_GET['recordid'];
		$from_get				= 1;
	}
	else {
		$inspection_id			= $_POST['recordid'];
		$from_get				= 0;
	}		
		
		//$inspection_id			= $_POST['recordid'];
		$menuitemid 			= $_POST['menuitemid'];													
		$tblname				= $_POST['tblname'];													
		$tblsubname				= $_POST['tblsubname'];	

// Define Variables	for Auto Entry Function
		
		$navigation_page 			= 19;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 3;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures
			
		$sql =" SELECT * FROM tbl_139_333_main WHERE 139333_main_id = ".$inspection_id."";
		//echo "Connect to database usining this SQL statement ".$sql." <br>";				
		$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);
						
				if ($objrs) {
						$number_of_rows = mysqli_num_rows($objrs);
						?>
				<table border="1" style="border-collapse:collapse;" width="750" bgcolor="#FFFFFF" align="left" valign="top">
						<?php
						while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
								?>
					<tr>
						<td colspan="2" class='perp_report_bigheader' />
							<?php
								part139333typescombobox($objarray['139333_type_cb_int'], "all", "typeofinspection", "hide", $objarray['139333_type_cb_int']);
								?>
							</td>
						</tr>								
					<tr>
						<td class='perp_report_fieldname' />
							Date
							</td>
						<td class='perp_report_fieldcontent' />
							<?php
							echo $uidate = sqldate2amerdate($objarray['139333_date']);
							?>											
							</td>
						</tr>
					<tr>
						<td class='perp_report_fieldname' />
							Time
							</td>
						<td class='perp_report_fieldcontent' />
							<?php echo $objarray['139333_time'];?>
							</td>
						</tr>	
					<tr>
						<td class='perp_report_fieldname' />
							Inspection Completed By
							</td>
						<td class='perp_report_fieldcontent' />
							<?php
							systemusercombobox($_SESSION['user_id'], "all", "inspector", "hide", $_SESSION['user_id']);
							?>
							</td>
					<tr>
						<td class='perp_report_fieldname' />
							Resulting 327 Inspection
							</td>
						<td class='perp_report_fieldcontent' />
							<?php
							if($objarray['139333_linked_327_int'] == 0) {
									// No linked Part 139.327 Inspection
									?>
							No Discrepancies Noted
									<?php
									
								}
								else {
									//$webroot = "http://localhost/openairportv3_perp/";
									?>
							<form style='margin-bottom:0;' action='part139327_report_display_new.php' method='POST' name='reportform' id='reportform' target='PrinterRecordWindow2' onsubmit="openmapchild('','PrinterRecordWindow2');" />
								<input type='hidden' name='recordid'	ID='recordid' 			value='<?php echo $objarray['139333_linked_327_int'];?>' />
									<input type='submit' value='D:<?php echo $objarray['139333_linked_327_int'];?>' name='b1' ID='b1' class='makebuttonlooklikelargetext' style='width:100%;'>
								</form>		
							<?php
								}
								?>
							</td>
						</tr>								
								<?php
								//echo "Connect to Condition Checklist to list exisiting checklist points <br>";
								$sql2 = "SELECT * FROM tbl_139_333_sub_c_c 
								INNER JOIN tbl_139_333_sub_c ON tbl_139_333_sub_c.conditions_id = tbl_139_333_sub_c_c.conditions_checklists_condition_cb_int 
								INNER JOIN tbl_139_333_sub_c_f	ON tbl_139_333_sub_c_f.facility_id = tbl_139_333_sub_c.condition_facility_cb_int 
								INNER JOIN tbl_inventory_sub_e	ON tbl_inventory_sub_e.equipment_id = tbl_139_333_sub_c.condition_tied_id 
								INNER JOIN tbl_139_333_sub_t	ON tbl_139_333_sub_t.inspection_type_id = tbl_139_333_sub_c.condition_type_cb_int 		
								WHERE conditions_checklists_inspection_cb_int = '".$inspection_id."' 
								ORDER BY tbl_inventory_sub_e.equipment_name, tbl_139_333_sub_c_f.facility_name, condition_name";

								//echo "Connect with the following SQL Statement ".$sql2." <br>";

								$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

								if (mysqli_connect_errno()) {
										printf("connect failed: %s\n", mysqli_connect_error());
										exit();
									}
									else {
										$res = mysqli_query($objcon2, $sql2);
										if ($res) {
												$number_of_rows = mysqli_num_rows($res);
												//printf("result set has %d rows. \n", $number_of_rows);

												$counter 				= 0;
												$previousrunwayheading	= 0;
												$previousequipmentid	= 0;
												$equipmentarray			= array();

												while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
												
														//echo "[7]. Within the While Loop, Iteration | ".$counter." | <br>";	
														//echo "[8]. Collect some information from the Database to temporary variables <br>";	

														$tmpid 		= $objfields['conditions_id'];
														$tmpcname	= $objfields['condition_name'];
														
														$tmpequiid	= $objfields['condition_tied_id'];
														$tmpequiln	= $objfields['equipment_name'];
														$tmpequity	= $objfields['equipment_type_cb_int'];
														
														// Get Runwayway Heading from Equipment ID
														// Format of Equipment name is 	'PAPI xxby'
														// Format or 					'REIL xxby'
														// Where xx is the runway heading and y is the box number.
														
														// The MALSR does not follow this format at all, and an alternate way to sort the MALSR will need to be found
														$runwayheading = substr($tmpequiln, -4, 2);
														$equipmenttype = substr($tmpequiln, 0, 5);
														$equipmenttype = trim($equipmenttype);
														
														
														//echo " |||||".$equipmenttype."||||| <br>";
														//echo "[8b]. Runway Heading is |".$runwayheading."| <br>";	
														
														$tmpfacid	= $objfields['condition_facility_cb_int'];
														$tmpfacname = $objfields['facility_name'];
														
														$tmptypeid	= $objfields['condition_type_cb_int'];
														$tmptypeln	= $objfields['inspection_type'];
														$tmptypesn	= $objfields['inspection_type_short_name'];
														
														$InspCheckList = $tmptypeid;
														
														$basicvalue = $objfields['conditions_checklist_values']; 
														
														//echo "Basic Value is ".$basicvalue." <br>";
														
														//echo "[9]. Checking Active Equipment Information to consulidate fields <br>";	
														
														if($previousequipmentid == 0) {
																// Nothing Displayed.
																// Display Header Line
																//echo "Equipment ID : ".$tmpequiid." <br>";
																
																$check = 2;
															}
															else {
																// Something has been displayed
																// what was it?
																if($previousequipmentid == $tmpequiid) {
																		// Same equipment, Display Nothing
																		$check = 1;
																		
																		//echo "Equipment ID : ".$tmpequiid." <br>";
																	}
																	else {
																		// Not the same equipment
																		// is it the same runway heading
																		if($previousrunwayheading == $runwayheading) {
																				// Same, display nothing
																				$check = 1;
																				//echo "Equipment ID : ".$tmpequiid." <br>";
																			}
																			else {
																				$check = 2;
																				//echo "Equipment ID : ".$tmpequiid." <br>";
																			}
																	}
															}
								
														//echo $check;		
								
														if($check == 2) {
																//echo "[17]. Check is equal to 2, Display Management Line <br>";
																?>
					<tr>
						<td align="center" valign="middle" colspan="2" align="center" bgcolor="#000000">
							<font color="#FFFFFF" size="3">Runway Heading <?php echo $runwayheading;?></font>
							</td>
						</tr>
																<?php
																//echo "[18]. Now for some horribly inefficent stuff <br>";
																//echo "[19]. Locate only records for this equipment <br>";										
																//echo "[20]. Assemble the Array <br>";
																?>
					<tr>
						<td colspan="2">
																<?php
																if($InspCheckList == 4 OR $InspCheckList == 5 OR $InspCheckList == 6 OR $InspCheckList == 7) {
												// Hard Code Count!!! - EVIL
												$numberofboxes = 4;
												$helperimage 	= 'images/Part_139_333/papihelper.png';
												$arunwayheading	= array($equipmenttype,$runwayheading,$numberofboxes);
											}
										
										if($InspCheckList == 2) {
												// Hard Code Count!!! - EVIL
												$numberofboxes 	= 3;
												$helperimage	= 'images/Part_139_333/malsrhelper.gif';
												$arunwayheading	= array($equipmenttype,$runwayheading,$numberofboxes);
											}	
											
										if($InspCheckList == 8 OR $InspCheckList == 9 OR $InspCheckList == 10 OR $InspCheckList == 11) {
												// Hard Code Count!!! - EVIL
												$numberofboxes 	= 2;
												$helperimage	= 'images/Part_139_333/reilhelper.png';
												$arunwayheading	= array($equipmenttype,$runwayheading,$numberofboxes);
											}	
																include("part139333_report_display_blockform.php");
																?>
							</td>
						</tr>
																<?php
															}
									
														$i 						= $i + 1;
														$check					= 0;
														$counter 				= $counter + 1;
														$previousrunwayheading	= $runwayheading;
														$previousequipmentid	= $tmpequiid;
										
													}	// End of while loop
											//mysqli_free_result($res2);
											//mysqli_close($objcon2);
											}	// end of Res Record Object						
									}


							}	// End of While Loop	
					}
			}
			?>
					<tr>
						<td colspan="2" align="center" valign="middle" height="42" width="60%">
							<font size="2"><b>
								Any "Requires Action" reports will be assoicated with a Part 139.327 Periodic Condition Evaluation Checklist Inspection and will not be listed here.
								</font></b>
							</td>
						</tr>
					</table>
					
<?php
// Establish Page Variables for Auto Entry Function

		$last_main_id	= $inspection_id;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>	