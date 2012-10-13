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
//	Name of Document	:	part139339_c_report_display_new.php
//
//	Purpose of Page		:	Display any Part 139.339 (c) Inspection Report
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
		
		?>
		<link href="stylesheets/reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY>
<?php
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
		
		
	if (!isset($_POST['recordid'])) {
			$recordid = $_GET['recordid'];
	}
	else {
			$recordid = $_POST['recordid'];
	}
	
	//echo $recordid." 878888888 ";
		
	$sql = "SELECT * FROM tbl_139_339_main 
	INNER JOIN tbl_139_339_sub_t ON 139339_type_id = 139339_type_cb_int 
	INNER JOIN tbl_139_339_sub_t_i ON 139339_sub_t_id_int = 139339_type_id 
	WHERE 139339_main_id = '".$recordid."' ";

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

							// Initial Calculations
							$tmpdate 		= sqldate2amerdate($objarray['139339_date']);
							$tmpstartdate 	= strtotime($tmpdate);
							$astartdate 	= getdate($tmpstartdate);
							$intstartday	= $astartdate ["weekday"];
							
							$name_of_image_background = $objarray['139339_sub_t_image'];
							//echo "image name".$name_of_image_background;
							?>
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
	// 	txtdisplay:  	Displays this text
	//	bsize:			Do I bold this yext? 					1: BOLD,	0: not bolded
	//	fsize:			What is the font size of this text?		given in HTML size units
	//	hsize:			What is the height of the table?		given in pixels
	//	jsize:			What is the justification of the text?	center,left,right
	//	wpost:			What is the width of the Div layer?		given in pixels
	//	xpost:			where is the div layer to the left?		given in pixels
	//	ypost:			Where is the div layer to the top?		given in pixels
	//	zpost:			Where is the div layer to the screen?	given in HTML units, 1 is LOWER 100 is higher.				
				
	$tmp_type 		= part139339_c_typestextfield($objarray['139339_type_cb_int'], "all", "hide", "hide", "");
	
	$tmpsqldate 	= $objarray1['139339_date'];
	$tmpsqltime		= $objarray1['139339_time'];
	$tmpdate 		= sqldate2amerdate($objarray['139339_date']);
	
	$tmpstartdate 	= strtotime($tmpdate);
	$astartdate 	= getdate($tmpstartdate);
	$intstartday	= $astartdate ["weekday"];
	
	$tmptime 		= $objarray1['139339_time'];
	$insptimestamp	= $objarray1['139339_timestamp'];
	
	$tmpinspector	= systemusertextfield($objarray['139339_by_cb_int'], "all", "all", "hide", "all");

	// Probably Junk Variables, need to adjust as found
	$tmpid			= $objarray['139339_main_id'];
	$tmpdate 		= $objarray['139339_date'];
	$tmptime 		= $objarray['139339_time'];
	
	$main_id		= $objfields['139339_main_id'];
	$main_time		= $objfields['139339_time'];
	$main_date		= $objfields['139339_date'];
	
	//Display Hard Text
	//					Filed Name / Variable				b	f	h	j		w		x		y	z
	displaytxtonreport ("Watertown Regional Airport (KATY)"	, 1	, 2	, 13	, "Left"	, 300	, 10	,  85	,  3);
	displaytxtonreport($objarray['139339_main_id']			, 1	, 1	, 13	, "Right"	,  30	, 690	,   0	,  3);
	displaytxtonreport("FIELD CONDITION REPORT (FiCON)"		, 1	, 5	, 13	, "Center"	, 713	,   0	,   3	,  3);
	displaytxtonreport("DATE"								, 1	, 2	, 13	, "Left"	, 190	,   5	,  32	,  3);
	displaytxtonreport($objarray['139339_date']				, 1	, 2	, 13	, "Center"	, 190	,  95	,  32	,  3);
	displaytxtonreport("DAY"								, 1	, 2	, 13	, "Left"	, 190	, 290	,  32	,  3);
	displaytxtonreport("TIME"								, 1	, 2	, 13	, "Left"	, 190	,   5	,  52	,  3);
	displaytxtonreport($objarray['139339_time']				, 1	, 2	, 13	, "Center"	, 190	,  95	,  52	,  3);
	displaytxtonreport("INSPECTED BY"						, 1	, 2	, 13	, "Left"	, 190	, 290	,  52	,  3);
	displaytxtonreport($tmpinspector						, 1	, 3	, 13	, "left"	, 190	, 395	, 52	, 12);	
	displaytxtonreport("Here is the FiCON you requested"	, 1	, 1	, 50	, "right"	, 132	, 611	, 33	, 12);
	displaytxtonreport($objarray['139339_notes']			, 1	, 2	, 13	, "Left"	, 415	,   5	,  865	,  3);
	displaytxtonreport($objarray['139339_met+ar']			, 1	, 1	, 13	, "Center"	, 415	,   5	,  910	,  3);			
	displaytxtonreport($intstartday							, 1	, 2	, 13	, "Center"	, 185	, 392	,  32	,  3);
	
	// Placement Maps
		$offset_x						= 1;
		$offset_y						= 90;						

	// Build Datatables and Location Arrays
		$brakingactiongood		= 40;
		$brakingactiongoodcolor 	= "#00FF00";
		$brakingactiongoodtxtcolor	= "#000000";

		$brakingactionfair		= 30;
		$brakingactionfaircolor 	= "#FFFF00";
		$brakingactionfairtxtcolor	= "#000000";
		
		$brakingactionpoor		= 21;
		$brakingactionpoorcolor 	= "#FF0000";
		$brakingactionpoortxtcolor	= "#FFFFFF";
		
		$brakingactionnill		= 20;
		$brakingactionnillcolor 	= "#000000";
		$brakingactionnilltxtcolor	= "#FFFFFF";
		
		$abrakingaction	= array($brakingactiongood,$brakingactiongoodcolor,$brakingactiongoodtxtcolor,$brakingactionfair,$brakingactionfaircolor,$brakingactionfairtxtcolor,$brakingactionpoor,$brakingactionpoorcolor,$brakingactionpoortxtcolor,$brakingactionnill,$brakingactionnillcolor,$brakingactionnilltxtcolor);
	
	// Build Surface X,Y Cords....
	$a17_x	= array(460,462,463,465,467,469,471,473,475);
	$a17_y	= array(260,313,366,419,472,525,578,631,684);									
	$a12_x	= array(160,205,250,295,340,385,430,474,519);
	$a12_y	= array(255,283,312,340,367,395,423,450,478);
