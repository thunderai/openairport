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
//	Name of Document		:	part139327_discrepancy_report_display_mapit_chart.php
//
//	Purpose of Page			:	View Part 139.327 Discrepancy Location(s) Chart
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load global include files
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes
		//include("includes/_dateandtime/dateandtime.list.php");
		include("scripts/_scripts_header_iface.inc.php");
		//include("includes/AutoEntryFunctions.php");
		//include("includes/_systemusers/systemusers.list.php");
		include("includes/_modules/part139327/part139327.list.php");
		//include("includes/_navigation/navigation.list.php");
		//include("includes/_generalsettings/generalsettings.list.php");					// Load GIS Functions
		include("includes/_template/template.list.php");
		
		?>
	<div style="position:absolute; z-index:1; left:3px; top:84px; width:<?php echo $maparray[1][1];?>px;" align="left" />
		<img src="images/part_139_327/<?php echo $maparray[3][0];?>" width="<?php echo $maparray[1][1];?>" height="<?php echo $maparray[1][2];?>" />
		</div>
	<div style="position:absolute; z-index:2; left:0px; top:30px; width:<?php echo $maparray[2][1];?>px;" align="left" />
		<img src="images/part_139_327/<?php echo $maparray[2][0];?>" width="<?php echo $maparray[2][1];?>" height="<?php echo $maparray[2][2];?>" />
		</div>
		
<?php
// Define Variables	
		
		$navigation_page 			= 16;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 13;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures	

