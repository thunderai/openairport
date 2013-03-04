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
		
		$inspection_id			= $_POST['recordid'];
		$last_main_id			= $inspection_id;				// Reset for AutoEntry Function Compatability
		$menuitemid 			= $_POST['menuitemid'];													
		$tblname				= $_POST['tblname'];													
		$tblsubname				= $_POST['tblsubname'];	

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 19;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 1;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions	

if (!isset($_POST["formsubmit"])) {
	// This FORM has not been submitted before
		
		// Template Form Modification (for AJAX Compatability)

		//echo "The form has not been submitted before, this is the first time displaying the form. <br>";				
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
			<td colspan="3" class="item_name_inactive">
				<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
					<tr>
						<?php
								// Hijack Template Functions for our own purposes
								$settingsarray 	= array("SELECT * FROM tbl_139_333_main_a WHERE 139333_a_inspection_id = ",	"139333",	"part139333_report_display_archived.php");
								$functionpage	= "part139333_report_archieved.php";														
								_tp_control_archived($inspection_id, $settingsarray, $functionpage);
								$settingsarray 	= array("SELECT * FROM tbl_139_333_main_e WHERE 139333_e_inspection_id = ",	"139333",	"part139333_report_display_error.php");
								$functionpage	= "part139333_report_error.php";														
								_tp_control_error($inspection_id, $settingsarray, $functionpage);	
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
								$form_menu			= "Edit 333 Inspection";										// Name of the FORM, shown to the user
								$form_subh			= "Please complete the form";									// Sub Name of the FORM, shown to the user
								$subtitle 			= "Use this form to edit the inspection";						// Subt title of the FORM, shown to the user

						// FORM SUMMARY information
						//------------------------------------------------------------------------------------------\\
								$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
									$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
									$idtosearch				= $_POST['recordid'];									// ID to look for in the summary function, this is typically $_POST['recordid'].
									$detailtodisplay		= 0;													// See Summary Function for how to use this number
									$returnHTML				= '';													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
										
							include("includes/_template/_tp_blockform_form_header.binc.php");			
							?>								
			<input type="hidden" name="formsubmit"	ID="formsubmit"	value="1">
			<input type="hidden" name="recordid"	ID="recordid" 	value="<?php echo $inspection_id;?>">
			<input type="hidden" name="inspector" 		id="inspector"		 	value="<?php echo $_SESSION['user_id'];?>">
							<?php
							form_new_table_b($formname);
							form_new_control("disdate"			,"Date"				, "Enter the date this discrepancy was found"															,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"				,1		,7		,0		,$objarray['139333_date']		,0);
							form_new_control("distime"			,"Time"				, "Enter the time this discrepancy was found"															,"The current time has automatically been provided!"	,"(hh:mm:ss) - 24 hours"	,1		,7		,0		,$objarray['139333_time']		,0);
							form_new_control("disauthor"		,"Entry By"			, "Who found and reported this discrepancy"																,"Your name has automatically been provided!"			,"(cannot be changed)"		,3		,40		,0		,$objarray['139333_by_cb_int']	,"systemusercombobox");
							form_new_control("distype"			,"Type"				, "Select the type of inspection"																		,"The current type has been selected automatically"		,"(cannot be changed)"		,3		,40		,0		,$objarray['139333_type_cb_int']	,"part139333typescombobox");
							form_new_control("diseditwhy"		,"Edit Why?"		, "Provide the reason why you are editing this inspection"												,"Do not use any special characters!"					,""							,2		,30		,4		,'I am editing this discrepancy because...'	,0);
							?>	
		<tr>
			<td colspan="6" align="center" valign="middle" />
				<table cellspacing="0" cellpadding="0" border="0" width="100%">		
					<tr>
						<td class="item_space_active">
								Equipment
							</td>					
						<td class="item_space_active">
						<?php
						// This is where our management DIV will be located (in the lower rows of this column).
						?>
								Manage Checklist Items
								</td>
							</tr>									
								<?php
								// In reality all we want to display here is one runway element heading and not all of the boxes.
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
			<td name="col_1_r<?php echo $tmpid;?>"
				id="col_1_r<?php echo $tmpid;?>"
				onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',2);" 
				onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',2);" 
				class="item_name_small_inactive"
				/>
				Runway Heading <?php echo $runwayheading;?>
				</td>		
			<td name="col_2_r<?php echo $tmpid;?>"
				id="col_2_r<?php echo $tmpid;?>"
				onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',2);" 
				onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',2);" 
				class="item_name_small_inactive"
				/>
				<?php
				// Display Open DIV button
				_tp_control_function_button_div('divform_'.$runwayheading,$en_managechecklist,'icon_window','divform_'.$runwayheading,'toggle','200','200');
				?>
				</td>
			</tr>
																<?php
																//echo "[18]. Now for some horribly inefficent stuff <br>";
																//echo "[19]. Locate only records for this equipment <br>";										
																//echo "[20]. Assemble the Array <br>";
																?>
		<tr>
			<td colspan="2">
				<div style="display: none"; name="divform_<?php echo $runwayheading ;?>_win" id="divform_<?php echo $runwayheading ;?>_win" >
																<?php
																
																//echo "inspect".$InspCheckList;
																if($InspCheckList == 1) {
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
																	
																if($InspCheckList == 3) {
																		// Hard Code Count!!! - EVIL
																		$numberofboxes 	= 2;
																		$helperimage	= 'images/Part_139_333/reilhelper.png';
																		$arunwayheading	= array($equipmenttype,$runwayheading,$numberofboxes);
																	}	
																//echo "test";	
																include("part139333_report_edit_blockform.php");
																?>
					</div>
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
	// FORM FOOTER
	//------------------------------------------------------------------------------------------\\
			$display_submit 		= 1;															// 1: Display Submit Button,	0: No
				$submitbuttonname	= 'Save Changes';												// Name of the Submit Button
			$display_close			= 0;															// 1: Display Close Button, 	0: No
			$display_pushdown		= 0;															// 1: Display Push Down Button, 0: No
			$display_refresh		= 0;															// 1: Display Refresh Button, 	0: No
			
		include("includes/_template/_tp_blockform_form_footer.binc.php");
							
					}
			}
	}
	else {
	
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
					<input type="hidden" name="recordid" 			value="<?php echo $_POST['recordid'];?>">
					<?php
					_tp_control_function_submit('printform','Print Report');
					?>
					</td>
					</form>
				</tr>
			</table>
			<?php
	$displayerrors = 0;	
		
	//errorreport("Start Saving Procedures...",$displayerrors);	
	
	//errorreport(".[1]. Update Main Table with new values...",$displayerrors);		
		
			//$tmpdate 	= AmerDate2SqlDateTime($_POST['frmdate']);
			$tmpdate 	= ($_POST['disdate']);

			$sql 		= "UPDATE `tbl_139_333_main` SET `139333_date`='".$tmpdate."',`139333_time`= '".$_POST['distime']."' WHERE	139333_main_id = '".$_POST['recordid']."' ";	
			$mysqli 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

			//errorreport(".[1].[1]. UPDATE Main Table with the following SQL Statement <font size='1'>".$sql."</font>...",$displayerrors);						
					
			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}		
				else {
				//mysql_insert_id();
					$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
					$lastid 		= mysqli_insert_id($mysqli);
					$lastNavAididi 	= mysqli_insert_id($mysqli);
					
					//errorreport(".[1].[2]. The Main Inspection ID <font size='1'>".$lastNavAididi."</font> has been updated...",$displayerrors);				
					}

	//errorreport(".[2]. Look through Inspection Condition Checklists and update records as needed...",$displayerrors);
				
			$sql = "SELECT * FROM tbl_139_333_sub_c_c 
					INNER JOIN tbl_139_333_sub_c ON tbl_139_333_sub_c.conditions_id = tbl_139_333_sub_c_c.conditions_checklists_condition_cb_int 
					WHERE conditions_checklists_inspection_cb_int = '".$_POST['recordid']."' ";
			
			$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			
			//errorreport(".[2].[1]. Loop through conditions with the Following SQL Statement <font size='1'>".$sql."</font>...",$displayerrors);	
			
			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}		
				else {
				
					$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
					
					//errorreport(".[2].[2]. Connection to Datbase Established...",$displayerrors);
						
					$counter = 0;	
						
					while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {		
							
							//errorreport(".[2].[3]. Within the While Loop Statement...",$displayerrors);
							
							$tmpid2 		= $objfields['conditions_id'];
							$tmpccid		= $objfields['conditions_checklists_id'];
							
							$fieldname 		= $tmpid2."_";
							
							//errorreport(".[2].[4]. Field Name is : ".$fieldname."...",$displayerrors);
							
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
								
									$cellnamec 			= $fieldname.'cb';
									$cellvaluec 		= $_POST[$cellnamec];
									$complatecellvalue 	= $cellvaluec;
								}
								
							//errorreport(".[2].[5]. Save completed value into an array...",$displayerrors);		
								
							$array_sub_c_c_id[$counter] 	= $tmpccid;
							$array_sub_c_c_values[$counter] = $complatecellvalue;
							
							//errorreport(".[2].[6]. ID is :".$array_sub_c_c_id[$counter]." Value is: ".$array_sub_c_c_values[$counter]." ",$displayerrors);		
							
							
							$counter = $counter + 1;	

							}	// End of While Loop
							
					}	// End of Object Record Set
					
			//errorreport(".[2].[7]. Loop through the array saving values as needed...",$displayerrors);		

			for ($j=0; $j<=count($array_sub_c_c_id); $j=$j+1) {			
					
					//errorreport(".[2].8]. In For Loop Update same Record?...",$displayerrors);		
						
					$array_value 	= $array_sub_c_c_values[$j];
					$array_id		= $array_sub_c_c_id[$j];
					
					//errorreport(".[2].[8]. The Array value is ".$array_value." ...",$displayerrors);	
					//errorreport(".[2].[9]. The Array ID is ".$array_id." ...",$displayerrors);	
						
					$sql2 		= "UPDATE `tbl_139_333_sub_c_c` SET `conditions_checklist_values` = '".$array_value."' WHERE `conditions_checklists_id` = '".$array_id."' ";	
					$objcon2 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
					//errorreport(".[2].[10]. The UPDATE SQL Statement is : <font size='1'>".$array_id." </font> ...",$displayerrors);	

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
				
	//errorreport(".[3]. Now for the Harder Stuff ...",$displayerrors);	
	//errorreport(".[3].[1]. Are there any new temporary discrepancies created by the NavAid Inspection Form? ...",$displayerrors);

			$sql = "SELECT * FROM tbl_139_327_sub_d_tmp WHERE discrepancy_madebynavaid = '1' ";
			$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			
			//errorreport(".[3].[2]. The SQL Statement is <font size='1'>".$sql."</font> ...",$displayerrors);
			
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

			//errorreport(".[3].[3]. There were ".$number_of_rows." discrepancies found ...",$displayerrors);

			if($number_of_rows > 0) {
					
					//errorreport(".[3].[4]. There is a need to either create a new Part 139.327 inspection or make modification to an exisiting one ...",$displayerrors);	
					
					$sql = "SELECT * FROM tbl_139_333_main WHERE 139333_main_id = '".$_POST['recordid']."' ";
					$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
					
					//errorreport(".[3].[5]. Look for information about existing 327 inspection with the following SQL Statement <font size='1'>".$sql."</font>...",$displayerrors);	
					
					if (mysqli_connect_errno()) {
							// there was an error trying to connect to the mysql database
							printf("connect failed: %s\n", mysqli_connect_error());
							exit();
						}		
						else {
						
							$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));

							while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {	
								
									$linked_327_int = $objfields['139333_linked_327_int'];
								}
						}
						
					if($linked_327_int == 0) {
							
							//errorreport(".[3].[6]. No Previous 327 inspection exisits, make a new one. <font size='1'>".$sql."</font>...",$displayerrors);	
						
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
						
						}
						else {
						
							//errorreport(".[3].[7]. A Previous Part 327 inspection exisits, create an error report for it and then add a discrepancy to it ...",$displayerrors);	
							//errorreport(".[3].[8]. Start with the error report ...",$displayerrors);	
							
									$sql = "INSERT INTO tbl_139_327_main_e (inspection_error_inspection_id, inspection_error_by_cb_int, inspection_error_reason, inspection_error_date, inspection_error_time, inspection_error_yn)
											VALUES ( '".$linked_327_int."', '".$_POST['inspector']."', 'Forced Error by Part 139.333 NavAid Inspection Edit (added Discrepancy)', '".$sqldate."', '".$_POST['frmtime']."', '1' )";
											
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
													$lastid = mysqli_insert_id($mysqli);
													}

									
							//errorreport(".[3].[9]. Loop through temporary discrepancies and add them to this inspection ID ...",$displayerrors);	
												
									$sql = "SELECT * FROM tbl_139_327_sub_d_tmp WHERE discrepancy_madebynavaid = 1";
									$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

									//errorreport(".[3].[10]. Loop through temporary discrepancies with the following SQL Statement <font size='1'>".$sql."</font> ...",$displayerrors);			
						
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}		
										else {
											$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
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
																		'".$linked_327_int."', 
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
															
															//errorreport(".[3].[11]. INSERT into discrepancy table with the following SQL Statement <font size='1'>".$sql."</font> ...",$displayerrors);			
						
															if (mysqli_connect_errno()) {
																	// there was an error trying to connect to the mysql database
																	printf("connect failed: %s\n", mysqli_connect_error());
																	exit();
																}		
																else {
																	$objrs2 			= mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
																	$newdiscrepancyid 	= mysqli_insert_id($objcon2);
																}										
										
															$sql2 = "SELECT * FROM tbl_139_327_sub_d_r_tmp WHERE discrepancy_repaired_inspection_id = '".$tmpinspectionsdarray[0]."' ";
															$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
															
															if (mysqli_connect_errno()) {
																	// there was an error trying to connect to the mysql database
																	printf("connect failed: %s\n", mysqli_connect_error());
																	exit();
																}		
																else {														
																	$ddr = 0;
																	$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
																	
																	while ($objfields = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
																	
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
											
																			$sql3 = "INSERT INTO tbl_139_327_sub_d_r (discrepancy_repaired_inspection_id, discrepancy_repaired_by_cb_int, discrepancy_repaired_comments, discrepancy_repaired_date, discrepancy_repaired_time, discrepancy_repaired_yn)
																			VALUES ( 	'".$newdiscrepancyid."', 
																						'".$tmpinspectionsdrarray[2]."', 
																						'".$tmpinspectionsdrarray[3]."', 
																						'".$tmpinspectionsdrarray[4]."', 
																						'".$tmpinspectionsdrarray[5]."',
																						'".$tmpinspectionsdrarray[6]."')";
																
																			$objcon3 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
																			
																			if (mysqli_connect_errno()) {
																					// there was an error trying to connect to the mysql database
																					printf("connect failed: %s\n", mysqli_connect_error());
																					exit();
																				}		
																				else {
																					$objrs3 = mysqli_query($objcon3, $sql3) or die(mysqli_error($objcon3));
																					$discrepancyrepairID = mysqli_insert_id($objcon3);
																				}	
																		$ddr = ($ddr + 1);	
																		}
																}
														$dd = ($dd + 1);	
														}
											
											
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

		//$last_main_id	= $last_main_id;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>		