?>
		<div style="position:absolute; z-index:13; left:7; top:440; width:420; align="center" />
			<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse" border="1" bordercolor="#000000">
				<tr>
					<td rowspan="2" align="center" valign="middle" width="60" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Surface
						</td>
					<td rowspan="2" align="center" valign="middle" width="50" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>CLD ?
						</td>
					<td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Condition
						</td>
					<td colspan="3" align="center" valign="middle" width="60" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
							<font size="2"><B>Mu(s)
						</td>
					</tr>
				<tr>
					<td colspan="1" align="middle" valign="center" width="30" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
						<font size="2">T
						</td>
					<td colspan="1" align="middle" valign="center" width="30" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
						<font size="2">M
						</td>
					<td colspan="1" align="middle" valign="center" width="30" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" />
						<font size="2">R
						</td>
					</tr>				
						<?
							// Define SQL
							$sql = "SELECT * FROM tbl_139_339_sub_c_c 
									INNER JOIN tbl_139_339_sub_c ON 139339_cc_c_cb_int = 139339_c_id 
									INNER JOIN tbl_139_339_sub_c_f ON 139339_f_id = 139339_c_facility_cb_int 
									WHERE 139339_cc_ficon_cb_int = '".$recordid."' 
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
													
													
													$checklist_item_id		= $objfields['139339_cc_id'];				// ID of the checklist item
													$checklist_item_disc	= $objfields['139339_cc_d_yn'];				// Value of the discrepancy (could be Mu value, a surface description, or a checkbox toggle).
													
													//$main_id				= $objfields['139339_main_id'];
													//$main_time			= $objfields['139339_time'];
													//$main_date			= $objfields['139339_date'];
													
													
													$tmpcondnamestr			= str_replace(" ","",$tmpcondname);
													
													if ($current_facility!=$previous_facility) {
															// This is is a new row to display.
															// Display Facility Name
															?>
					<tr>
      					<td align="left" valign="middle" name="<?=($objfields["139339_c_facility_cb_int"]);?>" height="15" background="images/part_139_327/cellbackground.png" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;" />
      						&nbsp;
							<font size="2">
								<? 
								$tmpfacility = $objfields["139339_c_facility_cb_int"];
								part139339_c_facilitycombobox($tmpfacility, "all", "notused", "hide", "all");
								?>
								</font>
							</td>
															<?
															}
													if ($current_facility_rwy == 2) {
															// This facility is a runway orintation marker.
															$thisrunway = $objfields['139339_cc_type'];
															
															if ($objfields['139339_cc_type'] == 3) {
																	$thisrunway = $objfields['139339_cc_type'];
																	// This is a runway orintation for runway 17/35
																	// Q. What direction is the travel in?
																	// A. What ever the value is in: 139339_cc_d_yn.
																	if ($objfields["139339_cc_d_yn"] == 1) {
																			//echo "From 17";
																			$tmp_runwayort_17	= 1;
																			//echo $tmp_runwayort_17."<br>";
																		}
																		else {
																			//echo "From 35";
																			$tmp_runwayort_17	= 0;
																			//echo $tmp_runwayort_17."<br>";
																		}	// End of Oriant Check
																}	// End of cc_type Check
														}	// End of facility Check
														

													if ($current_facility_rwy == 1) {
															//This facility is a runway.
															IF ($objfields['139339_cc_type'] == 0) {
																	//echo $tmp_runwayort_17." / ";
																	//echo $tmp_runwayort_12." : ";
																	//Field is a Mu
																	//Step 2: Add one to the count loop
																		$rwy_loop_count	= ($rwy_loop_count + 1);
																		//echo "This is the ".$inner_rwy_loop." Mu for this runway <br>";
																		
																		// Draw Cells Here		////////////////////////////////////////////////////////////////
																		//$tmp_xlox				= $objfields['139339_cc_xloc'];
																		
																		if ($thisrunway == 3) {
																				// Load 17 arrays																		
																				$tmp_x						= $a17_x[$inner_rwy_loop];
																				$tmp_y						= $a17_y[$inner_rwy_loop];											
																				$arunway_number_17[$inner_rwy_loop]	= $objfields["139339_cc_d_yn"];
																				$arunway_x_17[$inner_rwy_loop]		= $tmp_x;
																				$arunway_y_17[$inner_rwy_loop]		= $tmp_y;
																			}
																		if ($thisrunway == 4) {
																				// Load 12 arrays
																				$tmp_x						= $a12_x[$inner_rwy_loop];
																				$tmp_y						= $a12_y[$inner_rwy_loop];											
																				$arunway_number_12[$inner_rwy_loop]	= $objfields["139339_cc_d_yn"];
																				$arunway_x_12[$inner_rwy_loop]		= $tmp_x;
																				$arunway_y_12[$inner_rwy_loop]		= $tmp_y;
																			}
																		//displayficonmuelement(10, $tmp_x, $tmp_y, 5,10, 10, "images/part_139_339/139_339_1735overlayblank.gif", $objfields["139339_cc_d_yn"], "#FFFFFF", "#000000");
																		
																		$inner_rwy_loop	= ($inner_rwy_loop + 1);
																		
																		// End Draw Cells Area	////////////////////////////////////////////////////////////////
																		
																		//echo "This is the ".$rwy_loop_count." field in this runway<br>";
																	//Step 1: Add value of the field to a temporary field to store the third value
																		$tmp_rwy_mu	= ($tmp_rwy_mu + $objfields["139339_cc_d_yn"]);
																		//echo "All Mus in this cycle = ".$tmp_rwy_mu." <br>";
																	//Step 3: If rwy_loop_count = 3 then average and display
																		if ($rwy_loop_count==3) {
																				//average value
																					$tmpaverage 	= ($tmp_rwy_mu/3);
																					$tmpaverage		= round($tmpaverage);
																				//Display Average
																					?>
						<td align="center" valign="middle" name="<?=($tmpcondnamestr);?>" height="15" background="images/part_139_327/cellbackground.png" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;" />
      						<font size="2">
								<?
								if ($tmpaverage==0) {
										// Display Nothing
									}
									else {
										echo $tmpaverage;
									}
								?>
								</font>
							</td>
																							<?
																							//echo $tmpaverage;
																						//Reset counter
																							$rwy_loop_count = 0;
																						//Reset Value
																							$tmp_rwy_mu	= 0;
																							
																					}
																		if ($inner_rwy_loop == 9) {
																				// 9 Mu Values have been reported, reset the loop
																				$inner_rwy_loop = 0;
																				// Reset Runway Orinatation Markers
																				$tmp_runwayort_17	= -1;
																				$tmp_runwayort_12	= -1;
																				$thisrunway		= -1;
																			}
																		}
																		else {
																			?>
      					<td align="center" valign="middle" name="<?=($tmpcondnamestr);?>" height="15" background="images/part_139_327/cellbackground.png" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;" />
      						<font size="2">
							<?
							switch ($objfields['139339_cc_type']) {
									case 0:
											echo $objfields["139339_cc_d_yn"];
											break;
									case 1:
											if ($objfields["139339_cc_d_yn"]== 1) {
													// Display Yes
													echo "Yes";
												}
												else {
													//Display No
													echo "No";
												}
											break;
									case 2:
											echo $objfields["139339_cc_d_yn"];
											break;
									}
								?>
								</font>
							</td>																			
																			<?
																		}
																}
																else {
																		switch ($objfields['139339_cc_type']) {
																				case 0:
																						$tmpcolspan	= 3;
																						break;
																				case 1:
																						$tmpcolspan	= 1;
																						break;
																				case 2:
																						$tmpcolspan	= 1;
																						break;
																			}
																?>
      					<td colspan="<?=($tmpcolspan);?>" align="center" valign="middle" name="<?=($tmpcondnamestr);?>" height="15" background="images/part_139_327/cellbackground.png" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;" />
      						<font size="2">
							<?
							switch ($objfields['139339_cc_type']) {
									case 0:
											echo $objfields["139339_cc_d_yn"];
											break;
									case 1:
											if ($objfields["139339_cc_d_yn"] == 1) {
													// Display Yes
													echo "Yes";
												}
												else {
													//Display No
													echo "No";
												}
											break;
									case 2:
											echo $objfields["139339_cc_d_yn"];
											break;
									case 3:
											if ($objfields["139339_cc_d_yn"] == 1) {
													// Display Yes
													echo "From 17";
													$tmp_runwayort_17	= 1;
												}
												else {
													//Display No
													echo "From 35";
													$tmp_runwayort_17	= 0;
												}
											break;
									case 4:
											if ($objfields["139339_cc_d_yn"]==1) {
													// Display Yes
													echo "From 12";
													$tmp_runwayort_12	= 1;
												}
												else {
													//Display No
													echo "From 30";
													$tmp_runwayort_12	= 0;
												}
											break;
								}
								?>								
								</font>
							</td>																		
															<?
																}
												
												
												
												// INSERT NEW SURFACE DRAWING FUNCTION HERE !!!!!!!!!
												// Things the function will need
												// The condition ID
												//		_location_x
												//		_location_y
												//		value
												// Make an ARRAY of the things it will need
												
												//								id,	Location X			, Location Y			, Value
												$display_menu_item[$i] 	= array($tmpid,$condition_location_x,$condition_location_y	,$checklist_item_disc,$facility_is_runway,$facility_name);
												
												//include("includes/_modules/part139339/_339_c_displayelement.inc.php");
												
												$previous_facility	= $objfields['139339_c_facility_cb_int'];
												$i 				= $i + 1;
												
												}	// End of while loop
												mysqli_free_result($res);
												mysqli_close($objcon);
										}	// end of Res Record Object						
								}
								?>
					</table>
				</div>
					<?
					}
			}
	}
	// Step Two Display Anomali Information
	
	// DISCREPANCY DISPLAY PROCEDURES
	//
	//  There are two types of discrepancies we need to display
	//		1.  Those part of this inspection
	//		2.	Those discrepancies not already fixed but still exisit at the time of this inspection
	//
	//		Type 1. is much easier to display, so lets start with that!
	//				Like any other display of discrepancies we will use the_327_discrepancydisplaybox function
	//				Set-up Initial variables

	$tempX				= 580;
	$tempY				= 155;
	$tempYo				= 155;
	$tmpzindex 			= 14;
	$passindex			= 0;
	$distools			= 1;
	$lastadd			= 0;