// Define Variables	

		/* 					<input type="hidden" NAME="getsd" 			ID="getsd" 			value="<?php echo $start_date;?>">
							<input type="hidden" NAME="geted" 			ID="geted" 			value="<?php echo $end_date;?>"> */
		//					Field Name			Field Text Name				Field Comment						Field Notes												Field Format		Field Type	Field Width		Field Height	Default Value			Field Function		
		// form_new_control("frmstartdate"		,"Date"						, "Enter the the date to start from","The current date has automatically been provided!"	,"(mm/dd/yyyy)"		,1			,10				,0				,"current"				,0);
		// form_new_control("frmenddate"		,"Date"						, "Enter the the date to end at"	,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"		,1			,10				,0				,"current"				,0);
		// form_new_control("discondition"		,"Condition"				, "Select a Condition"				,"Select a condition from the list provided!"			,""					,3			,50				,0				,"all"					,"part139327conditionscomboboxwall");
		// form_new_control("disfacility"		,"Facility"					, "Select a Facility"				,"Select a Facility from the list provided!"			,""					,3			,35				,4				,"all"					,"part139327facilitycomboboxwall");
		// form_new_control("disinspection"		,"From Inspection of Type"	, "Select an Inspection Type"		,"Select an inspection from the list provided!"			,""					,3			,35				,4				,"all"					,"part139327typescomboboxwall");
		// form_new_control("disusebrowser"		,"Use Browser Settings"		, "Use Broser Settings or override"	,"Checking this box will use the dates above, unchecked will use the dates from the browser form"		,""					,5			,50				,0				,"all"					,0);
		//	

	//Get Information from the FORM
		
		$tmprecord 		= $_POST['recordid'];
		
	// Convert start date and end date into sql format

		$notlimited_p1 = 0;
		$notlimited_p1 = 0;
		$notlimited_p1 = 0;
		
		$tmpdate		= date('m-d-Y');
		$displayrow		= 0;
		$OffSetX 		= -20;
		$OffSetY 		= 70;
		$tmpzindex		= 14;
		
		$internal_counter	= 0;
		$disarray_id			= array();
		$disarray_name			= array();
		$disarray_remarks			= array();
		$isarchived			= "";
		$isduplicate		= "";
		$displaydatarow		= "";
		$displaydiscrepancy = "";
		
		$i					= "";
		
	// Determine which Date Grouping we are using
		
		$tmptime = date('H:m:s');
		
		$use_start_date = 'all time';
		$use_end_date 	= 'all time';

		//					Filed Name / Variable				b	f	h	j		w		x		y	z
		//displaytxtonreport($objarray['Discrepancy_id'], 		1, 1, 30, "right", 	30, 	690, 	0, 	3); <-- Don't need this
		displaytxtonreport("Discrepancy Locations", 			1, 5, 30, "center", 713, 	0, 		0, 	4);	
		displaytxtonreport("DATE", 								1, 3, 13, "left", 	190, 	5, 		32, 5);	
		displaytxtonreport($tmpdate, 							1, 3, 13, "left", 	190, 	95, 	32, 6);	
		displaytxtonreport("START DATE",	 					1, 3, 13, "left", 	190, 	290, 	32, 7);		
		displaytxtonreport($use_start_date,						1, 3, 13, "left", 	190, 	395, 	32, 8);		
		displaytxtonreport("TIME",								1, 3, 13, "left", 	190, 	5, 		52, 9);		
		displaytxtonreport($tmptime,							1, 3, 13, "left", 	30, 	95, 	52, 10);	
		displaytxtonreport("END DATE",							1, 3, 13, "left", 	190, 	290, 	52, 11);
		displaytxtonreport($use_end_date,						1, 3, 13, "left", 	190, 	395, 	52, 8);	
		
		displaytxtonreport("Here is a map of the selected discrepancies",		1, 1, 50, "right", 	132, 	611, 	27, 12);
					
	// Make sql Statement
		$sql = "SELECT * FROM tbl_139_327_sub_d 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d.Discrepancy_by_cb_int 
		INNER JOIN tbl_139_327_main 	ON tbl_139_327_main.inspection_system_id = tbl_139_327_sub_d.Discrepancy_inspection_id 
		INNER JOIN tbl_139_327_sub_t 	ON tbl_139_327_sub_t.inspection_type_id = tbl_139_327_main.type_of_inspection_cb_int 
		INNER JOIN tbl_139_327_sub_c 	ON tbl_139_327_sub_c.conditions_id = tbl_139_327_sub_d.discrepancy_checklist_id
		INNER JOIN tbl_139_327_sub_c_f 	ON tbl_139_327_sub_c_f.facility_id = tbl_139_327_sub_c.condition_facility_cb_int 
		INNER JOIN tbl_general_conditions ON tbl_general_conditions.general_condition_id = tbl_139_327_sub_d.discrepancy_priority 
		ORDER BY tbl_139_327_sub_d.Discrepancy_inspection_id";
			
	//make connection to database
		$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs = mysqli_query($objconn, $sql);
	
			if ($objrs) {
					$totalnumberofdiscrepancies = mysqli_num_rows($objrs);
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
					
							$displayrow					= 1;
							$displayrow_a				= 0;
							$displayrow_d				= 0;
					
							$tmpdiscrepancyid			= $objarray['Discrepancy_id'];
							$tmpdiscrepancycondition	= $objarray['discrepancy_checklist_id'];	
							
							$displayrow_a				= preflights_tbl_139_327_main_sub_d_a_yn($tmpdiscrepancyid,0); // 1 will not return a row even if it is archieved.
							$displayrow_d				= preflights_tbl_139_327_main_sub_d_d_yn($tmpdiscrepancyid,0); // 1 will not return a row even if it is duplicate.

							//echo "Display A ".$displayrow_a." / Display D ".$displayrow_d." <br>";
							
							if($displayrow_a == 0 OR $displayrow_d == 0) {
										// display nothing
										$displayrow = 0;
									}
									else {
										// Check Status of this Discrepancy, ie. Get the current stage
										
										$status 		= part139327discrepancy_getstage($tmpdiscrepancyid, 0, 0, 0, 0);
										// OUTPUT	
										// Status:
										//				0 - NO HISTORY, Requires a Work Order (ie. needs to be repaired)
										//				1 - Needs to be Repaired (is currently bounced)
										//				2 - Needs to be Bounced (is currently repaired)
										//				3 - Closed
										
										//echo "Status is [".$status."], Record is [".$tmprecord."] <br>";
										
										if($tmprecord == 'all') {
												// Display
												$displayrow = 1;
											} else {
												if($status == $tmprecord) {
														// Display
														//echo "Status is Equal to Record Display <br>";
														$displayrow = 1;
													} else {
														$displayrow = 0;
													}
											}
										
										$style_bk		= array('red','yellow','green','blue');
										$style_root		= 'table_dashpanel_container_summary_';
										
										//echo $status.'<br>';
									}	// End of Display This Discrepancy Loop/Test
									
									
									if($displayrow == 1) {
										
											$tempX		= 580;
											$tempY		= 155;
											$tmpzindex 	= 14;
									
											$disx		= convertfromlargescale_to_smallscale_x($objarray['Discrepancy_location_x'],$maparray);
											$disy		= convertfromlargescale_to_smallscale_y($objarray['Discrepancy_location_y'],$maparray);
											
											$disid		= $objarray['Discrepancy_id'];
											$disname 	= $objarray['Discrepancy_name'];
											$disremarks = $objarray['discrepancy_remarks'];
											
											$disarray_id[$internal_counter] 		= $disid;
											$disarray_name[$internal_counter] 		= $disname;
											$disarray_remarks[$internal_counter] 	= $disremarks;
											
											part139327discrepancydisplaybox("Targets Only", 1, 2, 30, "left", 100, $tempX, $tempY, $tmpzindex, $disid, $disname, $disremarks, $disx, $disy);
										
											$internal_counter = $internal_counter + 1;
											
											//echo $status.'<br>';
										}
								
								}
							$displayrow				= 0;		
							$isduplicate			= "";
							$isarchived				= "";
							$displaydiscrepancy		= "";
							$displaydatarow			= "";							
						}	// End of discrepancy While Loop
				}	// End of active object connection
		
		
