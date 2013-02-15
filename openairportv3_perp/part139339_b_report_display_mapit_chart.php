<?php
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o	o		ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		o	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		oo	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o o	o		ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  oo		o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	o		o	o	  o		o	o	o		o	o	o	o     o
//	00000	0		ooooo	o	o		o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	part139339_b_report_display_new.php
//
//	Purpose of Page		:	Display any Part 139.339 (b) Inspection Report
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
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
		include("includes/_systemusers/systemusers.list.php");
		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_navigation/navigation.list.php");
		include("includes/_template/template.list.php");
		include("includes/_generalsettings/generalsettings.list.php");					// Load GIS Functions
		
// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 39;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 13;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions	

		
		$discrepancybouncedid 		= "";
		$discrepancybounceddate 	= "";
		$discrepancybouncedtime 	= "";
		$discrepancyrepairid 		= "";
		$discrepancyrepairdate 		= "";
		$discrepancyrepairtime 		= "";
		$isduplicate				= "";
		$isarchived					= "";
		$displaydatarow				= "";
		$displaydiscrepancy 		= "";
		$rwy_loop_count				= 0;
		$tmp_rwy_mu					= 0;
		$previous_rwy_loop			= "";
		$current_rwy_loop			= "";
		$inner_rwy_loop				= 0;
		
		$tmp_runwayort_12			= -1;
		$tmp_runwayort_17			= -1;
		$display_menu_item			= array();
		
		$offset_x					= 1;
		$offset_y					= 90;	
	

	// GET SETTING CONTROLS
	//	form_new_control("discondition"		,"Time Period"				, "Select a Time Period"					,"Select a condition from the list provided!"			,""					,3			,50				,0				,"all"					,"part139339typescomboboxwall");
	//	form_new_control("disusedfor"		,"Search by Date"			, "Find by Dates Issued or Dates Closed"	,"Checking this box will use the dates above as issued, unchecked will use dates as closed by"		,""					,5			,50				,0				,"all"					,0);
	//	form_new_control("disonlycurrent"	,"Only Current Status"		, "Display only the current surface status"	,"Checking this box will display only the current status. Unchecking the box will allow other controls to work."		,""					,5			,50				,0				,"all"					,0);
	//	form_new_control("disusebrowser"	,"Use Above Settings"		, "Use Broser Settings or override"			,"Checking this box will use the dates above, unchecked will use the dates from the browser form"		,""					,5			,50				,0				,"all"					,0);

	//Get Information from the FORM
		$tmpstartdate 	= $_POST['frmstartdate'];
		$tmpenddate 	= $_POST['frmenddate'];
		$tmpstartdate2 	= $_POST['frmstartdateo'];
		$tmpenddate2	= $_POST['frmenddateo'];
		
	// Convert start date and end date into sql format
	
		//$tmpsqlstartdate	= amerdate2sqldatetime($tmpstartdate );
		//$tmpsqlenddate		= amerdate2sqldatetime($tmpenddate );
		//$tmpsqlstartdate2	= amerdate2sqldatetime($tmpstartdate2 );
		//$tmpsqlenddate2		= amerdate2sqldatetime($tmpenddate2 );	

		$tmpsqlstartdate	= ($tmpstartdate );
		$tmpsqlenddate		= ($tmpenddate );
		$tmpsqlstartdate2	= ($tmpstartdate2 );
		$tmpsqlenddate2		= ($tmpenddate2 );	
		
	if (!isset($_POST['disonlycurrent'])) {
		
			// DO WE ONLY WANT THE CURRENT STATUS OR SOME OTHER CREATION?
			if($_POST['discondition'] == 'all') {
					// USER HAS SELECTED ALL TIME PERIODS
					//	add nothing to the SQL statement
					//echo "Nothing to add to the SQL Statement <br>";
				} else {
					// USER HAS SELECTED A TIME PERIOD, 
					//	add specific data to sql statement
					//echo "Adding to the SQL Statement <br>";
					$sql_a = "AND tbl_139_339_sub_n.139339_sub_n_type_cb_int = '".$_POST['discondition']."' ";
				}	
				
			if($_POST['disusebrowser'] == 1) {
					$usebrowser		= 0;
					$date_to_use_s	= $tmpsqlstartdate;
					$date_to_use_e	= $tmpsqlenddate;
				}
				else {
					$usebrowser		= 1;
					$date_to_use_s	= $tmpsqlstartdate2;
					$date_to_use_e	= $tmpsqlenddate2;
				}	
				
			if($_POST['disusedfor'] == 1) {
					// USER HAS SELECTED TO FIND BY DATE ISSUED
					//	add date made to search critera
					//echo "Add Date Issued to SQL Statement <br>";
					$sql_b = "AND tbl_139_339_sub_n.139339_sub_n_date >= '".$date_to_use_s."' AND 139339_sub_n_date <= '".$date_to_use_e."' ";
				} else {
					// USER HAS SELECTED A TIME PERIOD, 
					//	add specific data to sql statement
					//echo "Adding to the SQL Statement <br>";
					$sql_b = "AND tbl_139_339_sub_n.139339_sub_n_date_closed >= '".$date_to_use_s."' AND 139339_sub_n_closed <= '".$date_to_use_e."' ";
				}			
			
		} else {
			if($_POST['disonlycurrent'] == 1) {
					// USER WANTS ONLY THE CURRENT STATUS. NOTHING ELSE
					//	create proper SQL Statement
					//echo "Display only the current status <br>";
					
					
					// MORE NO DOUBT GOES HERE THAN THIS!!!!!!!!
				}
		}
		?>
		
		<link href="stylesheets/reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY>
	
		<div style="position:absolute; z-index:1; left:3; top:84; width:<?php echo $maparray[1][1];?>;" align="left" />
			<img src="images/part_139_327/<?php echo $maparray[1][0];?>" width="<?php echo $maparray[1][1];?>" height="<?php echo $maparray[1][2];?>" />
			</div>
		<div style="position:absolute; z-index:2; left:0; top:30; width:<?php echo $maparray[2][1];?>;" align="left" />
			<img src="images/part_139_327/<?php echo $maparray[2][0];?>" width="<?php echo $maparray[2][1];?>" height="<?php echo $maparray[2][2];?>" />
			</div>
			
		<div style="position:absolute; z-index:9; left:0; top:0; width:713; align="left" />
			<table width="400">
				<tr>
					<td>
						<input type="Button" name="printit" value="Print" onclick="javascript:window.print();">
						</td>
					</tr>
				</table>
			</div>		
		<div style="position:absolute; z-index:3; left:300; top:900; width:450; align="center" />
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width"450" id="AutoNumber1" />
				<tr align="center" />
					<td align="left" />
						&nbsp;<font size="1"></font>
						</td>
					</tr>
				</table>
			</div>
			
		<?php
		
			//					Filed Name / Variable				b	f	h	j		w		x		y	z
	displaytxtonreport ("Watertown Regional Airport (KATY)"	, 1	, 2	, 13	, "Left"	, 300	, 10	,  85	,  3);
	//displaytxtonreport($objarray['139339_main_id']			, 1	, 1	, 13	, "Right"	,  30	, 690	,   0	,  3);
	displaytxtonreport("NOTAM Report"						, 1	, 5	, 13	, "Center"	, 713	,   0	,   3	,  3);
	displaytxtonreport("START DATE"							, 1	, 2	, 13	, "Left"	, 190	,   5	,  32	,  3);
	displaytxtonreport($date_to_use_s						, 1	, 2	, 13	, "Center"	, 190	,  95	,  32	,  3);
	displaytxtonreport("Day"								, 1	, 2	, 13	, "Left"	, 190	, 290	,  32	,  3);
	displaytxtonreport("END DATE"							, 1	, 2	, 13	, "Left"	, 190	,   5	,  52	,  3);
	displaytxtonreport($date_to_use_e						, 1	, 2	, 13	, "Center"	, 190	,  95	,  52	,  3);
	displaytxtonreport("INSPECTED BY"						, 1	, 2	, 13	, "Left"	, 190	, 290	,  52	,  3);
	displaytxtonreport($tmpinspector						, 1	, 3	, 13	, "left"	, 190	, 395	, 52	, 12);	
	displaytxtonreport("Here is the FiCON you requested"	, 1	, 1	, 50	, "right"	, 132	, 611	, 33	, 12);
	//displaytxtonreport($objarray['139339_sub_n_notes']		, 1	, 2	, 13	, "Left"	, 415	,   5	,  865	,  3);
	//displaytxtonreport($objarray['139339_sub_n_metar']		, 1	, 1	, 13	, "Center"	, 415	,   5	,  910	,  3);			
	//displaytxtonreport($intstartd
	
	?>
	<div style="position:absolute; z-index:13; left:7; top:440; width:420; align="center" />
		<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse" border="1" bordercolor="#000000">
			<tr>
				<td align="center" valign="middle" width="30" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
					ID
					</td>
				<td align="center" valign="middle" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
						Date / Time (Issued)
					</td>
				<td align="center" valign="middle" width="30" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
					By
					</td>
				<td align="center" valign="middle" width="40" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
					Message
					</td>
				</tr>
	<?php

	$sql = "SELECT * FROM tbl_139_339_sub_n 
	INNER JOIN tbl_139_339_sub_t 	ON tbl_139_339_sub_t.139339_type_id = tbl_139_339_sub_n.139339_sub_n_type_cb_int 
	INNER JOIN tbl_139_339_sub_t_i 	ON tbl_139_339_sub_t_i.139339_sub_t_id_int = tbl_139_339_sub_t.139339_type_id 
	INNER JOIN tbl_systemusers		ON tbl_systemusers.emp_record_id = tbl_139_339_sub_n.139339_sub_n_by_cb_int 
	WHERE 139339_sub_n_archived_yn = 0 ".$sql_a." ".$sql_b." ";

	//echo $sql;
	
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
					$number_of_rows = mysqli_num_rows($objrs);
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
							
							$record_id		= $objarray['139339_sub_n_id'];
							$skipping		= 0;
							
							// IS THIS NOTAM CURRENTLY CLOSED or ARCHIEVED?
							
							
							// Test for archived. If 1 not archived, 0 is archived?
							$display_archived		= preflights_tbl_139_339_sub_n_a_yn($objarray['139339_sub_n_id'],0);	
							//echo "Display Archived = ".$display_archived."<br>";
							$display_closed			= preflights_tbl_139_339_sub_n_r_yn($objarray['139339_sub_n_id'],0);
							//echo "Display Closed = ".$display_closed."<br>";
							
							if($display_archived == 0) {
									// Surface is archived, skipp the rest
									$skipping = 1;
							} else {														
									
									if($display_closed == 1) {
											// Surface NOTAM has no closed records
											$message = "Closed";
										} else {
											// Surface currently has closed notams on file
											$message = "Expired";
										}
							?>
			<tr>
				<td align="left" valign="middle" width="30" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $objarray['139339_sub_n_id'];?>
					</td>
				<td align="left" valign="middle" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $objarray['139339_sub_n_date'];?> / <?php echo $objarray['139339_sub_n_time'];?>
					</td>
				<td align="left" valign="middle" width="30" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $objarray['emp_initials'];?>
					</td>
				<td align="left" valign="middle" width="40" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $message;?>
					</td>					
				</tr>
							<?php										
							}

							

							// Define SQL
							$sql = "SELECT * FROM tbl_139_339_sub_n_cc  
									INNER JOIN tbl_139_339_sub_c 	ON tbl_139_339_sub_c.139339_c_id = tbl_139_339_sub_n_cc.139339_cc_c_cb_int 
									INNER JOIN tbl_139_339_sub_c_f 	ON tbl_139_339_sub_c_f.139339_f_id =  tbl_139_339_sub_c.139339_c_facility_cb_int  
									WHERE tbl_139_339_sub_n_cc.139339_cc_d_yn = 1 AND tbl_139_339_sub_n_cc.139339_cc_ficon_cb_int = '".$record_id."' 
									ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
							
							//echo $sql;
							
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
																										
													$tmpid 					= $objfields['139339_c_id'];
													$current_facility 		= $objfields['139339_c_facility_cb_int'];
													$current_facility_rwy	= $objfields['139339_f_rwy_yn'];
													$tmpcondname			= $objfields['139339_c_name'];
													$tmp_xlox				= $objfields['139339_cc_xloc'];
													
													$facility_id			= $objfields['139339_f_id'];				// The ID of the facility row
													$facility_name			= $objfields['139339_f_name'];				// The Name of this facility. Typically english readable
													$facility_is_runway		= $objfields['139339_f_rwy_yn'];			// Toggle for dynamic control. 0: Nothing special, 1: Is a runway, 2: is a holder for runway orintation, 3: Checkbox not applicable to a surface
													
													$condition_id			= $objfields['139339_c_id'];				// The ID of the condition row
													$condition_name			= $objfields['139339_c_name'];				// The Programming name of this condition.  Typically not something readable
													$condition_type			= $objfields['139339_c_type_cb_int'];		// The type of FiCON this condition is part of.  Timeline....
													$condition_field_type	= $objfields['139339_cc_type'];				// Describes the type of input box this is:  0:Mu Value, 1: checkbox, 2: text
													$condition_xlocation	= $objfields['139339_cc_xloc'];				// Describes the order to sort this condition

													$condition_location_x	= $objfields['139339_cc_location_x'];
													$condition_location_y	= $objfields['139339_cc_location_y'];
													
													//echo "Location X: ".$condition_location_x;
													
													$checklist_item_id		= $objfields['139339_cc_id'];				// ID of the checklist item
													$checklist_item_disc	= $objfields['139339_cc_d_yn'];				// Value of the discrepancy (could be Mu value, a surface description, or a checkbox toggle).
													
													//$main_id				= $objfields['139339_main_id'];
													//$main_time			= $objfields['139339_time'];
													//$main_date			= $objfields['139339_date'];
													
													
													$tmpcondnamestr			= str_replace(" ","",$tmpcondname);
													
													
													
													if ($current_facility!=$previous_facility) {
															// This is is a new row to display.
															// Display Facility Name
															$tmpfacility = $objfields["139339_c_facility_cb_int"];

														}
      					
															
												// IS THIS SURFACE A RUNWAY OR A TAXIWAY?
												//		if $facility_is_runway =1, then it is a runway. 0 is a taxiway and 8 is a ramp. 
												//		The only tricky part here is that a runway is composed of nine different sub 
												//		surfaces which need to be added to the array for display. 
												//		The display procedure doesn't care, it just wants x,y locations.
												//		Need to loop through the surfces of the runway and forcethem into the display_menu_item array
												
												if($facility_is_runway == 1) {
													
														// Surface is an array, load subload function
														// Define SQL
														$sql4 = "SELECT * FROM tbl_139_339_sub_c  
																WHERE 139339_c_facility_cb_int = '".$facility_id."' 
																ORDER BY 139339_c_name";
														
												}
												else {
														// Define Different SQL Statement
														$tmp_surfacename		= str_replace("Closed","Mu",$tmpcondname);
														$sql4 = "SELECT * FROM tbl_139_339_sub_c  
																WHERE 139339_c_facility_cb_int = '".$facility_id."' AND 139339_c_name = '".$tmp_surfacename."' 
																ORDER BY 139339_c_name";
												}
													
														//echo $sql4;
														
														// Establish a Conneciton with the Database
														$objcon4 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
								
														if (mysqli_connect_errno()) {
																printf("connect failed: %s\n", mysqli_connect_error());
																exit();
															}
															else {
																$res4 = mysqli_query($objcon4, $sql4);
																if ($res4) {
																		$number_of_rows4 = mysqli_num_rows($res4);
																		//printf("result set has %d rows. \n", $number_of_rows);
												
																		while ($objfields4 = mysqli_fetch_array($res4, MYSQLI_ASSOC)) {
														
																				$condition_location_x2	= $objfields4['139339_cc_location_x'];
																				$condition_location_y2	= $objfields4['139339_cc_location_y'];
																				$tmpid2					= $objfields4['139339_c_id'];
																				$facility_is_runway2	= $facility_is_runway;
																				$facility_name2			= $facility_name;
														
																				//echo $facility_name2."////".$condition_location_x2."/////".$tmpid2;
																				$display_menu_item[$i] 	= array($tmpid2,$condition_location_x2,$condition_location_y2	,$message,$facility_is_runway2,$facility_name2);
												
																				//echo "<br> test id: ".$display_menu_item[$i][0]."</br>";
																				
																				$i = $i + 1;
																			}
																	}
															}

												$previous_facility	= $objfields['139339_c_facility_cb_int'];
												//$i 				= $i + 1;
												
												}	// End of while loop
												mysqli_free_result($res);
												mysqli_close($objcon);
										}	// end of Res Record Object						
								}

					}
			}
		}
	?>
			</table>
		</div>
	<?php

	$tempX				= 580;
	$tempY				= 155;
	$tempYo				= 155;
	$tmpzindex 			= 14;
	$passindex			= 0;
	$distools			= 1;
	$lastadd			= 0;
		
	$placeoverlays = 1;
	
	if($placeoverlays == 1) {
			// Display overlay stuff
			
			// Get count of elements in the storage array
			
			$records = count($display_menu_item);
			
			//echo "Number of Records: ".$records." <br>";
			
			for ($j=0; $j<count($display_menu_item); $j=$j+1) {
				
				
					include("includes/_modules/part139339/_339_c_displayelement.inc.php");
												
			}
			
			
	}		

// Define Variables...
//						for Auto Entry Function {End of Page}

		$last_main_id	= "-";	// No Valid ID to use
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>		