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
//	Name of Document		:	part139303_c_enter_new_report.php
//
//	Purpose of Page			:	Enter New Part139.303 (c) Inspection
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/_template/template.list.php");


// Load Page Specific Includes

		include("includes/_modules/part139303/part139303.list.php");

// Define Variables	
		
		$navigation_page 			= 37;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 16;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures	
	
if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		?>
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" name="entryform">
		<input type="hidden" name="formsubmit"		id="formsubmit"			value="1">
		<input type="hidden" name="menuitemid" 		ID="menuitemid"			value="<?php echo $_POST['menuitemid'];?>">
		<input type="hidden" name="inspector" 		id="inspector"		 	value="<?php echo $_SESSION['user_id'];?>">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblbrowseformtable" />
		<tr>
			<td class="perp_menuheader" />
				<?php
				$menuname = getnameofmenuitemid_return_nohtml($strmenuitemid, "long", 4, "#FFFFFF",$_SESSION['user_id']);
				?>
				<?php echo $menuname;?>
				</td>			
			</tr>			
		<tr>
			<td class="perp_menusubheader" />
				(
				<?php 
				$menusubname = getpurposeofmenuitemid_return_nohtml($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
				echo $menusubname;
				?>
				)
				</td>				
			</tr>
		<tr>
			<td colspan="3" class="tablesubcontent">
				<table border="0" width="100%" cellspacing="0" cellpadding="0" id="table2" />
					<tr>
						<td class="item_name_active" />
							Type of Inspection
							</td>
						<td class="item_name_inactive" />
							<?php 
							part139303_c_typescombobox("all", "all", "InspCheckList", "show", "");
							?>
							</td>
						<td class="item_right_inactive" />
							<?php
							_tp_control_function_button_ajax('call_server_303c_checklist',$_SESSION['user_id'],'Get Checklist');
							_tp_control_function_submit('entryform');
							?>
							</td>
						</tr>
					<tr>
						<td colspan="3" id="CheckListData" class="ajax_results_area">
							<center>
								Click the <b>"Get Checklist"</b> button above to load the selected checklist. Once you click the button please wait a moment for the checklist to load.
								</center>
												<?php 
												for ($i=0; $i<50; $i=$i+1) {
														?>
							<br>
														<?php 
													}
												?>
							</td>
						</tr>					
					<tr>
						<td colspan="5" class="item_space_active" />
							<?php		
									$formname = 'entryform';
							//
							// FORM FOOTER
							//------------------------------------------------------------------------------------------\\
									$display_submit 		= 1;														// 1: Display Submit Button,	0: No
										$submitbuttonname	= 'Start Training Record';									// Name of the Submit Button
									$display_close			= 0;														// 1: Display Close Button, 	0: No
									$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
									$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
									$display_quickaccess	= 1;
									
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
	}
	else {
	
		// INSERT MAIN RECORD
		
		$tmpdate = AmerDate2SqlDateTime($_POST['frmdate']);
		
		$sql = "INSERT INTO tbl_139_303_c_main (139_303_type_cb_int,139_303_by_cb_int,139_303_date,139_303_time ) VALUES 
				( '".$_POST['InspCheckList']."', '".$_POST['inspector']."', '".$tmpdate."', '".$_POST['frmtime']."' )";
				
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
						$objrs 				= mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid 			= mysqli_insert_id($mysqli);
						$inspectiontmpid 	= $lastid;
						//echo $tmp;
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}		

		?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblbrowseformtable" />
		<tr>
			<td class="perp_menuheader" />
				<?php
				$menuname = getnameofmenuitemid_return_nohtml($strmenuitemid, "long", 4, "#FFFFFF",$_SESSION['user_id']);
				?>
				<?php echo $menuname;?>
				</td>			
			</tr>			
		<tr>
			<td class="perp_menusubheader" />
				(
				<?php 
				$menusubname = getpurposeofmenuitemid_return_nohtml($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
				echo $menusubname;
				?>
				)
				</td>				
			</tr>
		<tr>
			<td class="item_name_active">
				Additional Class Options
				</td>
			</tr>
		<tr>
			<td class="item_name_inactive">
				<table border="0" cellspacing="0" cellpadding="0" id="table2" align="left" valign="top"/>
					<tr>
						<?php
						$form_name		= 'dform';
						$random_element = rand(1,9999);
						$targetname 	= '_iframe-'.$form_name.'_'.$random_element;
						$dhtml_name 	= 'dhtmlwindow_'.$form_name.'_'.$random_element;
						?>
						<form style="margin-bottom:0;" action="part139303_c_upload_documents.php" method="POST" name="<?php echo $form_name;?>" id="<?php echo $form_name;?>" target="<?php echo $targetname;?>" onSubmit="<?php echo $dhtml_name;?>=dhtmlwindow.open('<?php echo $form_name;?>_<?php echo $random_element;?>', 'iframe', '', 'Upload Supporting Materials', 'width=450px,height=250px,resize=1,scrolling=1,center=1')" />
						<td class="item_name_active" align="left"/>
							<input type="hidden" name="conditionid" 		value="<?php echo $tmpid;?>">
							<input type="hidden" name="recordid" 			value="<?php echo $inspectiontmpid;?>">
							<input type="hidden" name="checklistid" 		value="<?php echo $lastchkid;?>">
							<input type="hidden" name="facilityid" 			value="<?php echo $tmpfacilityid;?>">
							<input type="hidden" name="conditionname" 		value="<?php echo $tmpcondname;?>">
							<input type="hidden" name="golive" 				value="1">
							<input type="hidden" name="inspectiontypeid" 	value="<?php echo $_POST['InspCheckList'];?>">
							<input NAME="targetname" ID="targetname"
								value="<?php echo $targetname;?>" 
								type="hidden" />
							<input NAME="dhtmlname" ID="dhtmlname"
								value="<?php echo $dhtml_name;?>" 
								type="hidden" />
							<?php
							_tp_control_function_button($form_name,'Upload Meeting Documents','icon_add','part139303_c_upload_documents.php',$targetname);
							?>
							</td>
							</form>
						<?php
						$form_name		= 'dform2';
						$random_element = rand(1,9999);
						$targetname 	= '_iframe-'.$form_name.'_'.$random_element;
						$dhtml_name 	= 'dhtmlwindow_'.$form_name.'_'.$random_element;
						?>	
						<form style="margin-bottom:0;" action="part139303_c_managestudents.php" method="POST" name="<?php echo $form_name;?>" id="<?php echo $form_name;?>" target="<?php echo $targetname;?>" onSubmit="<?php echo $dhtml_name;?>=dhtmlwindow.open('<?php echo $form_name;?>_<?php echo $random_element;?>', 'iframe', '', 'Upload Supporting Materials', 'width=600px,height=300px,resize=1,scrolling=1,center=1')" />
						<td class="item_name_active" />
							<input type="hidden" name="conditionid" 		value="<?php echo $tmpid;?>">
							<input type="hidden" name="recordid" 			value="<?php echo $inspectiontmpid;?>">
							<input type="hidden" name="checklistid" 		value="<?php echo $lastchkid;?>">
							<input type="hidden" name="facilityid" 			value="<?php echo $tmpfacilityid;?>">
							<input type="hidden" name="conditionname" 		value="<?php echo $tmpcondname;?>">
							<input type="hidden" name="golive" 				value="1">
							<input type="hidden" name="inspectiontypeid" 	value="<?php echo $_POST['InspCheckList'];?>">
							<input NAME="targetname" ID="targetname"
								value="<?php echo $targetname;?>" 
								type="hidden" />
							<input NAME="dhtmlname" ID="dhtmlname"
								value="<?php echo $dhtml_name;?>" 
								type="hidden" />
							<?php
							_tp_control_function_button($form_name,'Manage Student Attendance','icon_add','part139303_c_managestudents.php',$targetname);
							?>
							</td>
							</form>	
						</tr>
					</table>
				</td>
			<tr>
				<td class="item_name_active">
					Manage Subject Topic Groups
					</td>
				</tr>
		<tr>
			<td class="ajax_results_area">
				<table border="0" width="100%" cellspacing="0" cellpadding="0" id="table2" align="left" valign="top"/>
					<tr>
						<td class="item_name_active" />
								Focus Group (Regulation)
							</td>
						<td class="item_name_active" />
								Class Topic
							</td>
						<td class="item_space_active" />
								Taught ?
							</td>
						<td class="item_space_active" />
								Minutes
							</td>
						<td class="item_space_active" />
								Notes 
							</td>						
						</tr>
							
		<?php 										
		
		$sql = "SELECT * FROM tbl_139_303_c_sub_c 
				INNER JOIN tbl_139_303_c_sub_c_f ON tbl_139_303_c_sub_c_f.facility_id = tbl_139_303_c_sub_c.condition_facility_cb_int 
				WHERE condition_type_cb_int = '".$_POST['InspCheckList']."' AND condition_archived_yn = 0";
		
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		//mysql_insert_id();
				
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
								$tmpe			= $tmpstring."ze";
										
								if(!isset($_POST[$tmpa])) {
										// No variable exists
										$tmpacceptable		= 0;
									}
									else {
										// Variable Exists
										$tmpacceptable		= $_POST[$tmpa];
										}
										
								$tmp_displayrow = 1;
							
								if($tmpacceptable <> 1) {
										// The value is not 1, so the user has selected not to have this class taught.
									}
									else {
										// User has selected this class topic as being taught.  Save the record
										//	Save record
								
										$sql2 = "INSERT INTO tbl_139_303_c_sub_c_c (conditions_checklists_condition_cb_int,conditions_checklists_inspection_cb_int,conditions_checklist_discrepancy_yn, conditions_checklist_hours ) VALUES 
																				( '".$tmpid."', '".$inspectiontmpid."', '".$tmp_displayrow."', '".$_POST[$tmpe]."' )";
			
										$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
										//mysql_insert_id();
					
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
											
											?>
						<tr>
							<td class="item_name_small_inactive" />
								<?php echo $objfields['facility_name'];?>
								</td>
							<td class="item_name_small_inactive" />
								<?php echo $objfields['condition_name'];?>
								</td>
							<td class="item_space_inactive" />
								Yes
								</td>
							<td class="item_space_inactive" />
								<?php echo $_POST[$tmpe];?>
								</td>
							<?php
							$form_name		= 'dform3';
							$random_element = rand(1,9999);
							$targetname 	= '_iframe-'.$form_name.'_'.$random_element;
							$dhtml_name 	= 'dhtmlwindow_'.$form_name.'_'.$random_element;
							?>	
							<form style="margin-bottom:0;" action="part139303_c_discrepancy_report_new.php" method="POST" name="<?php echo $form_name;?>" id="<?php echo $form_name;?>" target="<?php echo $targetname;?>" onSubmit="<?php echo $dhtml_name;?>=dhtmlwindow.open('<?php echo $form_name;?>_<?php echo $random_element;?>', 'iframe', '', 'Manage Topic Notes', 'width=600px,height=300px,resize=1,scrolling=1,center=1')" />
							<td class="item_name_active" />
								<input type="hidden" name="conditionid" 		value="<?php echo $tmpid;?>">
								<input type="hidden" name="recordid" 			value="<?php echo $inspectiontmpid;?>">
								<input type="hidden" name="checklistid" 		value="<?php echo $lastchkid;?>">
								<input type="hidden" name="facilityid" 			value="<?php echo $tmpfacilityid;?>">
								<input type="hidden" name="conditionname" 		value="<?php echo $tmpcondname;?>">
								<input type="hidden" name="golive" 				value="1">
								<input type="hidden" name="inspectiontypeid" 	value="<?php echo $_POST['InspCheckList'];?>">
								<input NAME="targetname" ID="targetname"
									value="<?php echo $targetname;?>" 
									type="hidden" />
								<input NAME="dhtmlname" ID="dhtmlname"
									value="<?php echo $dhtml_name;?>" 
									type="hidden" />
								<?php
								_tp_control_function_button($form_name,'Manage Topic Notes','icon_add','part139303_c_discrepancy_report_new.php',$targetname);
								?>
								</td>
								</form>						
							</tr>
											<?php
									}
							}
					}
					?>
									
						<tr >
							<td colspan="5" name="addeddis" id="addeddis" class="item_name_active">
								<center>
									New Class Notes will be added here as you add new ones from the "Yes (manage)' from above
									</center>
					<?php 
					for ($i=0; $i<10; $i=$i+1) {
							?>
								<br>
							<?php 
						}
					?>
								</td>
							</tr>
						<form style="margin-bottom:0;" action="part139303_c_report_save_new.php" method="POST" name="printform" id="printform">
							<tr>
								<td colspan="5" align="center" valign="middle" class="item_name_active">
									Link unassociated Class Notes (Temporary from the Previous Page)
									</td>
								</tr>
							<?php
							//	List ALL discrepancies by THIS author in the temporary discrepancy folder for possible linking
							//	Mark all temporary discrepancies as linked by default
									
									$sql = "SELECT * FROM tbl_139_303_c_sub_d_tmp WHERE Discrepancy_by_cb_int = ".$_POST['inspector']."";
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
								<td colspan="5" align="center" valign="middle" class="item_name_active">
									<center>
										You have no class notes that need to be linked!
										</center>
									</td>
								</tr>
															<?php
														}
														?>
							<tr>
								<td colspan="4" class="item_name_active" />
									Class Note Name
									</td>
								<td class="item_name_active" />
									Add to Class Training Record
									</td>
								</tr>			
															<?php
															while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
																	$tmpsuppliedid 		= $objfields['Discrepancy_id'];
																	$tmpsuppliedname 	= $objfields['Discrepancy_name'];
																	$tmpvalue 			= (string) $tmpsuppliedid;
																	$tmpa 				= $tmpvalue."za";
																	$tmpd				= $tmpvalue."zd";
																	?>
							<tr>
								<td colspan="4" class="item_name_inactive" />
									<?php echo $tmpsuppliedname;?>
									</td>
								<td align="center" class="item_name_inactive" />
									<input class="commonfieldbox" type="checkbox" name="<?php echo $tmpd;?>" value="1" CHECKED>
									</td>
								</tr>
																	<?php
																}
														}
												}
												?>
							</table>
							</table>
						<table border="0" width="100%" cellspacing="0" cellpadding="0" id="table3" align="left" valign="top" class="item_name_active" />
							<tr>
								<td class="item_name_active" colspan="5">
									<input type="hidden" name="inspector"			value="<?php echo $_POST['inspector'];?>" />
									<input type="hidden" name="recordid" 			value="<?php echo $inspectiontmpid;?>" />
									<?php
									_tp_control_function_submit('printform');
									?>
									</td>
								</tr>
							</table>
							</form>
						</td>
					</tr>
				</table>
							<?php 
	
	}

// Establish Page Variables
		
		$last_main_id	= $lastid;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>