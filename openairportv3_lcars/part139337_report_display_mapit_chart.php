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
?>
<HTML>
	<HEAD>
		<TITLE>
			Open Airport - Airport Safety Self-Inspection Report (Printer Friendly)
			</TITLE>
<?php
// Load global include files
	
		//include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes
		include("includes/_dateandtime/dateandtime.list.php");
		include("scripts/_scripts_header_iface.inc.php");
		include("includes/AutoEntryFunctions.php");
		include("includes/_systemusers/systemusers.list.php");
		include("includes/_modules/part139337/part139337.list.php");
		include("includes/_navigation/navigation.list.php");
		include("includes/_generalsettings/generalsettings.list.php");					// Load GIS Functions

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 21;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 13;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions

		
		?>
		<link href="stylesheets/reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY>
	
	<!-- Map -->
	<div style="position:absolute; z-index:1; left:3; top:84; width:<?php echo $maparray[1][1];?>;" align="left" />
		<img src="images/part_139_327/<?php echo $maparray[1][0];?>" width="<?php echo $maparray[1][1];?>" height="<?php echo $maparray[1][2];?>" />
		</div>
	<!-- Overlay -->
	<div style="position:absolute; z-index:2; left:0; top:30; width:<?php echo $maparray[2][1];?>;" align="left" />
		<img src="images/part_139_327/<?php echo $maparray[2][0];?>" width="<?php echo $maparray[2][1];?>" height="<?php echo $maparray[2][2];?>" />
		</div>	
		
<?php
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
		$tmpstartdate 	= $_POST['frmstartdate'];
		$tmpenddate 	= $_POST['frmenddate'];
		$tmpstartdate2 	= $_POST['frmstartdateo'];
		$tmpenddate2	= $_POST['frmenddateo'];		
		$tmpspecies 	= $_POST['wlhmspecies'];
		$tmpactivity 	= $_POST['wlhmactivity'];
		$tmpaction		= $_POST['wlhmaction'];
		
		$displayspecies_id 	= $_POST['wlhmspecies'];
		$displayactivity_id = $_POST['wlhmactivity'];
		$displayaction_id 	= $_POST['wlhmaction'];
		
	// Convert start date and end date into sql format
	
		$tmpsqlstartdate	= amerdate2sqldatetime($tmpstartdate );
		$tmpsqlenddate		= amerdate2sqldatetime($tmpenddate );
		$tmpsqlstartdate2	= amerdate2sqldatetime($tmpstartdate2 );
		$tmpsqlenddate2		= amerdate2sqldatetime($tmpenddate2 );

		$notlimited_p1 = 0;
		$notlimited_p1 = 0;
		$notlimited_p1 = 0;
		
		
		
		$OffSetX 		= -20;
		$OffSetY 		= 70;
		$tmpzindex		= 14;
		
		$isarchived			= "";
		$isduplicate		= "";
		$displaydatarow		= "";
		$displaydiscrepancy = "";
		
		$i					= "";
		
	// Determine which Date Grouping we are using
		
		$tmptime = date('H:m:s');
		$tmpdate = date('Y/m/d');
		
		if($_POST['disusebrowser'] == '1') {
				$use_start_date = $tmpsqlstartdate;
				$use_end_date 	= $tmpsqlenddate;
			}
			else {
				$use_start_date = $tmpsqlstartdate2;
				$use_end_date 	= $tmpsqlenddate2;			
			}

		//					Filed Name / Variable				b	f	h	j		w		x		y	z
		//displaytxtonreport($objarray['Discrepancy_id'], 		1, 1, 30, "right", 	30, 	690, 	0, 	3); <-- Don't need this
		displaytxtonreport("Wildlife Report Locations", 		1, 5, 30, "center", 713, 	0, 		0, 	4);	
		displaytxtonreport("DATE", 								1, 3, 13, "left", 	190, 	5, 		32, 5);	
		displaytxtonreport($tmpdate, 							1, 3, 13, "left", 	190, 	95, 	32, 6);	
		displaytxtonreport("START DATE",	 					1, 3, 13, "left", 	190, 	290, 	32, 7);		
		displaytxtonreport($use_start_date,						1, 3, 13, "left", 	190, 	395, 	32, 8);		
		displaytxtonreport("TIME",								1, 3, 13, "left", 	190, 	5, 		52, 9);		
		displaytxtonreport($tmptime,							1, 3, 13, "left", 	30, 	95, 	52, 10);	
		displaytxtonreport("END DATE",							1, 3, 13, "left", 	190, 	290, 	52, 11);
		displaytxtonreport($use_end_date,						1, 3, 13, "left", 	190, 	395, 	52, 8);		
		
		$displayspecies_id 	= $_POST['wlhmspecies'];
		$displayactivity_id = $_POST['wlhmactivity'];
		$displayaction_id 	= $_POST['wlhmaction'];
										
										
		if($displayspecies_id == 'all') {
				// User has selected to display all animals
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_s 		= "AND 139337_species_cb_int = '".$displayspecies_id."' ";
			}
			
		if($displayactivity_id == 'all') {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_ay 		= "AND 139337_activity_cb_int = '".$displayactivity_id."' ";
			}
			
		if($displayaction_id == 'all') {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_an 		= "AND 139337_action_cb_int = '".$displayaction_id."' ";
			}			

		// Create SQL Statement
		$sql = "SELECT * FROM tbl_139_337_main
		INNER JOIN tbl_139_337_sub_s 	ON tbl_139_337_main.139337_species_cb_int = tbl_139_337_sub_s.139337_sub_s_id 
		INNER JOIN tbl_139_337_sub_an	ON tbl_139_337_sub_an.139337_sub_an_id = tbl_139_337_main.139337_action_cb_int 
		INNER JOIN tbl_139_337_sub_ay	ON tbl_139_337_sub_ay.139337_sub_ay_id = tbl_139_337_main.139337_activity_cb_int 
		WHERE 139337_date >= '".$use_start_date."' AND 139337_date <= '".$use_end_date."' ".$msql_s." ".$msql_ay." ".$msql_an." ORDER BY 139337_sub_s_category, 139337_sub_s_name";

		//echo  "The SQL Statement is ".$sql." <BR>";
			
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
							$displayrow_d				= 1;
					
							$tmpdiscrepancyid			= $objarray['139337_id'];
							//$tmpdiscrepancycondition	= $objarray['discrepancy_checklist_id'];	
							
							$displayrow_a				= preflights_tbl_139_337_main_a_yn($tmpdiscrepancyid,0); // 1 will not return a row even if it is archieved.
							//$displayrow_d				= preflights_tbl_139_327_main_sub_d_d_yn($tmpdiscrepancyid,0); // 1 will not return a row even if it is duplicate.

							//echo "Display A ".$displayrow_a." / Display D ".$displayrow_d." <br>";
							
							if($displayrow_a == 0 OR $displayrow_d == 0) {
									// Do display Row
									$displayrow = 0;
								}
								else {
									$displayrow = 1;
								}
							
							if($displayrow == 1) {
										
										$tempX		= 580;
										$tempY		= 155;
										$tmpzindex 	= 14;
								
										$disx		= convertfromlargescale_to_smallscale_x($objarray['139337_locationx'],$maparray);
										$disy		= convertfromlargescale_to_smallscale_y($objarray['139337_locationy'],$maparray);
										
										$disid		= $objarray['139337_id'];
										$disname 	= $objarray['139337_numberofspecies'];
										$disremarks = $objarray['139337_resultsofaction'];
										
										part139337_displaybox("Targets Only", 1, 2, 30, "left", 100, $tempX, $tempY, $tmpzindex, $disid, $disname, $disremarks, $disx, $disy);
								}
									
							$isduplicate			= "";
							$isarchived				= "";
							$displaydiscrepancy		= "";
							$displaydatarow			= "";							
						}	// End of discrepancy While Loop
				}	// End of active object connection
		}	// End of Sucessful connection
		
