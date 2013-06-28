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

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		// Navigation Page ID
		//		Enter the ID of the Navigation Module this page belongs to.
		//		Check the AutoEntry function for more details...
		$navigation_page 			= 40;
		// Page Type ID
		//		Enter the ID of the Event type for this page.
		//		Check the AutoEntry function for more details...
		$type_page 					= 3;							// Page is Type ID, see function for notes!
		// Other Settings for AutoEntry
		//		You should not need to change these values.
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
		
		
	if (!isset($_POST['recordid'])) {
			$recordid = $_GET['recordid'];
	}
	else {
			$recordid = $_POST['recordid'];
	}
	
	$last_main_id = $recordid;
	
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
	//					Filed Name / Variable				, b	, f	, h		, j			, w		, x		, y		, z
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
	displaytxtonreport("Here is the FiCON you requested"	, 1	, 1	, 50	, "right"	, 132	, 611	, 30	, 12);
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
	//$a17_x	= array(460,462,463,465,467,469,471,473,475);
	//$a17_y	= array(260,313,366,419,472,525,578,631,684);									
	//$a12_x	= array(160,205,250,295,340,385,430,474,519);
	//$a12_y	= array(255,283,312,340,367,395,423,450,478);
	
	// Facility Locx,Locy are in small scale report x,y in the database in c_f
	
	$display_facility 	= 'Twy A';
	$display_header		= 1;
	include("includes/_modules/part139339/_339_c_displayfacility.inc.php");
	$display_facility 	= 'Twy B';
	$display_header		= 1;
	include("includes/_modules/part139339/_339_c_displayfacility.inc.php");	
	$display_facility 	= 'Twy C';
	$display_header		= 1;
	include("includes/_modules/part139339/_339_c_displayfacility.inc.php");
	$display_facility 	= 'Ramp';
	$display_header		= 1;
	include("includes/_modules/part139339/_339_c_displayfacility.inc.php");
	$display_facility 	= 'Rwy';
	$display_header		= 1;
	include("includes/_modules/part139339/_339_c_displayfacility.inc.php");
	$display_facility 	= 'From';
	$display_header		= 1;
	include("includes/_modules/part139339/_339_c_displayfacility.inc.php");
	$display_facility 	= 'Snow';
	$display_header		= 1;
	include("includes/_modules/part139339/_339_c_displayfacility.inc.php");	
?>

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
	$tempY				= 250;
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
		
// Define Variables...
//						for Auto Entry Function {End of Page}

		// Last Main ID
		//		This is the ID of the main record of this page, not a sub routine.
		//		If no ID is used or possible to obtain such a browse page or a form loader enter '-'
		//$last_main_id	= "-";
		
		//	AutoEntry Function Array
		//		This array controls the values sent to the auto entry function.
		//		No changes should be needed to it.
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>	