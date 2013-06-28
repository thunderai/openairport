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
//	Name of Document		:	part139339_c_report_enter_new.php
//
//	Purpose of Page			:	Enter New Part139.339 (c) Inspection
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	


// Load Global Include Files
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes

		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Define Variables	
		
		$tblname				= "Edit NOTAM Report";									// Name of form
		$tblsubname				= "Please complete the form";							// Subtitle of form
		
		$i 						= "";
		$tmpvalue				= "";

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 39;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 1;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions		
		
		
// Collect POST Information
		
		// User has the ability to edit this report from within the report, this requires a GET Statement.
		//	We don't want an open GET Statement exposed to the wild so there needs to be some checks done to
		//	ensure there is an active session user
		
		//echo "Session User ID is: ".$_SESSION['user_id']."<br>";
		
		if($_SESSION['user_id'] == '') {
				//echo "No defined Session User, rejecting connection";
		} else {
				if (!isset($_POST['recordid'])) {
						//echo "No POST Defined, Attempt GET Variable <br>";
						$inspection_id 	= $_GET['recordid'];
				} else {
						//echo "Attempting POST Variable <br>";
						$inspection_id	= $_POST['recordid'];
				}
		}
		
		
		//$inspection_id			= $_POST['recordid'];
		$menuitemid 			= $_POST['menuitemid'];													
		//$tblname				= $_POST['tblname'];													
		//$tblsubname				= $_POST['tblsubname'];
	
		$last_main_id	= $inspection_id;
	