?>

	<div style="position:absolute; z-index:999; left:10; top:470; width:400; align="center" />
		<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" />
			<tr>
				<td colspan="2" align="center" valign="middle" align="center" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="4" COLOR="#000000" /><b>Wildlife HotSpots!</b></font>
					</td>
				</tr>				
			<tr>
				<td colspan="2" align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Types of Specie(s) </b></font>
					</td>
				</tr>
			<tr>
				<td colspan="2" align="right" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" />
						<?php
						part139337_combobox_animalspecieswall($tmpspecies, "all", "all", "hide", "");
						?>
						</font>
					</td>
				</tr>			
			<tr>
				<td colspan="2" align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Types of Activity(ies) </b></font>
					</td>
				</tr>
			<tr>
				<td colspan="2" align="right" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" />
						<?php
						part139337_combobox_animalactivitywall($tmpactivity, "all", "all", "hide", "");
						?>
						</font>
					</td>
				</tr>					
			<tr>
				<td colspan="2" align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Types of Action(s) </b></font>
					</td>
				</tr>
			<tr>
				<td colspan="2" align="right" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" />
						<?php
						part139337_combobox_actiontakenwall($tmpaction, "all", "all", "hide", "");
						?>
						</font>
					</td>
				</tr>
			<tr>
				<td colspan="2" align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>&nbsp;</b></font>
					</td>
				</tr>				
			<tr>
				<td colspan="2" align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="1" COLOR="#000000" />
						^, a report may not be shown because it is archived
						</font>
					</td>
				</tr>
			</table>
		</div>	
<?php
// Define Variables...
//						for Auto Entry Function {End of Page}

		$last_main_id	= "-";	// No Valid ID to use
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>	