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
		include("includes/_generalsettings/_gs_gis_settings.inc.php");					// Load GIS Functions
		
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
	INNER JOIN tbl_139_327_sub_t ON tbl_139_327_sub_t.inspection_type_id = tbl_139_327_main.type_of_inspection_cb_int 
	INNER JOIN tbl_139_327_sub_t_i ON tbl_139_327_sub_t_i.139327_sub_t_id_int = tbl_139_327_sub_t.inspection_type_id 
	WHERE inspection_system_id = '".$recordid."' ";

	//make connection to database
	$objconn1 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			
	//echo "SQL Statement is :".$sql1." <br>";
			
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
	displaytxtonreport("Here is the Inspection Record you requested. Checklist items where discrepancies were found are shown and marked with a red X.",		1, 1, 50, "right", 	132, 	611, 	33, 12);
							

// Placement Maps
	$offset_x						= 1;
	$offset_y						= 90;
	
	$checklistlocation[1]			= array(010,008);
	$checklistlocation[2]			= array(404,008);	
	$checklistlocation[3]			= array(205,008);
	$checklistlocation[4]			= array(010,351);	
	$checklistlocation[5]			= array(010,566);		
	$checklistlocation[6]			= array(205,649);		
	$checklistlocation[7]			= array(010,678);				// 4 records
	$checklistlocation[8]			= array(205,567);				// 3 records
	$checklistlocation[9]			= array(010,779);				// 2 records
	$checklistlocation[10]			= array(205,503);		
	$checklistlocation[11]			= array(205,708);	
	$checklistlocation[12]			= array(010,447);	
	$checklistlocation[13]			= array(205,776);	
	//$checklistlocation[14]			= array(310,833);	

	

							$sql2 = "SELECT * FROM tbl_139_327_sub_c_c 
							INNER JOIN tbl_139_327_sub_c ON tbl_139_327_sub_c.conditions_id = tbl_139_327_sub_c_c.conditions_checklists_condition_cb_int 
							INNER JOIN tbl_139_327_sub_c_f ON tbl_139_327_sub_c_f.facility_id = tbl_139_327_sub_c.condition_facility_cb_int 
							WHERE conditions_checklists_inspection_cb_int = ".$recordid." 
							ORDER BY facility_name, condition_name ";
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
											$counter = 1;
											
											while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
											
													$checklistcontent[$counter] = array($objarray2['facility_id'], $objarray2['facility_name'],$objarray2['condition_name'],$objarray2['conditions_checklist_discrepancy_yn']); 
													//echo "....counter number ".$counter." is ".$checklistcontent[$counter][0]." <br>";
											
												$counter = $counter + 1;
												}
										}
								}	// End of Condiitons Object Loop
								//mysqli_free_result($objrs3);
								//mysqli_close($objcon3);			
						}	// End of Checklist item while loop					
				}
		}	// End of Checklist object loop
								//mysqli_free_result($objrs2);
								//mysqli_close($objcon2);	
								?>					
				</table>
			</div>
		<?php
		// Loop Chckjlist array
		$display 			= 0;
		$previousfacility 	= 0;
		
		for ($i=1; $i <=count($checklistlocation); $i=$i+1) {
		
				?>
	<div style="position:absolute; z-index:99; left:<?php echo $checklistlocation[$i][0] + $offset_x;?>; top:<?php echo $checklistlocation[$i][1] + $offset_y;?>; width:190; align="center" />
		<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-width: 1px; border-spacing: 0px;border-style: inset;border-color: gray;border-collapse: collapse;">
				<?php
				
				//echo "For Loop ".$i." Iteration of ".count($checklistlocation)." 					<br>";
	
	/* 		<tr>
				<td width="120" align="center" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="1" COLOR="#000000" /><b>Facility</b></font>
					</td>
				<td width="140" align="center" bgcolor="#FFFFFF"  background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="1" COLOR="#000000" /><b>Condiiton</b></font>
					</td>	
				<td width="20" align="center" bgcolor="#FFFFFF"  background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="1" COLOR="#000000" /><b>Disc.</b></font>
					</td>					
				</tr>		 */
				
				for ($j=1; $j <=count($checklistcontent); $j=$j+1) {
				
						//echo "[in i]: For Loop ".$j." Iteration of ".count($checklistcontent)." 	<br>";
						//echo "[in i]: Is the current checklist content eqaual to i? 				<br>";
				
						if($checklistcontent[$j][0] == $i) {
							
								//echo "[in i]: Current checklist content is eqaual to i 				<br>";
							
								$display = $display +1;
									
								//echo "[in i]: What was the previous Facility Displayed?				<br>";
								//echo "[in i]: >> it was ".$previousfacility."						<br>";
									
								if($previousfacility == 0) {
										
										//echo "[in i]: The previous facility is equal to 0			<br>";
										//echo "[in i]: >> Nothing has been displayed yet				<br>";
										
										$check = 2;
									}
									else {
									
										//echo "[in i]: The previous facility is NOT equal to 0		<br>";
										//echo "[in i]: >> is it equal to the checklist ID?			<br>";
										
										if($checklistcontent[$j][0] == $previousfacility) {
												
												//echo "[in i]: The Previous Facility is the ID		<br>";
												//echo "[in i]: >> Do not display Facility			<br>";
												
												$check = 1;
											}
											else {
											
												//echo "[in i]: The Previous Facility is NOT the ID	<br>";
												//echo "[in i]: >> Do display Facility				<br>";
												
												$check = 2;
												
											}
									}
									//echo "Checklist will be located at ".$checklistlocation[$i][0].", ".$checklistlocation[$i][1]." <br>"; 
								
								if($check == 2) {
								
										//echo "[in j]: Display Facility Header	<br>";
										?>
			<tr>
				<td colspan="2" align="center" valign="middle" width="*" align="center" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><?php echo $checklistcontent[$j][1];?></font>
					</td>
				</tr>
										<?php
									}
									?>
			<tr>
				<td  align="right" valign="middle" width="*" align="center" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><?php echo $checklistcontent[$j][2];?></font>
					</td>	
				<td  align="right" valign="middle" width="20" align="center" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<?php
					if ($checklistcontent[$j][3] == 0) {
							//Display Clean X
							$image = 'greenx.png';
						}
						else {
							$image = 'redx.gif';
						}
						?>
					<image src="images/part_139_327/<?php echo $image;?>" width="13" height="13">		
					</td>					
				</tr>
									<?php
								
								
								
								
								}

						$previousfacility = $checklistcontent[$j][0];

					}
					?>
			</table>
		</div>
					<?php

		
			}
		
			//echo "Total Display is ".$display." <br>";
			//echo "Count of Checklist items is ".count($checklistcontent)." <br>";
								

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
														
													$lastdisheight = part139327discrepancydisplaybox("Discrepancy Display Box", 1, 2, 30, "left", 150, $tempX, $tempY, $tmpzindex, $disid, $disname, $disremarks, $disx, $disy, $distools);
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
	
													$disx		= convertfromlargescale_to_smallscale_x($objarray1['Discrepancy_location_x'],$maparray);
													$disy		= convertfromlargescale_to_smallscale_y($objarray1['Discrepancy_location_y'],$maparray);
													
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
														
													$lastdisheight = part139327discrepancydisplaybox("Discrepancy Display Box", 1, 2, 30, "left", 150, $tempX, $tempY, $tmpzindex, $disid, $disname, $disremarks, $disx, $disy, $distools);
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