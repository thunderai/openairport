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
//	Name of Document	:	part139327_display_new_report.php
//
//	Purpose of Page		:	Display any Part 139.327 Inspection Report
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
		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_navigation/_nav_displaytxtonreport.inc.php");
		include("includes/_template/template.list.php");
		
		?>
		<link href="stylesheets/reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY>
<?php
if (!isset($_POST["recordid"])) {
		// There is no POST recordid. Did it get a GET instead?
		$recordid = $_GET['recordid'];
	}
	else {
		$recordid = $_POST['recordid'];
	}

	$sql1 = "SELECT * FROM tbl_139_327_main 
	INNER JOIN tbl_139_327_sub_t ON inspection_type_id = type_of_inspection_cb_int
	INNER JOIN tbl_139_327_sub_t_i ON 139327_sub_t_id_int = inspection_type_id	
	WHERE inspection_system_id = '".$recordid."' ";

	//make connection to database
	$objconn1 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
										
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs1 = mysqli_query($objconn1, $sql1);
						
			if ($objrs1) {
					$number_of_rows = mysqli_num_rows($objrs1);
					while ($objarray1 = mysqli_fetch_array($objrs1, MYSQLI_ASSOC)) {	

							$name_of_image_background 	= $objarray1['139327_sub_t_image'];
							$tmpid 						= $objarray1['inspection_system_id'];
							
							//echo "image name".$name_of_image_background;
							?>
	<div style="position:absolute; z-index:1; left:3; top:74; width:711; align="left" />
		<img src="images/part_139_327/<?php echo ($name_of_image_background);?>" width="711" height="849" />
		</div>
	<div style="position:absolute; z-index:2; left:0; top:30; width:717; align="left" />
		<img src="images/part_139_327/139_327_overlaygrid_new.gif" width="750" height="962" />
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
	
	$tmp_type 		= part139327typestextfield($objarray1['type_of_inspection_cb_int'], "all", "hide", "hide", "");
	
	$tmpsqldate 	= $objarray1['139327_date'];
	$tmpsqltime		= $objarray1['139327_time'];
	$tmpdate 		= sqldate2amerdate($objarray1['139327_date']);
	
	$tmpstartdate 	= strtotime($tmpdate);
	$astartdate 	= getdate($tmpstartdate);
	$intstartday	= $astartdate ["weekday"];
	
	$tmptime 		= $objarray1['139327_time'];
	$insptimestamp	= $objarray1['139327_timestamp'];
	
	$tmpinspector	= systemusertextfield($objarray1['inspection_completed_by_cb_int'], "all", "all", "hide", "all");
	
	//					Filed Name / Variable				b	f	h	j		w		x		y	z
	displaytxtonreport($objarray1['inspection_system_id'], 	1, 1, 30, "right", 	30, 	690, 	0, 	3);
	displaytxtonreport($tmp_type, 							1, 5, 30, "center", 713, 	0, 		0, 	4);	
	displaytxtonreport("DATE", 								1, 3, 13, "left", 	190, 	5, 		32, 5);	
	displaytxtonreport($tmpdate, 							1, 3, 13, "left", 	190, 	95, 	32, 6);	
	displaytxtonreport("DAY",	 							1, 3, 13, "left", 	190, 	290, 	32, 7);		
	displaytxtonreport($intstartday,						1, 3, 13, "left", 	190, 	395, 	32, 8);		
	displaytxtonreport("TIME",								1, 3, 13, "left", 	190, 	5, 		52, 9);		
	displaytxtonreport($objarray1['139327_time'],			1, 3, 13, "left", 	30, 	95, 	52, 10);	
	displaytxtonreport("INSPECTOR",							1, 3, 13, "left", 	190, 	290, 	52, 11);			
	displaytxtonreport($tmpinspector,						1, 3, 13, "left", 	190, 	395, 	52, 12);		

// Placement Maps
	
	$checklistlocations[10][90]		= 1;
	$checklistlocations[10][200]	= 2;
	$checklistlocations[10][300]	= 3;
	$checklistlocations[10][500]	= 4;	
	$checklistlocations[10][700]	= 5;
	$checklistlocations[350][90]	= 6;	
	$checklistlocations[350][700]	= 7;
	$checklistlocations[350][700]	= 8;	
	$checklistlocations[350][700]	= 9;
	$checklistlocations[350][700]	= 10;
	$checklistlocations[350][700]	= 11;
	$checklistlocations[350][700]	= 12;
	$checklistlocations[350][700]	= 13;
	
	
	
	
	
	
	?>
		<div style="position:absolute; z-index:13; left:5; top:300; width:296; align="center" />
			<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" />
				<tr>
      				<td width="*" align="center" bgcolor="#666666" height="15" />
      						<font COLOR="#FFFFFF" /><b>Facilities</b> </font>
						</td>
      				<td width="*" align="center" bgcolor="#666666" height="15" />
      						<font COLOR="#FFFFFF" /><b>Conditions</b> </font>
						</td>
      				<td width="18" align="center" bgcolor="#666666" height="15" />
      						<font COLOR="#FFFFFF" /><b>A</b> </font>
						</td>
      				<td width="18" align="center" bgcolor="#666666" height="15" />
      						<font COLOR="#FFFFFF" /><b>D</b> </font>
						</td>
    				</tr>
<?php


	$sql2 = "SELECT * FROM tbl_139_327_sub_c_c WHERE conditions_checklists_inspection_cb_int = ".$recordid." ";
	//echo "SQL 2 is ".$sql2."<br>";
	
	//make connection to database
	$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs2 = mysqli_query($objconn2, $sql2);
						
			if ($objrs2) {
					$number_of_rows = mysqli_num_rows($objrs2);
					while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
							$tmpconditionid = $objarray2['conditions_checklists_condition_cb_int'];
							$tmpdiscrepancy = $objarray2['conditions_checklist_discrepancy_yn'];
							
							$sql3 = "SELECT * FROM tbl_139_327_sub_c WHERE conditions_id = ".$tmpconditionid." ";
							//echo "SQL 3 is ".$sql3."<br>";
							
							//make connection to database
							$objconn3 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
							if (mysqli_connect_errno()) {
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else {
									$objrs3 = mysqli_query($objconn3, $sql3);
									if ($objrs3) {
											$number_of_rows = mysqli_num_rows($objrs3);
											while ($objarray3 = mysqli_fetch_array($objrs3, MYSQLI_ASSOC)) {							
													?>
					<tr>
      					<td width="*" align="center" background="images/part_139_327/cellbackground.png" height="15" />
      						<font size="1" COLOR="#000000" />
													<?php
														part139327facilitycombobox($objarray3['condition_facility_cb_int'], "all", "all", "hide", "all")
														?>								
							</font>
						</td>
      					<td width="*" align="center" background="images/part_139_327/cellbackground.png" height="15" />
      						<font size="1" COLOR="#000000" />
													<?php echo $objarray3['condition_name'];?>
							</font>
						</td>
					<td align="center" background="images/part_139_327/cellbackground.png" height="15" />
      					<font size="1" COLOR="#000000" />
													<?php
													if($tmpdiscrepancy==0) {
															?>
								<img src="images/part_139_327/greenx.gif">
															<?php
														}
													?>
							</font>
						</td>
      					<td align="center" background="images/Part_139_327/cellbackground.png" height="15" />
      						<font size="1" COLOR="#000000" />
													<?php
													if($tmpdiscrepancy!=0) {
															?>
								<img src="images/part_139_327/redx.gif">
															<?php
														}
													?>
							</font>
						</td>
    				</tr>
																		<?php
												}	// End of Conditions While Loop
																}
														}	// End of Condiitons Object Loop
														mysqli_free_result($objrs3);
														//mysqli_close($objcon3);							
												}	// End of Checklist item while loop					
										}
								}	// End of Checklist object loop
								mysqli_free_result($objrs2);
								//mysqli_close($objcon2);	
								?>					
				</table>
			</div>
						<?php
						}	// End of Main While Loop
				}	// End of Main Object Loop
		}	// End of Main item Loop
		mysqli_free_result($objrs1);
		//mysqli_close($objcon1);	
		
	//
	// END OF DISPLAY BASIC REPORT
	?>
			
	<?php
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
	
					$sql1 = "SELECT * FROM tbl_139_327_sub_d WHERE discrepancy_inspection_id = ".$recordid." ORDER BY Discrepancy_location_y";
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
											
											$displayrow_a				= preflights_tbl_139_327_main_sub_d_a_yn($objarray1['Discrepancy_id'],0); // 1 will not return a row even if it is archieved.
											$displayrow_d				= preflights_tbl_139_327_main_sub_d_d_yn($objarray1['Discrepancy_id'],0); // 1 will not return a row even if it is duplicate.

											//echo "Display A ".$displayrow_a." / Display D ".$displayrow_d." <br>";
											
											if($displayrow_a == 0 OR $displayrow_d == 0) {
													// Do display Row
													$displayrow = 0;
												}
												else {
													$displayrow = 1;
												}
											
											if($displayrow == 1) {
											//echo "Display ".$display."<br>sddsfsdfsd";
	
	//				Record some information about the current discrepancy	
	
													$disx 		= $objarray1['Discrepancy_location_x'];
													$disy 		= $objarray1['Discrepancy_location_y'];
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
														
													$lastdisheight = part139327discrepancydisplaybox("Discrepancy Display Box", 1, 2, 30, "left", 120, $tempX, $tempY, $tmpzindex, $disid, $disname, $disremarks, $disx, $disy, $distools);
												}
											
											$passindex 		= ( $passindex + 1 );	
											$totaldisheight = ( $totaldisheight + $lastdisheight );
											//echo "Total Disheight = ".$totaldisheight."/ ".$tempY;
										}
								}
						}
				
	//		2.		Build SQL String
	
					$sql1 = "SELECT * FROM tbl_139_327_sub_d_o 
					INNER JOIN tbl_139_327_sub_d ON tbl_139_327_sub_d_o.disdis_id = tbl_139_327_sub_d.Discrepancy_id 
					WHERE tbl_139_327_sub_d_o.disinspection_id ='".$recordid."' ORDER BY Discrepancy_location_y";

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
											
											$displayrow_a				= preflights_tbl_139_327_main_sub_d_a_yn($objarray1['Discrepancy_id'],0); // 1 will not return a row even if it is archieved.
											$displayrow_d				= preflights_tbl_139_327_main_sub_d_d_yn($objarray1['Discrepancy_id'],0); // 1 will not return a row even if it is duplicate.

											//echo "Display A ".$displayrow_a." / Display D ".$displayrow_d." <br>";
											
											if($displayrow_a == 0 OR $displayrow_d == 0) {
													// Do display Row
													$displayrow = 0;
												}
												else {
													$displayrow = 1;
												}
											
											if($displayrow == 1) {
											//echo "Display ".$display."<br>sddsfsdfsd";
	
	//				Record some information about the current discrepancy	
	
													$disx 		= $objarray1['Discrepancy_location_x'];
													$disy 		= $objarray1['Discrepancy_location_y'];
													$disid		= $objarray1['Discrepancy_id'];
													$disname 	= $objarray1['Discrepancy_name'];
													$disremarks = $objarray1['discrepancy_remarks'];	
													
													if ($passindex == 0) {
															// No discrepancy has been displayed, use default settings
															//$tempX			= 580;
															//$tempY			= $lastadded;
														}
														else {
															$tempY		= $tempYo + ( $totaldisheight + ( $spacebetweendis) );
															$tempX		= $tempX;
														}
														
													$lastdisheight = part139327discrepancydisplaybox("Discrepancy Display Box", 1, 2, 30, "left", 120, $tempX, $tempY, $tmpzindex, $disid, $disname, $disremarks, $disx, $disy, $distools);
												}
												
											$passindex = $passindex + 1;	
											$totaldisheight = ( $totaldisheight + $lastdisheight );
											//echo "Total Disheight = ".$totaldisheight."/ ".$tempY;
										}
								}
						}														
							
			$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
			$tmpsqltime		= date("H:i:s");
			$tmpsqlauthor	= $_SESSION["user_id"];
			$dutylogevent	= "Printed Part 139 Self Inspection Report ID:".$tmpid.", dated ".$tmpdate." at ".$tmptime."";	
			
			autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
			?>