// 				For the Purposes of displaying more than one Discrepancy, we will also set-up these variables

	$spacebetweendis	= 20;
	$lastdisheight		= 0;
	$totaldisheight		= 0;

//				Build SQL String

	$sql1 = "SELECT * FROM tbl_139_339_sub_d WHERE discrepancy_inspection_id = ".$recordid." ORDER BY Discrepancy_location_y";
	//echo $sql1;
	
//				make Connection

	$objconn1 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

//				Attempt Connection

	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {

//				Connection Sucessful

			$objrs1 = mysqli_query($objconn1, $sql1);
						
			if ($objrs1) {
					$number_of_rows = mysqli_num_rows($objrs1);
					while ($objarray1 = mysqli_fetch_array($objrs1, MYSQLI_ASSOC)) {	

//				Connduct tests to see if Discrepancy should even be displayed.
//					We might not show the discrepancy even if it was part of this inspection for any of the reasons below:
//					1. Archieved, 2. Duplicate, ...

							$displayrow					= 1;
							$lastdisheight 				= 0;
							
							//$displayrow_a				= preflights_tbl_139_327_main_sub_d_a_yn($objarray1['Discrepancy_id'],0); // 1 will not return a row even if it is archieved.
							//$displayrow_d				= preflights_tbl_139_327_main_sub_d_d_yn($objarray1['Discrepancy_id'],0); // 1 will not return a row even if it is duplicate.
//
							//echo "Display A ".$displayrow_a." / Display D ".$displayrow_d." <br>";
							
							if($displayrow == 1) {
							//echo "Display ".$display."<br>sddsfsdfsd";

//				Record some information about the current discrepancy	

									$disx		= convertfromlargescale_to_smallscale_x($objarray1['Discrepancy_location_x'],$maparray);
									$disy		= convertfromlargescale_to_smallscale_y($objarray1['Discrepancy_location_y'],$maparray);
									
									$disid		= $objarray1['Discrepancy_id'];
									$disname 	= $objarray1['Discrepancy_name'];
									$disremarks = $objarray1['discrepancy_remarks'];	
									
									if ($passindex == 0) {
											// No discrepancy has been displayed, use default settings
											//$tempX			= 580;
											//$tempY			= 155;
										}
										else {
											$tempY		= $tempYo + ( $totaldisheight + ( $spacebetweendis) );
											$tempX		= $tempX;
										}
										
									$lastdisheight = part139339_c_discrepancydisplaybox("Discrepancy Display Box", 1, 2, 30, "left", 150, $tempX, $tempY, 5, $disid, $disname, $disremarks, $disx, $disy, $distools);
								}
							
							$passindex 		= ( $passindex + 1 );	
							$totaldisheight = ( $totaldisheight + $lastdisheight );
							//echo "Total Disheight = ".$totaldisheight."/ ".$tempY;
						}
				}
		}
		
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
		
		
		

			$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
			$tmpsqltime		= date("H:i:s");
			$tmpsqlauthor	= $_SESSION["user_id"];
			$dutylogevent	= "Printed Part 139.339 (c) Report ID:".$tmpid.", dated ".$tmpdate." at ".$tmptime."";	
			
			autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
			?>