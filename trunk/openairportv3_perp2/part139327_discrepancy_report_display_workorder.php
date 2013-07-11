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
//	Name of Document		:	part139327_discrepancy_report_display_workorder.php
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
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes
		//include("includes/_dateandtime/dateandtime.list.php");
		include("scripts/_scripts_header_iface.inc.php");
		//include("includes/_systemusers/systemusers.list.php");
		include("includes/_modules/part139327/part139327.list.php");
		//include("includes/_navigation/navigation.list.php");
		include("includes/_template/template.list.php");
		//include("includes/_generalsettings/generalsettings.list.php");					// Load GIS Functions
		
		?>
		<link href="stylesheets/reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY>
	
	<!-- Map -->
	<div style="position:absolute; z-index:1; left:3; top:84; width:<?php echo $maparray[3][1];?>;" align="left" />
		<img src="images/part_139_327/<?php echo $maparray[3][0];?>" width="<?php echo $maparray[3][1];?>" height="<?php echo $maparray[3][2];?>" />
		</div>
	<!-- Overlay -->
	<div style="position:absolute; z-index:2; left:0; top:30; width:<?php echo $maparray[2][1];?>;" align="left" />
		<img src="images/part_139_327/<?php echo $maparray[2][0];?>" width="<?php echo $maparray[2][1];?>" height="<?php echo $maparray[2][2];?>" />
		</div>

<?

// Define Variables	
		
		$navigation_page 			= 16;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 24;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures

