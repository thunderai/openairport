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
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page							// List of all Navigation functions
			
// Load Page Specific Includes
		include("scripts/_scripts_header_iface.inc.php");
		//include("includes/AutoEntryFunctions.php");
		include("includes/_template/template.list.php");
		include("includes/_modules/part139337/part139337.list.php");
		include("includes/_dateandtime/dateandtime.list.php");										// List of all Date and Time functions
		include("includes/_navigation/navigation.list.php");										// List of all Navigation functions			
		include("includes/_systemusers/systemusers.list.php");										// List of all Navigation functions
		include("includes/_generalsettings/generalsettings.list.php");	
		
// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 21;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 3;							// Page is Type ID, see function for notes!
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
	
	$last_main_id	= $recordid;
	
		$sql 		= "SELECT * FROM tbl_139_337_main 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id 			= tbl_139_337_main.139337_author_by_cb_int 
		INNER JOIN tbl_139_337_sub_an 	ON tbl_139_337_sub_an.139337_sub_an_id 		= tbl_139_337_main.139337_action_cb_int 
		INNER JOIN tbl_139_337_sub_ay 	ON tbl_139_337_sub_ay.139337_sub_ay_id 		= tbl_139_337_main.139337_activity_cb_int 
		INNER JOIN tbl_139_337_sub_s 	ON tbl_139_337_sub_s.139337_sub_s_id 		= tbl_139_337_main.139337_species_cb_int
		WHERE 139337_id = '".$recordid."' ";

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

							$tmpdate 		= sqldate2amerdate($objarray['Discrepancy_date']);
							$reportedby 	= $objarray['emp_firstname']." ".$objarray['emp_lastname']." ";
							$fieldname		= $objarray['139337_numberofspecies']."x ".$objarray['139337_sub_s_name']." " ;

							//					Filed Name / Variable				b	f	h	j		w		x		y	z
							displaytxtonreport($objarray['139337_id'], 				1, 1, 30, "right", 	30, 	690, 	0, 	3);
							displaytxtonreport("Wildlife Report Information", 		1, 5, 30, "center", 713, 	0, 		0, 	4);	
							displaytxtonreport("Date", 								1, 3, 13, "left", 	190, 	5, 		32, 5);	
							displaytxtonreport($objarray['139337_date'], 			1, 3, 13, "left", 	190, 	95, 	32, 6);	
							displaytxtonreport("Reported By",	 					1, 3, 13, "left", 	190, 	290, 	32, 7);		
							displaytxtonreport($reportedby,							1, 3, 13, "left", 	190, 	395, 	32, 8);		
							displaytxtonreport("Time",								1, 3, 13, "left", 	190, 	5, 		52, 9);		
							displaytxtonreport($objarray['139337_time'],			1, 3, 13, "left", 	30, 	95, 	52, 10);	
							displaytxtonreport("# Species",							1, 3, 13, "left", 	190, 	290, 	52, 11);		
							displaytxtonreport($fieldname							,1, 3, 13, "left", 	190, 	395, 	52, 12);	
							
							displaytxtonreport("Here is teh Wildlife Report you requested. You may click on the target for more information.",		1, 1, 50, "right", 	132, 	611, 	33, 12);
		
							?>
	<div style="position:absolute; z-index:13; left:11; top:500; width:300; align="center" />
		<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" />
			<tr>
				<td colspan="2" align="center" valign="middle" align="center" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="4" COLOR="#000000" /><b>Wildlife Report</b></font>
					</td>
				</tr>				
			<tr>
				<td  align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Name </b></font>
					</td>	
				<td  align="right" valign="middle" width="*" align="center" background="images/part_139_327/cellbackground.png" height="25" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $fieldname;;?>
					</td>					
				</tr>
			<tr>
				<td  align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Animal Activity </b></font>
					</td>	
				<td  align="right" valign="middle" width="*" align="center" background="images/part_139_327/cellbackground.png" height="25" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $objarray['139337_sub_ay_name'];?>
					</td>					
				</tr>
			<tr>
				<td  align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Action Taken </b></font>
					</td>	
				<td  align="right" valign="middle" width="*" align="center" background="images/part_139_327/cellbackground.png" height="25" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $objarray['139337_sub_an_name'];?>
					</td>					
				</tr>
			<tr>
				<td  align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Results of Action </b></font>
					</td>	
				<td  align="right" valign="middle" width="*" align="center" background="images/part_139_327/cellbackground.png" height="100" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $objarray['139337_resultsofaction'];?>
					</td>					
				</tr>

				
			<tr>
				<td  align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Weather </b></font>
					</td>	
				<td  align="right" valign="middle" width="*" align="center" background="images/part_139_327/cellbackground.png" height="25" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $objarray['139337_weather'];?>
					</td>					
				</tr>								
			<tr>
				<td  align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>METAR </b></font>
					</td>	
				<td  align="right" valign="middle" width="*" align="center" background="images/part_139_327/cellbackground.png" height="25" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php echo $objarray['139337_metar'];?>
					</td>					
				</tr>								
			</table>
		</div>
						<?php
						// Provide Information for the Discrepancy Box Function
						
						$tempX		= 580;
						$tempY		= 155;
						$tmpzindex 	= 14;
				
						$disx		= convertfromlargescale_to_smallscale_x($objarray['139337_locationx'],$maparray);
						$disy		= convertfromlargescale_to_smallscale_y($objarray['139337_locationy'],$maparray);
														
						$disid		= $objarray['139337_id'];
						$disname 	= $objarray['139337_numberofspecies']."x ".$fieldname;
						$disremarks = $objarray['139337_resultsofaction'];
					
						part139337_displaybox("Entire Set", 1, 2, 30, "left", 150, $tempX, $tempY, $tmpzindex, $disid, $disname, $disremarks, $disx, $disy);
						}
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