// Start Procedures
	if (!isset($inspection_id)) {
			// No Record ID Supplied, Crash Out
		} else {
			if (!isset($_POST["formsubmit"])) {
				//echo "The form has not been submitted before, this is the first time displaying the form. <br>";				
				$sql =" SELECT * FROM tbl_139_339_sub_n WHERE 139339_sub_n_id = ".$inspection_id."";
				//echo "Connect to database usining this SQL statement ".$sql." <br>";				
				$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					} else {
						$objrs = mysqli_query($objconn, $sql);
								
						if ($objrs) {
								$number_of_rows = mysqli_num_rows($objrs);
								?>
	<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3" class="perp_menuheader" />
				<?php echo $tblname;?>
				</td>			
			</tr>			
		<tr>
			<td colspan="3" class="perp_menusubheader" />
				(
				<?php echo $tblsubname;?>
				)
				</td>				
			</tr>
								<?php
								while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										?>
		<tr>
			<td colspan="2" class="item_name_inactive">
				<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
					<tr>
						<?php
						// Hijack Template Functions for our own purposes
						$settingsarray 	= array("SELECT * FROM tbl_139_339_sub_a WHERE 139339_a_inspection_id = "	,	"139339",	"part139339_c_report_display_archived.php");
						$functionpage	= "part139339_b_report_archieved.php";														
						_tp_control_archived($inspection_id, $settingsarray, $functionpage);

						$settingsarray 	= array("SELECT * FROM tbl_139_339_sub_e WHERE 139339_eoo_i_id = "			,	"139339",	"part139339_c_report_display_error.php");
						$functionpage	= "part139339_b_report_error.php";														
						_tp_control_error($inspection_id, $settingsarray, $functionpage);	

						$settingsarray 	= array("SELECT * FROM tbl_139_339_sub_n_r WHERE 139339_sub_n_r_cancelled_id_int = ",	"139339_sub_n",	"part139339_b_report_closed.php");
						$functionpage	= "part139339_b_report_closed.php";														
						_tp_control_closed($objarray['139339_sub_n_id'], $settingsarray, $functionpage);															
						?>
						</tr>
					</table>
				</td>
			</tr>										
						<?php
						// FORM HEADER
						// -----------------------------------------------------------------------------------------\\
								$formname			= "edittable";													// HTML Name for Form
								$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
								$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
									$formtarget		= "";															// HTML Name for the window
									$location		= $formtarget;													// Leave the same as $formtarget
						
						// FORM NAME and Sub Title
						//------------------------------------------------------------------------------------------\\
								$form_menu			= "Edit 339 b Inspection";										// Name of the FORM, shown to the user
								$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
								$subtitle 			= "Use this form to edit the inspection";						// Subt title of the FORM, shown to the user

						// FORM SUMMARY information
						//------------------------------------------------------------------------------------------\\
								$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
									$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
									$idtosearch				= $inspection_id;										// ID to look for in the summary function, this is typically $_POST['recordid'].
									$detailtodisplay		= 0;													// See Summary Function for how to use this number
									$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
										
							include("includes/_template/_tp_blockform_form_header.binc.php");			
							?>
							
							<?php
							// FORM ELEMENTS
							//-----------------------------------------------------------------------------------------\\	
							//
							//				Field Name			, Field Text Name	, Field Comment											, Field Notes											, Field Format					, Field Type	, Field Width	, Field Height	, Default Value			, Field Function		
							form_new_table_b($formname);
							form_new_control("inspector"		, "Entry By"		, "Who found and reported this discrepancy"				,"Your name has automatically been provided!"			,"(cannot be changed)"			, 3				, 0				, 0				, $objarray['139339_sub_n_by_cb_int']		,"systemusercombobox");
							form_new_control("InspCheckList"	, "Type"			, "Select the Species contained for this report"		,"Select from the list provided!"						,""								, 3				, 0				, 4				, $objarray['139339_sub_n_type_cb_int']		,"part139339typescombobox");
							form_new_control('frmmetar'			, 'Metar'			, 'Enter the current Metar'								,'The current metar has automatically been provided!'	, 'METAR'						, 1				, 80			, 0 			, $objarray['139339_sub_n_metar']			, 0);
							form_new_control('frmdate'			, 'Date'			, 'Enter the time this record was made'					,'The current date has automatically been provided!'	, 'MM/DD/YYYY'					, 1				, 7				, 0 			, $objarray['139339_sub_n_date']			, 0);
							form_new_control('frmtime'			, 'Time'			, 'Enter the time this record was made'					,'The current time has automatically been provided!'	, '(hh:mm:ss) - 24 hour format'	, 1				, 7				, 0 			, $objarray['139339_sub_n_time']			, 0);
							form_new_control('frmdateclosed'	, 'Date to Close'	, 'Enter the time this record was made'					,'The current date has automatically been provided!'	, 'MM/DD/YYYY'					, 1				, 7				, 0 			, $objarray['139339_sub_n_date_closed']		, 0);
							form_new_control('frmtimeclosed'	, 'Time to Close'	, 'Enter the time this record was made'					,'The current time has automatically been provided!'	, '(hh:mm:ss) - 24 hour format'	, 1				, 7				, 0 			, $objarray['139339_sub_n_time_closed']		, 0);
							form_new_control('139339_sub_n_wx_out', 'Wx Initials'	, 'Enter the Initails of Flight Service'				,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 5 			, 0 			, $objarray['139339_sub_n_wx_in']			, 0);
							form_new_control('139339_sub_n_fbo_out', 'FBO Initials'	, 'Enter the Initails of Flight Service'				,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 5				, 0 			, $objarray['139339_sub_n_fbo_in']			, 0);
							form_new_control('139339_sub_n_airline_out', 'Airline Initials'	, 'Enter the Initails of Flight Service'		,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 5				, 0 			, $objarray['139339_sub_n_airline_in']			, 0);
							form_new_control("frmnotes"			,"Comments"			, "Provide comments about this NOTAM"					,"Do not use any special characters!"					, ""							, 2				, 30			, 4				, $objarray['139339_sub_n_notes']			, 0);
							?>
		<tr>
			<td colspan='6' />
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
      					<td rowspan="2" class="item_name_active">
      							Surface
							</td>
      					<td rowspan="2" class="item_name_active">
      							Closed ?<br>Yes?
							</td>
						</tr>
					<tr>
						<td colspan="4" />
							<input type="hidden" id="typeofinspection" name="typeofinspection" value="<?php echo $objarray['139339_sub_n_type_cb_int'];?>">
															<?php
															// Define SQL
															$sql = "SELECT * FROM tbl_139_339_sub_c 
																	INNER JOIN tbl_139_339_sub_c_f ON 139339_f_id = 139339_c_facility_cb_int					
																	WHERE 139339_c_type_cb_int = '".$objarray['139339_sub_n_type_cb_int']."' AND 139339_c_archived_yn = 0 AND 139339_f_rwy_yn = 0 OR 139339_f_rwy_yn = 1 OR 139339_f_rwy_yn = 8 
																	ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
															
															//echo $sql;
															
															$i = 0;
															
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
													
																			while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
																					$tmpid 				= $objfields['139339_c_id'];
																					//echo "The Temp ID is ".$tmpid."<br>";
																					$current_facility 	= $objfields['139339_c_facility_cb_int'];
																					if ($current_facility!=$previous_facility) {
																							//Row data has a different facility
																							?>
														</tr>						
													<tr>
														<td name="col_1_r<?php echo $tmpid;?>"
															id="col_1_r<?php echo $tmpid;?>"
															onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',2);" 
															onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',2);" 
															class="item_name_small_inactive"
															/>
																							&nbsp;
																							<?php
																							$tmpfacility = $objfields["139339_c_facility_cb_int"];
																							part139339_c_facilitycombobox($tmpfacility, "all", "notused", "hide", "all");
																							$tmpvalue 	= (string) $tmpid;
																							$tmpa 		= $tmpvalue."za";
																							$tmpd		= $tmpvalue."zd";
															
																							// Check to see if this record condition has a currently active NOTAM saying it is closed
																							$sql_sub 	= "SELECT * FROM tbl_139_339_sub_n_cc 
																											INNER JOIN tbl_139_339_sub_n ON tbl_139_339_sub_n.139339_sub_n_id = tbl_139_339_sub_n_cc.139339_cc_ficon_cb_int 
																											WHERE 139339_cc_c_cb_int = '".$tmpid."' ";
																							
																							//echo $sql_sub;
																							
																							$objcon_sub = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

																							$display_total 	= array();
																							$display_totals = 0;
																							$alterclosed 	= 0;
																							$cellvalue		= 0;
																							$mine			= 0;
																							$stauts			= 0;
																	
																							if (mysqli_connect_errno()) {
																									printf("connect failed: %s\n", mysqli_connect_error());
																									exit();
																								}
																								else {
																									$res_sub = mysqli_query($objcon_sub, $sql_sub);
																									if ($res_sub) {
																											$number_of_rows = mysqli_num_rows($res_sub);
																											//printf("result set has %d rows. \n", $number_of_rows);					
																											while ($objfields_sub = mysqli_fetch_array($res_sub, MYSQLI_ASSOC)) {
																											
																													$displayrow 		= 1;
																													$tmp_is_closed 		= 0;
																													$mine				= 0;
																													$message			= "";
																													$checked			= "";
																													$cellvalue			= "";
																													
																													$surface_id			= $objfields_sub['139339_cc_id'];
																													$owned_notam 		= $objfields_sub['139339_cc_ficon_cb_int'];
																													$cellvalue			= $objfields_sub['139339_cc_d_yn'];
																													
																													if($owned_notam == $inspection_id) {
																															// THIS SURFACE NOTAM BELONGS TO THE EDITED NOTAM
																															//echo "This is my surface notam <br>";
																															$mine = 1;
																													}
																					
																													if($cellvalue == 1) {
																															// Does the surface have a closed surface noration?
																															// It must otherwise we wouldn't even be in here
																															// We need to know two things:
																															//	is the NOTAM that caused this notation closed?
																															//	is it archived?
																															// 		if it is either of those things we dont need to condier it.
																													
																															// Test for archived. If 1 not archived, 0 is archived?
																															$display_archived		= preflights_tbl_139_339_sub_n_a_yn($objfields_sub['139339_sub_n_id'],0);	
																															//echo "Display Archived = ".$display_archived."<br>";
																															$display_closed			= preflights_tbl_139_339_sub_n_r_yn($objfields_sub['139339_sub_n_id'],0);
																															//echo "Display Closed = ".$display_closed."<br>";
																															
																															if($display_archived == 0) {
																																	// Surface is archived, skipp the rest
																																	$skipping = 1;
																															} else {														
																																	
																																	if($display_closed == 1) {
																																			// Surface NOTAM has no closed records
																																			$alterclosed = 1;
																																		} else {
																																			// Surface currently has closed notams on file
																																			$alterclosed = 0;
																																		}
																															}
																									
																													//echo "<br>";
																													//echo "NOTAM ID  |".$objfields_sub['139339_sub_n_id']."|<br>";
																													//echo "Archived  |".$display_archived."|<br>";
																													//echo "Closed	|".$display_closed."|<br>";
																														
																													//$display_totals = $display_totals + $displayrow;
																													}	
																													//$i = $i + 1;
																												}	// End of Sub While Loop

																												//echo "i: ".$displayrows."<br>";
																												
																										}	// End of Sub Object
																										else {
																											//echo "There are no records for this condition";
																										}
																								}
																						// END OF CHECK...
																						?>
															</td>
																						<?php
																						}
																						?>
																						<?php
																						$tmpfieldname = str_replace(" ","",$objfields["139339_c_name"]);
																						// This is the initial Closed Column.
																						$rootname = str_replace("Closed","",$tmpfieldname);
																						$rootname = str_replace("closed","",$rootname);
																						//echo $rootname;
												
																						//echo "CC_Type: ".$objfields['139339_cc_type']."<br>";
												
																						switch ($objfields['139339_cc_type']) {
																								case 0:

																										break;
																								case 1:
																										?>
														<td name="col_2_r<?php echo $tmpid;?>"
															id="col_2_r<?php echo $tmpid;?>"
															onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',2);" 
															onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',2);" 
															class="item_name_small_inactive"
															/>	
																										<?php
																										//echo "Records show that this surface has a value of :".$cellvalue."<br>";
																												
																										if($mine == 1) {
																												?>
																		<input class="Commonfieldbox" type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" style="width:20px;" size="4" 
																												<?php
																												// Surface Closed checkbox and surface belong to this NOTAM
																												//	Allthough it to be changed.
																												if($cellvalue == 1) {
																														// SURFACE IS ALREADY CLOSED, DEFAULT TO CLOSED SURFACE
																														$message 	= "Surface is <u><b>Closed</b></u>. If you open the surface be sure to issue a NOTAM.";
																														$checked 	= "CHECKED";
																														$stauts		= 1;
																													} else {
																														// SURFACE IS OPEN, DEFAULT TO OPEN SURFACE
																														$message = "Surface is <b>Open</b>. If you close it make sure you issue a NOTAM";
																														$checked = "";
																														$stauts		= 0;
																													}
																												?>
																			value="1" <?php echo $checked;?> />
																												<?php
																											} else {
																												// SURFACE CLOSED CHECKBOX AND SURFACE NO NOT BELONG TO THIS NOTAM.
																												//	FOLLOW NORMAL RULES
																												
																												if($alterclosed == 1) {
																														// Dont even show it here
																														?>
																														<i>Surface is closed by NOTAM: (<?php echo $owned_notam;?> (<a href="#" onclick="openmapchild('part139339_b_report_display_new.php?recordid=<?php echo $owned_notam;?>','MapRecordWindow')"; />view</a> | <a href="part139339_b_report_edit.php?recordid=<?php echo $owned_notam;?>" />edit</a>)</i>
																														<?php
																													 
																													} else {
																														?>
																		<input class="Commonfieldbox" type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" style="width:20px;" size="4" 
																														<?php
																														if($cellvalue == 1 AND $display_closed == 1) {
																																// SURFACE IS ALREADY CLOSED, DEFAULT TO CLOSED SURFACE
																																$message = "Surface is <u><b>Closed</b></u>. If you open the surface be sure to issue a NOTAM.";
																																$checked = "CHECKED";
																																$stauts		= 1;
																															} else {
																																// SURFACE IS OPEN, DEFAULT TO OPEN SURFACE
																																$message 	= "Surface is <b>Open</b>. If you close it make sure you issue a NOTAM";
																																$checked 	= "";
																																$stauts		= 0;
																															}
																															?>
																		value="1" <?php echo $checked;?> />
																															<?php
																													}
																											}
																										?>
																	
																	<?php
																										$surface_array[$i]		= array($tmpid,$stauts,$tmpfieldname);
																										$surface_array_i[$i] 	= $surface_id;
																										$surface_array_c[$i] 	= $tmpid;
																										$surface_array_s[$i] 	= $stauts;
																										$surface_array_t[$i] 	= $tmpfieldname;
																										$surface_loops			= $i;
																										//echo "New Array Element Loop: ".$i.", ID: ".$tmpid.", Status: ".$stauts.", Field Name: ".$tmpfieldname." <br>";
																										break;
																								case 2:

																										break;

																							}
																						$previous_facility	= $objfields['139339_c_facility_cb_int'];
																						$i 					= $i + 1;
																						//$tmp_is_closed		= 0;
																						$displayrow			= 0;
																						}	// End of while loop
																						mysqli_free_result($res);
																						mysqli_close($objcon);
																				}	// end of Res Record Object						
																		}
																		?>
													</table>											
												</td>
											</tr>
										<tr>
											
												<?php
												// TAKE SURFACE ARRAY AND SERILZE IT FOR TRANSPORT (bake it)
												//$surface_array_ser 	= urlencode(serialize($surface_array));
												$surface_array	= (serialize($surface_array));
												$surface_array  = str_replace("\"","|",$surface_array);
												
												$surface_array_i	= (serialize($surface_array_i));
												$surface_array_i  	= str_replace("\"","|",$surface_array_i);
												
												$surface_array_c	= (serialize($surface_array_c));
												$surface_array_c  	= str_replace("\"","|",$surface_array_c);
												
												$surface_array_s	= (serialize($surface_array_s));
												$surface_array_s  	= str_replace("\"","|",$surface_array_s);
												
												$surface_array_t	= (serialize($surface_array_t));
												$surface_array_t  	= str_replace("\"","|",$surface_array_t);
												?>
												<input type="hidden" id="surfacearray" 		name="surfacearray" 	value="<?php echo $surface_array;?>" />
												<input type="hidden" id="surfacearray_i" 	name="surfacearray_i" 	value="<?php echo $surface_array_i;?>" />
												<input type="hidden" id="surfacearray_c" 	name="surfacearray_c" 	value="<?php echo $surface_array_c;?>" />
												<input type="hidden" id="surfacearray_s" 	name="surfacearray_s" 	value="<?php echo $surface_array_s;?>" />
												<input type="hidden" id="surfacearray_t" 	name="surfacearray_t" 	value="<?php echo $surface_array_t;?>" />
												<input type="hidden" id="surfaceloops" 		name="surfaceloops" 	value="<?php echo $surface_loops;?>" />
												<?php
												//	
												// FORM FOOTER
												//------------------------------------------------------------------------------------------\\
														$display_submit 		= 1;														// 1: Display Submit Button,	0: No
															$submitbuttonname	= 'Submit Changes';											// Name of the Submit Button
														$display_close			= 0;														// 1: Display Close Button, 	0: No
														$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
														$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
														
													include("includes/_template/_tp_blockform_form_footer.binc.php");
																				} 
																		}
																	?>
														</tr>
													</table>
													</form>
		<?php
									}
						//	}
				//	}
				} else {
						
					// Form has been submitted
					// There are two things that must be done initialy before we go off to the discrepancy page.
					// Step 1). Add the Inspection Header information to the database
			
					//$tmpdate 		= AmerDate2SqlDateTime($_POST['frmdate']);
					//$tmpdateclosed 	= AmerDate2SqlDateTime($_POST['frmdateclosed']);
					
					$tmpdate 		= ($_POST['frmdate']);
					$tmpdateclosed 	= ($_POST['frmdateclosed']);
			
					$sql = "UPDATE tbl_139_339_sub_n SET 139339_sub_n_type_cb_int='".$_POST['InspCheckList']."', 139339_sub_n_by_cb_int='".$_POST['inspector']."',139339_sub_n_date='".$tmpdate."',139339_sub_n_time='".$_POST['frmtime']."',139339_sub_n_metar='".$_POST['frmmetar']."',139339_sub_n_notes='".$_POST['frmnotes']."', 139339_sub_n_wx_in='".$_POST['139339_sub_n_wx_out']."', 139339_sub_n_fbo_in='".$_POST['139339_sub_n_fbo_out']."', 139339_sub_n_airline_in='".$_POST['139339_sub_n_airline_out']."' ";
					
					if ($tmpdateclosed == "") {
							//echo "Nothing of value";
						}
						else {
							$sql =  $sql.", 139339_sub_n_date_closed='".$tmpdateclosed."', 139339_sub_n_time_closed='".$_POST['frmtimeclosed']."' ";
						}		
					
					$sql = $sql." WHERE 139339_sub_n_id='".$_POST['recordid']."' ";
					
					//echo "<font size='4' color='#FFFFFF'> SQL Statement is: ".$sql."<br>";
					
					$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
					//mysql_insert_id();
						
					if (mysqli_connect_errno()) {
							// there was an error trying to connect to the mysql database
							//printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}		
						else {
						//mysql_insert_id();
							$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
							$changedid = mysqli_insert_id($mysqli);
						}
					
					// There is no easy way to manage the surface checklist items
					//	it may be easier to just delete all of the records associated with the NOTAM and recreate new surface records.
					//	deleting isn't a good thing though and should be avoided. 
					
					//	To avoid deleting records (very bad), let's build an array of ID values with their values on form creation and
					//	check to see if they are any different.
					
					//	Need to uncook the array and unload the transport.
					
					//echo "Baked POST Statement is: ".$_POST['surfacearray']." <br>";
					
					$surface_loops				= $_POST['surfaceloops'];
					
					$surface_array 				= str_replace("|", "\"",$_POST['surfacearray']);
					$surface_array 				= unserialize($surface_array);
					
					$surface_array_i 			= str_replace("|", "\"",$_POST['surfacearray_i']);
					$surface_array_i 			= unserialize($surface_array_i);
					$surface_array_c 			= str_replace("|", "\"",$_POST['surfacearray_c']);
					$surface_array_c 			= unserialize($surface_array_c);
					$surface_array_s 			= str_replace("|", "\"",$_POST['surfacearray_s']);
					$surface_array_s 			= unserialize($surface_array_s);
					$surface_array_t 			= str_replace("|", "\"",$_POST['surfacearray_t']);
					$surface_array_t 			= unserialize($surface_array_t);
					
					//$surface_array 			= serialize($surface_array);
					//$surface_array 			= str_replace("\"", "~",$surface_array);

					//echo "Uncooked POST Statement is: ".$surface_array." <br>";
					
					for ($i=0; $i<=($surface_loops); $i=$i+1) {
						
							//echo "Loop Increment 	: ".$i."<br>";
							//echo "Condition ID 	: ".$surface_array_i[$i]."<br>";
							//echo "Status 			: ".$surface_array_s[$i]."<br>";
							//echo "Field Name 		: ".$surface_array_t[$i]."<br>";	
							$sql = 1;

							if($surface_array_i[$i] == '') {
									//echo "No Surfaces on this Loop <br>";
								} else {
									//echo "An ID is given, conduct tests and things <br>";
									$status_new = $_POST[$surface_array_t[$i]];
									//echo "New STatus is: ".$status_new.", Old Status was: ".$surface_array_s[$i]."<br>";
									$status_diff = ($status_new - $surface_array_s[$i]);
									//echo "The difference between the status is: ".$status_diff."<br>";
									// EXAMPLES
									//	old (1) New (1) diff (0) 	-- Was closed, is still closed
									//	old (1) New (-) diff (-1) 	-- Was Closed, is now open
									//	old (0) New (1) diff (1) 	-- Was Open, is now closed
									//	old (0) New (0) diff (0)	-- Was Open, is still open
									switch($status_diff) {
										case -1:
												// Was Closed, is now open
												$sql = "UPDATE tbl_139_339_sub_n_cc SET 139339_cc_d_yn = 0 WHERE 139339_cc_id='".$surface_array_i[$i]."' ";
												break;
										case 1:
												// Was Open is now Closed
												$sql = "INSERT INTO tbl_139_339_sub_n_cc 	(139339_cc_c_cb_int,139339_cc_ficon_cb_int,139339_cc_d_yn, 139339_cc_a_yn) VALUES ('".$surface_array_c[$i]."', '".$_POST['recordid']."', 1, 0)";
												break;

										}
									// Run MySQL Statement
									
									//echo "<font size='4' color='#FFFFFF'>".$sql."</font>";
									
									if($sql == 1) {
											// Nothing to do here
										} else {
											//echo "SQL Statement is <font size='1'>".$sql."</font><br>";

											$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
											//mysql_insert_id();
												
											if (mysqli_connect_errno()) {
													// there was an error trying to connect to the mysql database
													//printf("connect failed: %s\n", mysqli_connect_error());
													exit();
												}		
												else {
												//mysql_insert_id();
													$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
													$changedid = mysqli_insert_id($mysqli);
												}
												
										}	// End of has SQL been changed....?
									
								}	// End of Surface change test
			
						}	// End of For Loop						
			
					// Display Summary Report
										
					$tblname		= "NOTAM Summary Report";
					$tblsubname		= "(summary of information)";

					// FORM HEADER
					// -----------------------------------------------------------------------------------------\\
							$formname			= "edittable";													// HTML Name for Form
							$formaction			= "";															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
							$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
								$formtarget		= "";															// HTML Name for the window
								$location		= $formtarget;													// Leave the same as $formtarget
					
					// FORM NAME and Sub Title
					//------------------------------------------------------------------------------------------\\
							$form_menu			= "Edit 339 b Inspection";										// Name of the FORM, shown to the user
							$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
							$subtitle 			= "Summary of information you provided";						// Subt title of the FORM, shown to the user

					// FORM SUMMARY information
					//------------------------------------------------------------------------------------------\\
							$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
								$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
								$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
								$detailtodisplay		= 0;													// See Summary Function for how to use this number
								$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
									
						include("includes/_template/_tp_blockform_form_header.binc.php");			
					
						// FORM ELEMENTS
						//-----------------------------------------------------------------------------------------\\	
						//
						//				Field Name			, Field Text Name	, Field Comment											, Field Notes											, Field Format					, Field Type	, Field Width	, Field Height	, Default Value			, Field Function		
						form_new_table_b($formname);
						form_new_control("inspector"		, "Entry By"		, "Who found and reported this discrepancy"				,"Your name has automatically been provided!"			,"(cannot be changed)"			, 3				, 0				, 0				, 'post'			,"systemusercombobox");
						form_new_control("InspCheckList"	, "Type"			, "Select the Species contained for this report"		,"Select from the list provided!"						,""								, 3				, 0				, 4				, 'post'			,"part139339typescombobox");
						form_new_control('frmmetar'			, 'Metar'			, 'Enter the current Metar'								,'The current metar has automatically been provided!'	, 'METAR'						, 1				, 0				, 0 			, 'post'			, 0);
						form_new_control('frmdate'			, 'Date'			, 'Enter the time this record was made'					,'The current date has automatically been provided!'	, 'MM/DD/YYYY'					, 1				, 0				, 0 			, 'post'			, 0);
						form_new_control('frmtime'			, 'Time'			, 'Enter the time this record was made'					,'The current time has automatically been provided!'	, '(hh:mm:ss) - 24 hour format'	, 1				, 0				, 0 			, 'post'			, 0);
						form_new_control('frmdateclosed'	, 'Date to Close'	, 'Enter the time this record was made'					,'The current date has automatically been provided!'	, 'MM/DD/YYYY'					, 1				, 0				, 0 			, 'post'			, 0);
						form_new_control('frmtimeclosed'	, 'Time to Close'	, 'Enter the time this record was made'					,'The current time has automatically been provided!'	, '(hh:mm:ss) - 24 hour format'	, 1				, 0				, 0 			, 'post'			, 0);
						form_new_control('139339_sub_n_wx_out', 'Wx Initials'	, 'Enter the Initails of Flight Service'				,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 0 			, 0 			, 'post'			, 0);
						form_new_control('139339_sub_n_fbo_out', 'FBO Initials'	, 'Enter the Initails of Flight Service'				,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 0				, 0 			, 'post'			, 0);
						form_new_control('139339_sub_n_airline_out', 'Airline Initials'	, 'Enter the Initails of Flight Service'		,'The current metar has automatically been provided!'	, 'Initials'					, 1				, 0				, 0 			, 'post'			, 0);
						form_new_control("frmnotes"			,"Comments"			, "Provide comments about this NOTAM"					,"Do not use any special characters!"					, ""							, 2				, 0				, 4				, 'post'			, 0);
					
					
						$formname = 'edittable';
						//
						// FORM FOOTER
						//------------------------------------------------------------------------------------------\\
								$display_submit 		= 0;														// 1: Display Submit Button,	0: No
									$submitbuttonname	= 'Start Edit of 327 Record';								// Name of the Submit Button
								$display_close			= 0;														// 1: Display Close Button, 	0: No
								$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
								$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
								$display_quickaccess	= 0;
								$display_printout		= 1;
									$printout_page		= 'part139339_b_report_display_new.php';
									$printout_id		= $_POST['recordid'];
									$printout_passed	= 'recordid';
								
							include("includes/_template/_tp_blockform_form_footer.binc.php");
				
				}
		}

// Define Variables...
//						for Auto Entry Function {End of Page}

		//$last_main_id	= $lastid;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>		