?>
	<div style="position:absolute; z-index:13; left:10px; top:450px; width:400px;" align="left" />
		<table border="1" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse" borderCOLOR="#000000" />
			<tr>
				<td bgcolor="#000000" colspan="4" align="center" valign="middle" height="30" />
					<font color="#FFFFFF" size="4" />
					<?php
					switch($tmprecord) {
						case 'all':
							// Display all Discrepancies
							$message = "ALL DISCREPANCIES";
							break;
						case 0:
							// Has no history
							$message = "Discrepacnies that need Repair";
							break;
						case 1:
							//				1 - Needs to be Repaired (is currently bounced)
							$message = "Discrepacnies that need Repair";
							break;
						case 2:
							//				2 - Needs to be Bounced (is currently repaired)
							$message = "Discrepacnies that need to be Closed or Bouned";
							break;
						case 3:
							//				3 - Closed
							$message = "Closed Discrepancies";			
							break;
						}
						?>
						<?php echo $message;?>
						</font>
					</td>
				</tr>		
			<tr>
				<td width="35px" align="centeR" valign="middle" bgcolor="#C8C8C8" />
					ID
					</td>
				<td align="centeR" valign="middle" bgcolor="#C8C8C8"  />
					Name
					</td>					
				<td align="centeR" valign="middle" bgcolor="#C8C8C8" />
					Remarks
					</td>
				<td width="90px" align="centeR" valign="middle" bgcolor="#C8C8C8"/>
					Commands
					</td>					
				</tr>			
