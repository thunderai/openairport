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
//	Name of Document		:	part139327_report_edit.php
//
//	Purpose of Page			:	Edit Existing Part139.327 Inspection
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

		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Define Variables	
		
		$tblname		= "Additional Options";
		$tblsubname		= "These additional options are avilable while editing this discrepancy";
		
		$i 						= "";
		$tmpvalue				= "";

// Collect POST Information
		
		$inspection_id			= $_POST['recordid'];
		$menuitemid 			= $_POST['menuitemid'];													
		$tblname				= $_POST['tblname'];													
		$tblsubname				= $_POST['tblsubname'];
		
if (!isset($inspection_id)) {
		// No Record ID Supplied, Crash Out
	}
	else {
		if (!isset($_POST["formsubmit"])) {
		
				////echo "The form has not been submitted before, this is the first time displaying the form. <br>";				
				$sql =" SELECT * FROM tbl_139_327_main WHERE inspection_system_id = ".$inspection_id."";
				////echo "Connect to database usining this SQL statement ".$sql." <br>";				
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
						$settingsarray 	= array("SELECT * FROM tbl_139_327_main_a WHERE inspection_archived_inspection_id = ",	"inspection",	"part139327_report_display_archived.php");
						$functionpage	= "part139327_report_archieved.php";														
						_tp_control_archived($inspection_id, $settingsarray, $functionpage);
						
						$settingsarray 	= array("SELECT * FROM tbl_139_327_main_e WHERE inspection_error_inspection_id = ",	"inspection",	"part139327_report_display_error.php");
						$functionpage	= "part139327_report_error.php";														
						_tp_control_error($inspection_id, $settingsarray, $functionpage);	
						
						?>														
						</tr>
					</table>
				</td>
			</tr>
		<tr>
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
								$form_menu			= "Edit 327 Inspection";										// Name of the FORM, shown to the user
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
			<input type="hidden" name="recordid"	ID="recordid" 	value="<?php echo $inspection_id;?>">
							<?php
							form_new_table_b($formname);
							form_new_control("disdate"			,"Date"				, "Enter the date this discrepancy was found"															,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"				,1		,7		,0		,$objarray['139327_date']		,0);
							form_new_control("distime"			,"Time"				, "Enter the time this discrepancy was found"															,"The current time has automatically been provided!"	,"(hh:mm:ss) - 24 hours"	,1		,7		,0		,$objarray['139327_time']		,0);
							form_new_control("disauthor"		,"Entry By"			, "Who found and reported this discrepancy"																,"Your name has automatically been provided!"			,"(cannot be changed)"		,3		,40		,0		,$objarray['inspection_completed_by_cb_int']	,"systemusercombobox");
							form_new_control("distype"			,"Type"				, "Select the type of inspection"																		,"The current type has been selected automatically"		,"(cannot be changed)"		,3		,40		,0		,$objarray['type_of_inspection_cb_int']	,"part139327typescombobox");
							form_new_control("diseditwhy"		,"Edit Why?"		, "Provide the reason why you are editing this inspection"												,"Do not use any special characters!"					,""							,2		,30		,4		,'I am editing this discrepancy because...'	,0);
							?>
			<td colspan="6" align="center" valign="middle" />
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td class="item_name_active">
							Facilities
							</td>
						<td class="item_name_active">
							Conditions
							</td>
						<td class="item_name_active">
							Acceptable
							</td>
						<td class="item_name_active">
							Discrepancy
							</td>
						</tr>
							<?php
							
							////echo "Connect to Condition Checklist to list exisiting checklist points <br>";
							$sql2 = "SELECT * FROM tbl_139_327_sub_c_c 
							INNER JOIN tbl_139_327_sub_c ON tbl_139_327_sub_c.conditions_id = tbl_139_327_sub_c_c.conditions_checklists_condition_cb_int 														
							WHERE conditions_checklists_inspection_cb_int = '".$inspection_id."' ";
							////echo "Connect with the following SQL Statement ".$sql2." <br>";
							$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
							
							if (mysqli_connect_errno()) {
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else {
									$res2 = mysqli_query($objcon2, $sql2);
									if ($res2) {
											$number_of_rows = mysqli_num_rows($res2);
											//printf("result set has %d rows. \n", $number_of_rows);
											while ($objfields2 = mysqli_fetch_array($res2, MYSQLI_ASSOC)) {
													$tmpchecklistid 	= $objfields2['conditions_checklists_id'];
													$tmpid				= $tmpchecklistid;
													$tmpconditionid		= $objfields2['conditions_checklists_condition_cb_int'];
													$tmpconditionname	= $objfields2['condition_name'];
													$tmpfacilitytype	= $objfields2['condition_facility_cb_int'];
													$tmpconditiontype	= $objfields2['condition_type_cb_int'];
													?>
					<tr>
	<tr>
		<td name="col_1_r<?php echo $tmpid;?>"
			id="col_1_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',4);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',4);" 
			class="item_name_small_inactive"
			/>
			&nbsp;
													<?php 
													part139327facilitycombobox($tmpfacilitytype, "all", "notused", "hide", "all");
													$tmpvalue 	= (string) $tmpconditionid;
													$tmpa 		= $tmpvalue."za";
													$tmpd		= $tmpvalue."zd";
													?>
			</td>
		<td name="col_2_r<?php echo $tmpid;?>"
			id="col_2_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',4);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',4);" 
			class="item_name_small_inactive"
			/>
			&nbsp;
			<?php echo $tmpconditionname;?>
			</td>					
		<td name="col_3_r<?php echo $tmpid;?>"
			id="col_3_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',4);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',4);" 
			class="item_name_small_inactive"
			/>					
			<input class="commonfieldbox" type="checkbox" name="<?php echo $tmpa;?>" value="1"
													<?php
													if ($objfields2['conditions_checklist_discrepancy_yn']==0) {
															?>
															CHECKED
															<?php
														}
													?>												
			/>
			</td>
		<td name="col_4_r<?php echo $tmpid;?>"
			id="col_4_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',4);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',4);" 
			class="item_name_small_inactive"
			/>			
			<input class="commonfieldbox" type="checkbox" name="<?php echo $tmpd;?>" value="1"
													<?php
													if ($objfields2['conditions_checklist_discrepancy_yn']==1) {
															?>
															CHECKED
															<?php
														}
													?>												
			/>
			<?php
			$target = 'adddiscrepancy';
			$action = 'part139327_discrepancy_report_new.php?recordid='.$inspection_id.'&golive=1&facility='.$tmpfacilitytype.'&condition='.$tmpconditionid.'&checklist='.$tmpconditiontype.'&checklist='.$InspCheckList.'&targetname='.$target.'&dhtmlname='.$target.'_var';
			_tp_control_function_button_iframe($target,'ADD','icon_add',$action,$target);
			?>
			</td>
		</tr>
																				<?php
																				$i = $i + 1;
																			}	// End of while loop
																	}	// end of Res Record Object						
															}	// End of Sucessful conection to database
													?>

													<?php
									} 	// End of While Statement
							}	// End on Existing object recordset
					?>
					<tr>
						<td colspan="5" class="item_space_active" />
							<?php		
									$formname = 'edittable';
							//
							// FORM FOOTER
							//------------------------------------------------------------------------------------------\\
									$display_submit 		= 1;														// 1: Display Submit Button,	0: No
										$submitbuttonname	= 'Start Edit of 327 Record';								// Name of the Submit Button
									$display_close			= 0;														// 1: Display Close Button, 	0: No
									$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
									$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
									$display_quickaccess	= 0;
									
								include("includes/_template/_tp_blockform_form_footer.binc.php");
								?>
							</td>
						</tr>	
					</table>
				</td>
			</tr>
		</table>
	</form>	
					<?php
					}	// End of Sucessful connection to Database
			}	// End of Test to see which form should be displayed
			else {
				?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblbrowseformtable" />
		<tr>
			<td colspan="3" class="perp_menuheader" />
				327 Inspection Edit Form
				</td>			
			</tr>			
		<tr>
			<td colspan="3" class="perp_menusubheader" />
				(
				Use this form to continue to make chanegs to the 327 Inspection Recorf
				)
				</td>				
			</tr>				
	<tr>
		<td colspan="3" class="item_name_inactive">
			Please complete the form below in as much detail as possible, and please pay close attention to syntax.
			</td>
		</tr>
	<tr>
		<td colspan="3" class="item_name_active">
			Create New Discrepancies
			</td>
		</tr>
	<tr>
		<td class="item_name_active" />
			Facility
			</td>
		<td class="item_name_active" />
			Condition
			</td>
		<td class="item_name_active" />
			Discrepancy
			</td>
		</tr>
		<?php										
		// Form has been submitted
		// There are two things that must be done initialy before we go off to the discrepancy page.
		// Step 1). Add the Inspection Header information to the database
		// Step 2). Add each checklist item to the database for that inspection.
		
		//echo "PART ONE: Update Inpsection Record Table with new values <br>";
		
		//$tmpdate = AmerDate2SqlDateTime($_POST['disdate']);
		$tmpdate =($_POST['disdate']);
		
		$sql = "UPDATE tbl_139_327_main SET type_of_inspection_cb_int='".$_POST['distype']."', inspection_completed_by_cb_int='".$_POST['disauthor']."', 139327_date='".$tmpdate."', 139327_time='".$_POST['distime']."' WHERE inspection_system_id=".$_POST['recordid'];
		
		//echo "[1][a][1] This is done with the following SQL Statement ".$sql." <br>";

		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						//echo "[1][a][2] Connection REJECTED <br>";
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {

						//echo "[1][a][2] Connection Established <br>";						
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid = mysqli_insert_id($mysqli);
						
						//echo "[1][a][2] The Inpsection has been updated with ID ".$lastid." <br>";
						}
		
		//echo "PART TWO: Find all Condition Checklists that are part of the inspection <br>";
		
		$sql = "SELECT * FROM tbl_139_327_sub_c_c WHERE conditions_checklists_inspection_cb_int=".$_POST['recordid'];
		
		//echo "[2][a][1] This is done with the following SQL Statement ".$sql." <br>";
		
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
				if (mysqli_connect_errno()) {
						//echo "[2][a][2] Connection REJECTED <br>";
						printf("connect failed: %s\n", mysqli_connect_error());
						
						exit();
					}		
					else {
					
						//echo "[2][a][2] Connection Established <br>";						
						$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						
						//echo "[2][a][3] Loop through Condition Checklists <br>";	
						
						while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								//echo "[2][a][4] For each record store values into temporary variables <br>";

								$tmpchecklistid 			= $objfields['conditions_checklists_id'];					// ID of COndition Checklist
								$tmpchecklistconditionid	= $objfields['conditions_checklists_condition_cb_int'];		// ID of Condition tbl_139_sub_c
								$tmpchecklistinspectionid	= $objfields['conditions_checklists_inspection_cb_int'];	// ID of inspection tbl_139_327_main
								$tmpchecklistdiscrepancy	= $objfields['conditions_checklist_discrepancy_yn'];		// 1/0 value of discrepancy
								$tmpstring	 				= (string) $tmpchecklistconditionid;
								$tmpa 						= $tmpstring."za";
								$tmpd						= $tmpstring."zd";
							
								//echo "[2][a][5] Form Field for boxes Acceptable ".$tmpa." / Discrepancy ".$tmpd." <br>";

								if(!isset($_POST[$tmpd])) {
										////echo "No variable exists (tmpd)";
										$tmpdiscrepancy		= 0;
									}
									else {
										////echo "variable exists (tmpd)";
										$tmpdiscrepancy		= $_POST[$tmpd];
										}
										
								if(!isset($_POST[$tmpa])) {
										////echo "No variable exists (tmpa)";
										$tmpacceptable		= 0;
									}
									else {
										////echo "variable exists (tmpa)";
										$tmpacceptable		= $_POST[$tmpa];
										}
								
								if($tmpacceptable == 0) {
										// there are no discrepancies
										$tmpvalue	= 0;
										if ($tmpdiscrepancy == 0) {
												// Both are negative, what gives
												$tmpvalue 	= 0;
											}
											else {
												// tmpdiscrepancy is not equal to zero
												$tmpvalue	= 1;
											}
									}
									else {
										//$tmpvalue = 1;
									}
								if ($tmpvalue=="") {
										$tmpvalue = 0;
									}
									
								//echo "[2][a][6] Temp Value is ".$tmpvalue." <br>";								
								//echo "[2][b][1] Update the Condition Checklist as needed <br>";
								
								$sql2 = "UPDATE tbl_139_327_sub_c_c SET conditions_checklists_condition_cb_int='".$tmpchecklistconditionid."', conditions_checklists_inspection_cb_int='".$_POST['recordid']."', conditions_checklist_discrepancy_yn='".$tmpvalue."' WHERE conditions_checklists_id=".$tmpchecklistid;
								
								//echo "[2][b][2] UPDATE using the following SQL Statement ".$sql2." <br>";
								
								$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
								if (mysqli_connect_errno()) {
										//echo "[2][b][3] Connection REJECTED <br>";
										printf("connect failed: %s\n", mysqli_connect_error());
										exit();
									}		
									else {
										//echo "[2][b][3] Connection Established <br>";
										$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));										
										$lastchkid = mysqli_insert_id($objcon2);
										
										//echo "[2][b][4] The Condition Checklist has been updated with ID ".$lastchkid." <br>";
										
									}
										
										if ($tmpvalue==1) {
										
												//echo "[2][c][1] Show Discrepancies part of the inspection <br>";
												
												$sql3 = "SELECT * FROM tbl_139_327_sub_c WHERE conditions_id = '".$tmpchecklistconditionid."'";
												
												//echo "[2][c][2] UPDATE using the following SQL Statement ".$sql3." <br>";
												
												$objcon3 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
														
												if (mysqli_connect_errno()) {
														//echo "[2][c][3] Connection REJECTED <br>";
														printf("connect failed: %s\n", mysqli_connect_error());
														exit();
													}		
													else {
														//echo "[2][c][3] Connection Established <br>";
														
														$objrs3 = mysqli_query($objcon3, $sql3) or die(mysqli_error($objcon3));
														
														//echo "[2][d][1] Loop through Conditions <br>";
														
														while ($objfields3 = mysqli_fetch_array($objrs3, MYSQLI_ASSOC)) {
														
																//echo "[2][d][2] Store values into temporary variables <br>";
														
																$tmpfacilityid		= $objfields3['condition_facility_cb_int'];
																$tmpid 				= rand(1,9999);
																$tmpcondname		= $objfields3['condition_name'];
																$tmpcond_record_id	= $objfields3['conditions_id'];
															}
													}
													?>
	<tr>
		<td name="col_1_r<?php echo $tmpid;?>"
			id="col_1_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',3);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',3);" 
			class="item_name_small_inactive"
			/>
			<?php
			part139327facilitycombobox($tmpfacilityid, "all", "notused", "hide", "all");
			?>
		<td name="col_2_r<?php echo $tmpid;?>"
			id="col_2_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',3);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',3);" 
			class="item_name_small_inactive"
			/>
			<?php echo $tmpcondname;?>
			</td>													
		<?php
		$form_name		= 'dform3';
		$random_element = rand(1,9999);
		$targetname 	= '_iframe-'.$form_name.'_'.$random_element;
		$dhtml_name 	= 'dhtmlwindow_'.$form_name.'_'.$random_element;
		?>														
		<form style="margin-bottom:0;" action="part139327_discrepancy_report_new.php" method="POST" name="<?php echo $form_name;?>" id="<?php echo $form_name;?>" target="<?php echo $targetname;?>" onSubmit="<?php echo $dhtml_name;?>=dhtmlwindow.open('<?php echo $form_name;?>_<?php echo $random_element;?>', 'iframe', '', 'Add Discrepancy', 'width=600px,height=300px,resize=1,scrolling=1,center=1')" />
		<td name="col_3_r<?php echo $tmpid;?>"
			id="col_3_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',3);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',3);" 
			class="item_name_small_inactive"
			/>
			<input type="hidden" name="conditionid" 		value="<?php echo $tmpcond_record_id;?>" />
			<input type="hidden" name="recordid" 			value="<?php echo $inspection_id;?>" />
			<input type="hidden" name="checklistid" 		value="<?php echo $tmpcond_record_id;?>" />
			<input type="hidden" name="facilityid" 			value="<?php echo $tmpfacilityid;?>">
			<input type="hidden" name="conditionname" 		value="<?php echo $tmpcondname;?>">
			<input type="hidden" name="inspectiontypeid" 	value="<?php echo $_POST['distype'];?>" />
			<input NAME="targetname" ID="targetname"
				value="<?php echo $targetname;?>" 
				type="hidden" />
			<input NAME="dhtmlname" ID="dhtmlname"
				value="<?php echo $dhtml_name;?>" 
				type="hidden" />
			<?php
			_tp_control_function_button($form_name,'Manage Discrepancies','icon_add','part139327_discrepancy_report_new.php',$targetname);
			?>	
			</td>
		</form>
		</tr>
											<?php
												}	// End of tmpvalue =1
							$tmpvalue 			= "";
							$tmpacceptable		= "";
							$tmpdiscrepancy		= "";
							}	// End of while loop
							
							?>
	<tr>
		<td colspan="3" class="perp_menuheader" />
			Discrepancies Added for this Inspection
			</td>
		</tr>
	<tr>
		<td colspan="3" class="perp_menusubheader" />
			Added Discrepancies will be shown below as they are added
			</td>
		</tr>							
	<tr >
		<td colspan="3" name="addeddis" id="addeddis" class="item_name_inactive">
			New Discrepancies will be added here as you add new ones from the "Manage Discrepancies" button from above in any Facility
			<?php 
			for ($i=0; $i<5; $i=$i+1) {
					?>
						<br>
					<?php 
				}
			?>				
			</td>
		</tr>	
	<tr>
		<td colspan="3" class="perp_menuheader" />
			Link Discrepancies to this Inspection
			</td>
		</tr>
	<tr>
		<td colspan="3" class="perp_menusubheader" />
			Any applicable discrepancies that can be linked will be displayed here
			</td>
		</tr>
	<form style="margin-bottom:0;" action="part139327_report_save_edit.php" method="POST" name="printform" id="printform">
							<?php
							//	List ALL discrepancies by THIS author in the temporary discrepancy folder for possible linking
							//	Mark all temporary discrepancies as linked by default
									
									$sql = "SELECT * FROM tbl_139_327_sub_d_tmp WHERE Discrepancy_by_cb_int = ".$_POST['inspector']."";
									$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									if (mysqli_connect_errno()) {
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}
										else {
											$objrs_support = mysqli_query($objconn_support, $sql);
											if ($objrs_support) {
													$number_of_rows = mysqli_num_rows($objrs_support);
													if ($number_of_rows == 0) {
															?>
	<tr>
		<td colspan="3" class="item_space_inactive">
			There are no discrepancies that can be linked to this inspection
			</td>
		</tr>
															<?php
														} else {
														?>
	<tr>
		<td class="item_name_active" />
			Discrepancy Name
			</td>
		<td class="item_name_active" />
			Priority
			</td>
		<td class="item_name_active" />
			Add to Inspection
			</td>
		</tr>			
															<?php
															}
															while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
																	$tmpsuppliedid 		= $objfields['Discrepancy_id'];
																	$tmpsuppliedname 	= $objfields['Discrepancy_name'];
																	$tmpsuppliednames 	= $objfields['discrepancy_priority'];
																	$tmpvalue 			= (string) $tmpsuppliedid;
																	$tmpa 				= $tmpvalue."za";
																	$tmpd				= $tmpvalue."zd";
																	$tmpid 				= rand(1,9999);
																	?>
	<tr>
		<td name="col_1_r<?php echo $tmpid;?>"
			id="col_1_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',3);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',3);" 
			class="item_name_small_inactive"
			/>
			<?php echo $tmpsuppliedname;?>
			</td>
		<td name="col_2_r<?php echo $tmpid;?>"
			id="col_2_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',3);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',3);" 
			class="item_name_small_inactive"
			/>
			<?php echo $tmpsuppliednames;?>
			</td>
		<td name="col_3_r<?php echo $tmpid;?>"
			id="col_3_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',3);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',3);" 
			class="item_name_small_inactive"
			/>
			<input class="commonfieldbox" type="checkbox" name="<?php echo $tmpd;?>" value="1" CHECKED>
			</td>
		</tr>
																	<?php
																}
														}
												}
												?>
	</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0" id="table3" align="left" valign="top" class="item_name_active" />
	<tr>
		<td class="item_name_active" colspan="3">
			<input type="hidden" 		name="recordid"			id="recordid"		value="<?php echo $inspection_id;?>">
			<input type="hidden"		name="strmenuitemid"	id="strmenuitemid" 	value="<?php echo $strmenuitemid;?>">
			<input type="hidden"		name="frmstartdate"		id="frmstartdate" 	value="<?php echo $frmstartdate;?>">
			<input type="hidden"		name="frmenddate"		id="frmenddate" 	value="<?php echo $frmenddate;?>">
			<input type="hidden" 		name="inspector"							value="<?php echo $_POST['inspector'];?>" />
			<?php
			_tp_control_function_submit('printform','Save Progress and Continue');
			?>
			</td>
		</tr>
	</table>
							<?php
					}	// End of good connection					
					
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor	= $_SESSION["user_id"];
		$dutylogevent	= "Edited record ID:".$inspection_id." in table tbl_139_327_main";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);

		
		// Populate an error report
		
		$sql = "INSERT INTO tbl_139_327_main_e (inspection_error_inspection_id, inspection_error_by_cb_int, inspection_error_reason, inspection_error_date, inspection_error_time, inspection_error_yn)
		VALUES ( '".$_POST['recordid']."', '".$_POST['disauthor']."', '".$_POST['diseditwhy']."', '".$sqldate."', '".$_POST['distime']."', '1' )";
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
						
			}	// End of Summary Page
	}	// End of inspectionid

	include("includes/_userinterface/_ui_footer.inc.php");		// include file that gets information from form POSTs for navigational purposes
?>