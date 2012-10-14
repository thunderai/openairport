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
//	Name of Document		:	part139327_discrepancy_report_display.php
//
//	Purpose of Page			:	Enter New Part139.327 Inspection
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
		//include("includes/AutoEntryFunctions.php");
		include("includes/_systemusers/systemusers.list.php");
		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_navigation/navigation.list.php");
		include("includes/_template/template.list.php");
		include("includes/_generalsettings/generalsettings.list.php");					// Load GIS Functions

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
?>
<HTML>
	<HEAD>
		<TITLE>
			Open Airport - Airport Safety Self-Inspection Report (Printer Friendly)
			</TITLE>
		<link href="stylesheets/reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
		
	<div style="position:absolute; z-index:1; left:3; top:84; width:<?php echo $maparray[1][1];?>;" align="left" />
		<img src="images/part_139_327/<?php echo $maparray[1][0];?>" width="<?php echo $maparray[1][1];?>" height="<?php echo $maparray[1][2];?>" />
		</div>
	<div style="position:absolute; z-index:2; left:0; top:30; width:<?php echo $maparray[2][1];?>;" align="left" />
		<img src="images/part_139_327/<?php echo $maparray[2][0];?>" width="<?php echo $maparray[2][1];?>" height="<?php echo $maparray[2][2];?>" />
		</div>
<?

if (!isset($_POST["recordid"])) {
		// There is no POST recordid. Did it get a GET instead?
		$recordid = $_GET['recordid'];
	}
	else {
		$recordid = $_POST['recordid'];
	}
	
	$last_main_id = $recordid;
	
	$sql = "SELECT * FROM tbl_139_339_sub_d WHERE Discrepancy_id = '".$recordid."' ";

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

							$tmpdate = sqldate2amerdate($objarray['Discrepancy_date']);

							//					Filed Name / Variable				b	f	h	j		w		x		y	z
							displaytxtonreport($objarray['Discrepancy_id'], 		1, 1, 30, "right", 	30, 	690, 	0, 	3);
							displaytxtonreport("Anomaly Information", 				1, 5, 30, "center", 713, 	0, 		0, 	4);	
							displaytxtonreport("DATE", 								1, 3, 13, "left", 	190, 	5, 		32, 5);	
							displaytxtonreport($tmpdate, 							1, 3, 13, "left", 	190, 	95, 	32, 6);	
							displaytxtonreport("PRIORITY",	 						1, 3, 13, "left", 	190, 	290, 	32, 7);		
							displaytxtonreport($objarray['discrepancy_priority'],	1, 3, 13, "left", 	190, 	395, 	32, 8);		
							displaytxtonreport("TIME",								1, 3, 13, "left", 	190, 	5, 		52, 9);		
							displaytxtonreport($objarray['Discrepancy_time'],		1, 3, 13, "left", 	30, 	95, 	52, 10);	
							displaytxtonreport("NAME",								1, 3, 13, "left", 	190, 	290, 	52, 11);			
							displaytxtonreport($objarray['Discrepancy_name'],		1, 3, 13, "left", 	190, 	395, 	52, 12);	

							displaytxtonreport("Here is the Anomaly Record you requested.",		1, 1, 50, "right", 	132, 	611, 	33, 12);
							?>
							
	<div style="position:absolute; z-index:13; left:11; top:385; width:300; align="center" />
		<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" />
			<tr>
				<td colspan="2" align="center" valign="middle" align="center" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="4" COLOR="#000000" /><b>Anomaly Information</b></font>
					</td>
				</tr>				
			<tr>
				<td  align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Name </b></font>
					</td>	
				<td  align="right" valign="middle" width="*" align="center" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $objarray['Discrepancy_name'];?>
					</td>					
				</tr>
			<tr>
				<td  align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Comments </b></font>
					</td>	
				<td  align="right" valign="middle" width="*" align="center" background="images/part_139_327/cellbackground.png" height="100" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $objarray['discrepancy_remarks'];?>
					</td>					
				</tr>
				</table>
			</div>
					<?
					// Provide Information for the Discrepancy Box Function
					
					$tempX		= 580;
					$tempY		= 155;
					$tmpzindex 	= 14;
			
					$disx		= convertfromlargescale_to_smallscale_x($objarray['Discrepancy_location_x'],$maparray);
					$disy		= convertfromlargescale_to_smallscale_y($objarray['Discrepancy_location_y'],$maparray);
													
					$disid		= $objarray['Discrepancy_id'];
					$disname 	= $objarray['Discrepancy_name'];
					$disremarks = $objarray['discrepancy_remarks'];
				
					part139339_c_discrepancydisplaybox("Discrepancy Display Box", 1, 2, 30, "left", 150, $tempX, $tempY, $tmpzindex, $disid, $disname, $disremarks, $disx, $disy);
					}
			}
	}
	
// Define Variables...
//						for Auto Entry Function {End of Page}

		// Last Main ID
		//		This is the ID of the main record of this page, not a sub routine.
		//		If no ID is used or possible to obtain such a browse page or a form loader enter '-'
		//$last_main_id	= $last_main_id;
		
		//	AutoEntry Function Array
		//		This array controls the values sent to the auto entry function.
		//		No changes should be needed to it.
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>