<?php
		if(count($disarray_id) == 0) {
				?>
			<tr>
				<td colspan="4" align="center" valign="middle" width="25" bgcolor="#FFFFFF" />
					<font size="2" color="#000000" />
						<b>
							No Discrepancies
							</b>
						</font>
					</td>
				</tr>
				<?php
			}
				

		//Loop Through Discrepancy Array
		for($i=0;$i<count($disarray_id);$i++) {
			$disid	= $disarray_id[$i];
			$tmpdiscrepancyid = $disarray_id[$i];
			?>
	<tr>
		<td bgcolor="#FFFFFF" align="centeR" valign="middle" />
			<font size="1" color="#000000" />
				<?php echo $disarray_id[$i];?>
				</font>
			</td>
		<td bgcolor="#FFFFFF" align="left" valign="middle" />
			<font size="1" color="#000000" />
				&nbsp;<?php echo $disarray_name[$i];?>
				</font>
			</td>
		<td bgcolor="#FFFFFF" align="left" valign="middle" />
			<font size="1" color="#000000" />
				&nbsp;<?php echo $disarray_remarks[$i];?>
			</td>
		<td height="30px" bgcolor="#FFFFFF" align="centeR" valign="middle" onmouseover="" style="cursor: pointer;"
			onclick="divwin=dhtmlwindow.open('discrepancycontrol_div<?php echo $disid;?>', 'div', '327d_control_<?php echo $tmpdiscrepancyid;?>', 'Discrepancy Options for Discrepancy <?php echo $disid;?>', 'width=350px,height=200px,left=200px,top=150px,resize=1,scrolling=0,center=1'); return false;" 
			/>
			<div name="327d_control_<?php echo $tmpdiscrepancyid;?>" id="327d_control_<?php echo $tmpdiscrepancyid;?>" style="display:none;text-align:left;vertical-align:text-top;" />
			
			<?php
			// Load Workorder Controls
			// Lie to the blockform
			$disid					= $tmpdiscrepancyid;
			$status 				= part139327discrepancy_getstage($disid, 0, 0, 0, 0);
			$imclearlyahijacker		= 1;
			$functionworkorderpage 	= 1;
			$functionworkorderpage	= 'part139327_discrepancy_report_display_workorder.php';
			$functionrepairpage		= 'part139327_discrepancy_report_repair.php';
			$functionbouncepage		= 'part139327_discrepancy_report_bounce.php';
			$functionclosedpage		= 'part139327_discrepancy_report_closed.php';
			$array_repairedcontrol	= array(0,0,'part139327_discrepancy_report_display_repaired.php');
			$array_bouncedcontrol	= array(0,0,'part139327_discrepancy_report_display_bounced.php');
			$array_closedcontrol	= array(0,0,'part139327_discrepancy_report_display_closed.php');
			$has_been_bounced 		= preflights_tbl_139_327_main_sub_d_b_yn($disid,1);
			$has_been_closed 		= preflights_tbl_139_327_main_sub_d_c_yn($disid,1);
			$has_been_repaired 		= preflights_tbl_139_327_main_sub_d_r_yn($disid,1);
			$grid_or_row			= '';
			//echo "Been Bounced 	: ".$has_been_bounced." 	<br>";
			//echo "Been Closed 	: ".$has_been_closed." 		<br>";
			//echo "Been Repaired 	: ".$has_been_repaired." 	<br>";
				
				
			// Utilize our lies
			?>
				<table width="100%" class="perp_mainmenutable" cellpadding="0" cellspacing="0"/>
					<tr>
						<td class="perp_menuheader" height="12" />
							Discrepancy Controls
							</td>			
						</tr>			
					<tr>
						<td class="perp_menusubheader" />
							Additional Options
							</td>				
						</tr>
					<tr>
						<td align="left" valign="top" />
							<?php
							include("includes/_template/_tp_blockform_workorder_browser.binc.php");	
							?>
							<?php
							include_ONCE("includes/_template/template.list.php");
							$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_archived.php");
							$functionpage	= "part139327_discrepancy_report_archieved.php";														
							_tp_control_archived($objarray['Discrepancy_id'], $settingsarray, $functionpage);
							$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_duplicate.php");
							$functionpage	= "part139327_discrepancy_report_duplicate.php";														
							_tp_control_duplicate($objarray['Discrepancy_id'], $settingsarray, $functionpage);
							$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_e WHERE discrepancy_error_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_error.php");
							$functionpage	= "part139327_discrepancy_report_error.php";														
							_tp_control_error($objarray['Discrepancy_id'], $settingsarray, $functionpage);	
							?>
							</td>
						</tr>
					<tr>
						<td class="item_name_active" height="32" />
							<table 	name="MenuItem_MClose" id="MenuItem_MClose" 
									border="0" 
									cellpadding="0" 
									cellspacing="0" 
									class="perp_mainmenubutton" />
								<tr>			
									<td name="OSpace_MClose<?php echo $disid;?>" id="OSpace_MClose<?php echo $disid;?>" 
										class="item_space_inactive" 
										onmouseover="OSpace_MClose<?php echo $disid;?>.className='item_name_active';Icon_MClose<?php echo $disid;?>.className='item_name_active';ISpace_MClose<?php echo $disid;?>.className='item_name_active';Name_MClose<?php echo $disid;?>.className='item_name_active';" 
										onmouseout="OSpace_MClose<?php echo $disid;?>.className='item_name_inactive';Icon_MClose<?php echo $disid;?>.className='item_name_inactive';ISpace_MClose<?php echo $disid;?>.className='item_name_inactive';Name_MClose<?php echo $disid;?>.className='item_name_inactive';" 
										/>
										&nbsp;
										</td>
									<td name="Icon_MClose<?php echo $disid;?>" id="Icon_MClose<?php echo $disid;?>" 
										class="item_icon_inactive" 
										onmouseover="OSpace_MClose<?php echo $disid;?>.className='item_name_active';Icon_MClose<?php echo $disid;?>.className='item_name_active';ISpace_MClose<?php echo $disid;?>.className='item_name_active';Name_MClose<?php echo $disid;?>.className='item_name_active';" 
										onmouseout="OSpace_MClose<?php echo $disid;?>.className='item_name_inactive';Icon_MClose<?php echo $disid;?>.className='item_name_inactive';ISpace_MClose<?php echo $disid;?>.className='item_name_inactive';Name_MClose<?php echo $disid;?>.className='item_name_inactive';" 
										onclick="call_server_navigationv5load('<?php echo $whoareyou;?>','root');" />
										<img src="images/_interface/icons/icon_close.png" width="<?php echo $icons_width ;?>" height="<?php echo $icons_height;?>" />
										</td>
									<td name="ISpace_MClose<?php echo $disid;?>" id="ISpace_MClose<?php echo $disid;?>" 
										class="item_space_inactive" 
										onmouseover="OSpace_MClose<?php echo $disid;?>.className='item_name_active';Icon_MClose<?php echo $disid;?>.className='item_name_active';ISpace_MClose<?php echo $disid;?>.className='item_name_active';Name_MClose<?php echo $disid;?>.className='item_name_active';" 
										onmouseout="OSpace_MClose<?php echo $disid;?>.className='item_name_inactive';Icon_MClose<?php echo $disid;?>.className='item_name_inactive';ISpace_MClose<?php echo $disid;?>.className='item_name_inactive';Name_MClose<?php echo $disid;?>.className='item_name_inactive';" 
										/>
										&nbsp;
										</td>				
									<td name="Name_MClose<?php echo $disid;?>" id="Name_MClose<?php echo $disid;?>" 
										class="item_space_inactive" 
										onmouseover="OSpace_MClose<?php echo $disid;?>.className='item_name_active';Icon_MClose<?php echo $disid;?>.className='item_name_active';ISpace_MClose<?php echo $disid;?>.className='item_name_active';Name_MClose<?php echo $disid;?>.className='item_name_active';" 
										onmouseout="OSpace_MClose<?php echo $disid;?>.className='item_name_inactive';Icon_MClose<?php echo $disid;?>.className='item_name_inactive';ISpace_MClose<?php echo $disid;?>.className='item_name_inactive';Name_MClose<?php echo $disid;?>.className='item_name_inactive';" 
										/>
										<input class="makebuttonlooklikelargetext" type="button" name="button" value="Close Window" onclick="divwin.close(); return false" />
										</td>				
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
			<font size="1" color="#000000" />
				Commands
				</font>
			</td>
		</tr>
			<?php
			}
			?>
			</table>
		</div>
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

		//include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>	