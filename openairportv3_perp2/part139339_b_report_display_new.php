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
		$type_page 					= 3;							// Page is Type ID, see function for notes!
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
	
	$last_main_id	= $recordid;
		
	$sql = "SELECT * FROM tbl_139_339_sub_n 
	INNER JOIN tbl_139_339_sub_t ON tbl_139_339_sub_t.139339_type_id = tbl_139_339_sub_n.139339_sub_n_type_cb_int 
	INNER JOIN tbl_139_339_sub_t_i ON tbl_139_339_sub_t_i.139339_sub_t_id_int = tbl_139_339_sub_t.139339_type_id 
	WHERE tbl_139_339_sub_n.139339_sub_n_id = '".$recordid."' ";

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

							// Initial Calculations
							$tmpdate 		= sqldate2amerdate($objarray['139339_sub_n_date']);
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
	
	$tmpsqldate 	= $objarray1['139339_sub_n_date'];
	$tmpsqltime		= $objarray1['139339_sub_n_time'];
	$tmpdate 		= sqldate2amerdate($objarray['139339_sub_n_date']);
	
	$tmpstartdate 	= strtotime($tmpdate);
	$astartdate 	= getdate($tmpstartdate);
	$intstartday	= $astartdate ["weekday"];
	
	$tmptime 		= $objarray1['139339_sub_n_time'];
	$insptimestamp	= $objarray1['139339_sub_n_timestamp'];
	
	$tmpinspector	= systemusertextfield($objarray['139339_sub_n_by_cb_int'], "all", "all", "hide", "all");

	// Probably Junk Variables, need to adjust as found
	$tmpid			= $objarray['139339_sub_n_id'];
	$tmpdate 		= $objarray['139339_sub_n_date'];
	$tmptime 		= $objarray['139339_sub_n_time'];
	
	$main_id		= $objfields['139339_sub_n_id'];
	$main_time		= $objfields['139339_sub_n_time'];
	$main_date		= $objfields['139339_sub_n_date'];
	
	//Display Hard Text
	//					Filed Name / Variable				b	f	h	j		w		x		y	z
	displaytxtonreport ("Watertown Regional Airport (KATY)"	, 1	, 2	, 13	, "Left"	, 300	, 10	,  85	,  3);
	displaytxtonreport($objarray['139339_main_id']			, 1	, 1	, 13	, "Right"	,  30	, 690	,   0	,  3);
	displaytxtonreport("NOTAM Report"						, 1	, 5	, 13	, "Center"	, 713	,   0	,   3	,  3);
	displaytxtonreport("DATE"								, 1	, 2	, 13	, "Left"	, 190	,   5	,  32	,  3);
	displaytxtonreport($tmpdate								, 1	, 2	, 13	, "Center"	, 190	,  95	,  32	,  3);
	displaytxtonreport("DAY"								, 1	, 2	, 13	, "Left"	, 190	, 290	,  32	,  3);
	displaytxtonreport("TIME"								, 1	, 2	, 13	, "Left"	, 190	,   5	,  52	,  3);
	displaytxtonreport($main_time							, 1	, 2	, 13	, "Center"	, 190	,  95	,  52	,  3);
	displaytxtonreport("INSPECTED BY"						, 1	, 2	, 13	, "Left"	, 190	, 290	,  52	,  3);
	displaytxtonreport($tmpinspector						, 1	, 3	, 13	, "left"	, 190	, 395	, 52	, 12);	
	displaytxtonreport("Here is the FiCON you requested"	, 1	, 1	, 50	, "right"	, 132	, 611	, 33	, 12);
	displaytxtonreport($objarray['139339_sub_n_notes']		, 1	, 2	, 13	, "Left"	, 415	,   5	,  865	,  3);
	displaytxtonreport($objarray['139339_sub_n_metar']		, 1	, 1	, 13	, "Center"	, 415	,   5	,  910	,  3);			
	displaytxtonreport($intstartday							, 1	, 2	, 13	, "Center"	, 185	, 392	,  32	,  3);
	
	// Placement Maps
		$offset_x						= 1;
		$offset_y						= 90;						
		$i = 0;
?>
		<div style="position:absolute; z-index:13; left:7; top:440; width:420; align="center" />
			<table border="1" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse" border="1" bordercolor="#000000">
					<tr>
      					<td rowspan="2" class="formheaders">
      							Surface
							</td>
      					<td rowspan="2" class="formheaders">
      							Closed ?<br>Yes?
							</td>
						</tr>
					<tr>
						<td colspan="4" class="header">				
						<?
							// Define SQL
							$sql = "SELECT * FROM tbl_139_339_sub_n_cc  
									INNER JOIN tbl_139_339_sub_c 	ON tbl_139_339_sub_c.139339_c_id = tbl_139_339_sub_n_cc.139339_cc_c_cb_int 
									INNER JOIN tbl_139_339_sub_c_f 	ON tbl_139_339_sub_c_f.139339_f_id =  tbl_139_339_sub_c.139339_c_facility_cb_int  
									WHERE 139339_cc_ficon_cb_int = '".$recordid."' AND 139339_cc_d_yn = 1 	
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
														
																				$condition_location_rx	= $objfields4['139339_cc_location_rx'];
																				$condition_location_ry	= $objfields4['139339_cc_location_ry'];
														
																				//echo $facility_name2."////".$condition_location_x2."/////".$tmpid2;
																				//								0		, 1						, 2						, 3						, 4						, 5				, 6						, 7
																				$display_menu_item[$i] 	= array($tmpid2	,$condition_location_x2	,$condition_location_y2	,"Closed"				,$facility_is_runway2	,$facility_name2,$condition_location_rx	,$condition_location_ry);
												
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
								?>
					</table>
				</div>
					<?
					}
			}
	}
	

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

		//$last_main_id	= $lastid;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>