if (!isset($_POST["recordid"])) {
		// There is no POST recordid. Did it get a GET instead?
		$recordid = $_GET['recordid'];
	}
	else {
		$recordid = $_POST['recordid'];
	}

	$sql = "SELECT * FROM tbl_139_327_sub_d WHERE Discrepancy_id = '".$recordid."' ";

	$last_main_id = $recordid;
	
	//echo $sql;
	//make connection to database
	$objconn  = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
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
							displaytxtonreport("Discrepancy Work Order", 			1, 5, 30, "center", 713, 	0, 		0, 	4);	
							displaytxtonreport("DATE", 								1, 3, 13, "left", 	190, 	5, 		32, 5);	
							displaytxtonreport($tmpdate, 							1, 3, 13, "left", 	190, 	95, 	32, 6);	
							displaytxtonreport("PRIORITY",	 						1, 3, 13, "left", 	190, 	290, 	32, 7);		
							displaytxtonreport($objarray['discrepancy_priority'],	1, 1, 13, "left", 	190, 	395, 	32, 8);		
							displaytxtonreport("TIME",								1, 3, 13, "left", 	190, 	5, 		52, 9);		
							displaytxtonreport($objarray['Discrepancy_time'],		1, 3, 13, "left", 	30, 	95, 	52, 10);	
							displaytxtonreport("NAME",								1, 3, 13, "left", 	190, 	290, 	52, 11);			
							displaytxtonreport($objarray['Discrepancy_name'],		1, 1, 13, "left", 	190, 	395, 	52, 12);	
							
							displaytxtonreport("Discrepancy Workorder Form.",		1, 1, 50, "right", 	132, 	611, 	33, 12);
							
							?>
	<div style="position:absolute; z-index:13; left:11; top:385; width:300; align="center" />
		<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" />
			<tr>
				<td colspan="2" align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
					Discrepancy Information
					</td>
				</tr>				
			<tr>
				<td align="left" valign="middle" bgcolor="#C8C8C8" style="opacity:.7;" height="42" width="125" />
					&nbsp; Name
					</td>	
				<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
					<?php echo $objarray['Discrepancy_name'];?>
					</td>					
				</tr>
			<tr>
				<td align="left" valign="middle" bgcolor="#C8C8C8" style="opacity:.7;" height="42" width="125" />
					&nbsp; Comments
					</td>	
				<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
					<?php echo $objarray['discrepancy_remarks'];?>
					</td>					
				</tr>
			<tr>
				<td colspan="2">
					<table border="0" cellpadding="1" width="100%" id="table1" cellpadding="0" style="border-collapse: collapse">
							<?
							$sql2 = "SELECT * FROM tbl_139_327_sub_d_r 
							INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d_r.discrepancy_repaired_by_cb_int 
							WHERE discrepancy_repaired_inspection_id = '".$recordid."' AND discrepancy_repaired_archived_yn = 0 
							ORDER BY discrepancy_repaired_date,discrepancy_repaired_time";
							
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
											
											if ($number_of_rows >= 1) {
											?>
						<tr>
							<td colspan="4" align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Repair History
								</td>
							</tr>
						<tr>
							<td align="center" valign="middle" align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Date
								</td>
							<td align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Time
								</td>
							<td align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								By
								</td>
							<td align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Comments
								</td>
							</tr>							
											<?php
												}
												else {
													?>
						<tr>
							<td colspan="4" align="center" valign="middle" align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								No Repair History
								</td>
							</tr>													
													<?php
												}
											while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	
													?>
						<tr>
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['discrepancy_repaired_date'];?>
								</td>		
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['discrepancy_repaired_time'];?>
								</td>	
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['emp_initials'];?>
								</td>		
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['discrepancy_repaired_comments'];?>
								</td>									
							</tr>													
													<?php
												}
										}
								}
							?>
						</table>
					</td>
				</tr>					
			<tr>
				<td colspan="2">
					<table border="0" cellpadding="1" width="100%" id="table1" cellpadding="0" style="border-collapse: collapse">			
							<?php
							$sql2 = "SELECT * FROM tbl_139_327_sub_d_b 
							INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d_b.discrepancy_bounced_by_cb_int 
							WHERE discrepancy_bounced_inspection_id = '".$recordid."' AND discrepancy_bounced_archived_yn = 0
							ORDER BY discrepancy_bounced_date,discrepancy_bounced_time";
							
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
											
											if ($number_of_rows >= 1) {
											?>
						<tr>
							<td colspan="4" align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Bounced History
								</td>
							</tr>
						<tr>
							<td align="center" valign="middle" align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Date
								</td>
							<td align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Time
								</td>
							<td align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								By
								</td>
							<td align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Comments
								</td>
							</tr>														
												<?php
												}
												else {
													?>													
													<?php
												}
											while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	
													?>
						<tr>
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['discrepancy_bounced_date'];?>
								</td>		
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['discrepancy_bounced_time'];?>
								</td>	
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['emp_initials'];?>
								</td>		
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['discrepancy_bounced_comments'];?>
								</td>									
							</tr>													
													<?php
												}
										}
								}
							?>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="2">
					<table border="0" cellpadding="1" width="100%" id="table1" cellpadding="0" style="border-collapse: collapse">			
							<?php
							$sql2 = "SELECT * FROM tbl_139_327_sub_d_c 
							INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d_c.discrepancy_closed_by_cb_int 
							WHERE discrepancy_closed_inspection_id = '".$recordid."' 
							ORDER BY discrepancy_closed_date,discrepancy_closed_time";
							
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
											
											if ($number_of_rows >= 1) {
											?>
						<tr>
							<td colspan="4" align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Closed History
								</td>
							</tr>
						<tr>
							<td align="center" valign="middle" align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Date
								</td>
							<td align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Time
								</td>
							<td align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								By
								</td>
							<td align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
								Comments
								</td>
							</tr>															
												<?php
												}
												else {
													?>
													<?php
												}
											while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	
													?>
						<tr>
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['discrepancy_closed_date'];?>
								</td>		
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['discrepancy_closed_time'];?>
								</td>	
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['emp_initials'];?>
								</td>		
							<td align="right" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" />
								<?php echo $objarray2['discrepancy_closed_reason'];?>
								</td>									
							</tr>														
													<?php
												}
										}
								}
							?>
						</table>
					</td>
				</tr>				
			<tr>
				<td colspan="2" align="center" valign="middle" bgcolor="#C0C0C0" style="opacity:.7;" />
					Work Order Form
					</td>
				</tr>
			<tr>
				<td align="center" valign="middle" bgcolor="#C8C8C8" style="opacity:.7;" height="45"/>
					Date Completed
					</td>	
				<td align="center" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" height="45"/>
					&nbsp;
					</td>					
				</tr>				
			<tr>
				<td align="center" valign="middle" bgcolor="#C8C8C8" style="opacity:.7;" height="45"/>
					Time Completed
					</td>	
				<td align="center" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" height="45"/>
					&nbsp;
					</td>						
				</tr>					
			<tr>
				<td align="center" valign="middle" bgcolor="#C8C8C8" style="opacity:.7;" height="45"/>
					Completed By
					</td>	
				<td align="center" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" height="45"/>
					&nbsp;
					</td>						
				</tr>					
			<tr>
				<td align="center" valign="middle" bgcolor="#C8C8C8" style="opacity:.7;" height="45"/>
					Remarks
					</td>	
				<td align="center" valign="middle" bgcolor="#FFFFFF" style="opacity:.7;" height="45"/>
					&nbsp;
					</td>					
				</tr>				
			</table>
		</div>
					<?php
					// Provide Information for the Discrepancy Box Function
					
					$tempX		= 580;
					$tempY		= 155;
					$tmpzindex 	= 14;
			
					$disx		= convertfromlargescale_to_smallscale_x($objarray['Discrepancy_location_x'],$maparray);
					$disy		= convertfromlargescale_to_smallscale_y($objarray['Discrepancy_location_y'],$maparray);
					
					$disid		= $objarray['Discrepancy_id'];
					$disname 	= $objarray['Discrepancy_name'];
					$disremarks = $objarray['discrepancy_remarks'];
				
					part139327discrepancydisplaybox("Discrepancy Display Box", 1, 2, 30, "left", 150, $tempX, $tempY, $tmpzindex, $disid, $disname, $disremarks, $disx, $disy,1);
					}
			}
	}
	
// Establish Page Variables
		
		$auto_array					= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>	