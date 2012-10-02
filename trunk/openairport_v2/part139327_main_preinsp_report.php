<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.327 Main Pre Inspection Report.phpThe purpose of this page is to enter new Part 139.327 Airport Safety Self Inspections
	
								Usage:
								This is a complete custom form for the purposes of entering Part 139.327 inspections and should not be used as a template for another form
								unless that other form functions just like this one.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		//include("includes/header.php");																	// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/DateFunctions.php");													// already included in header.php
		include("includes/UserFunctions.php");													// already included in header.php
		include("includes/FormFunctions.php");													// already included in header.php
		include("includes/NavFunctions.php");													// already included in header.php
		
	// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.

?>
<HTML>
	<HEAD>
		<TITLE>
			Open Airport - Airport Safety Self-Inspection Report (Printer Friendly)
			</TITLE>
		<script type="text/javascript" src="scripts/ajax.js"></script>
		<script type="text/javascript" src="scripts/AjaxRequest.js"></script>
		<link href="reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<div style="position:absolute; z-index:1; left:3; top:74; width:711; align="left" />
		<img src="images/part_139_327/alp_inspection_new4_current.gif" width="711" height="849" />
		</div>
	<div style="position:absolute; z-index:2; left:0; top:30; width:717; align="left" />
		<img src="images/part_139_327/139_327_overlaygrid.gif" width="718" height="962" />
		</div>		
	<div style="position:absolute; z-index:3; left:690; top:0; width:30; align="center" />
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width"30" id="AutoNumber1" />
			<tr align="center" />
				<td align="right" />
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:3; left:300; top:900; width:450; align="center" />
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width"450" id="AutoNumber1" />
			<tr align="center" />
				<td align="left" />
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:4; left:0; top:0; width:713; align="center" />
		<center>
			<font size="5">
				<?
				part139327typescombobox($_POST['InspCheckList'], "all", "hide", "hide", "");
				?>
				</font>
			</center>
		</div>
	<div style="position:absolute; z-index:5; left:5; top:32; width:190; align="left" />
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
			<tr align="left" />
				<td align="left" />
					<b>DATE</b>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:6; left:95; top:32; width:190; align="left" />
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
			<tr align="center" />
				<td align="center" />
					<b></b>	
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:7; left:290; top:32; width:190; align="center" />
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
			<tr align="left" />
				<td align="left" />
					<b>DAY</b>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:8; left:392; top:32; width:185; align="center" />
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13" />
			<tr align="center" />
				<td align="center" />
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:9; left:5; top:52; width:190; align="left" />
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
			<tr align="left" />
				<td align="left" />
					<b>TIME</b>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:10; left:95; top:52; width:190; align="left" />
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
			<tr align="center">
				<td align="center">
					<b></b>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:11; left:290; top:52; width:190; align="center" />
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="190" id="AutoNumber1" height="13" />
			<tr align="left" />
				<td align="left" />
					<b>INSPECTOR</b>
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:12; left:392; top:52; width:190; align="center" />
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="185" id="AutoNumber1" height="13" />
			<tr align="center" />
				<td align="center" />
					</td>
				</tr>
			</table>
		</div>
	<div style="position:absolute; z-index:13; left:2; top:385; width:296; align="center" />
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
<?
	$sql = "SELECT * FROM tbl_139_327_sub_c WHERE condition_type_cb_int = '".$_POST['InspCheckList']."' ";

	//make connection to database
	$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs2 = mysqli_query($objconn2, $sql);
						
			if ($objrs2) {
					$number_of_rows = mysqli_num_rows($objrs2);
					while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
							?>
					<tr>
      					<td width="*" align="center" bgCOLOR="#FFFFFF" height="15" />
      						<font size="1" COLOR="#000000" />
							<?
								part139327facilitycombobox($objarray2['condition_facility_cb_int'], "all", "all", "hide", "all")
								?>								
							</font>
						</td>
      					<td width="*" align="center" bgCOLOR="#FFFFFF" height="15" />
      						<font size="1" COLOR="#000000" />
						<?=$objarray2['condition_name'];?>
							</font>
						</td>
					<td align="center" bgCOLOR="#FFFFFF" height="15" />
      					<font size="1" COLOR="#000000" />
							</font>
						</td>
      					<td align="center" bgCOLOR="#FFFFFF" height="15" />
      						<font size="1" COLOR="#000000" />
							</font>
						</td>
    				</tr>
						<?
												}	// End of Conditions While Loop
										}
									}	// End of Condiitons Object Loop

					?>					
				</table>
			</div>
<?
if (!isset($_POST['disarchive'])) {
		$disarchive = 0;
	}
	else {
		$disarchive = 1;
	}
if ($disarchive == 1) {
// Make sql Statement

	$discrepancybouncedid 	= "";
	$discrepancybounceddate = "";
	$discrepancybouncedtime = "";
	$discrepancyrepairid 	= "";
	$discrepancyrepairdate 	= "";
	$discrepancyrepairtime 	= "";
	$isduplicate			= "";
	$isarchived				= "";
	$displaydatarow			= "";
	$displaydiscrepancy 	= "";
	$OffSetX 				= -4;
	$OffSetY 				= 66;
	$tmpzindex 				= 14;
		
	$tmpsqldate	= date('m/d/Y');
	$tmpsqldate	= amerdate2sqldatetime($tmpsqldate);
	
	$sql = "SELECT * FROM tbl_139_327_sub_d WHERE Discrepancy_date <='".$tmpsqldate."' ";
	//make connection to database
	$objconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");

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
							$tmpdiscrepancyid			= $objarray['Discrepancy_id'];
							$tmpdiscrepancycondition	= $objarray['discrepancy_checklist_id'];
							$TempX 						= ($objarray['Discrepancy_location_x'] + $OffSetX );
							$TempY						= ($objarray['Discrepancy_location_y'] + $OffSetY );
							?>
							<?
							// Connection to database established and we are now looping through every discrepancy. We first check to see if this discrepancy is archived or a duplicate
							
							// Checking to see if it is a duplicare
							$sql2 = "SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = '".$tmpdiscrepancyid."' ";
							//echo $sql2;
							//make connection to database
							$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
							if (mysqli_connect_errno()) {
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else {
									$objrs2 = mysqli_query($objconn2, $sql2);
									if ($objrs2) {
											$number_of_rows = mysqli_num_rows($objrs2);
											//echo $number_of_rows;
											while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
													$tmpid = $objarray2['discrepancy_duplicate_id'];
													$isduplicate = 1;
												}
										}
								}	// End of checking to see if discrepancy is a duplicate
							$sql2 = "SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = '".$tmpdiscrepancyid."' ";
							//make connection to database
							$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
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
													$tmpid = $objarray2['discrepancy_archeived_id'];
													$isarchived = 1;
												}
										}
								}	// End of checking to see if the discrepancy is archived
							if ($isduplicate!=1) {
									// Discrepancy is not a duplicate
									if ($isarchived!=1) {
											// Discrepancy is not archived
											$displaydatarow=1;
										}
										else {
											// Discrepancy is archived
											//Do not display it
										}
								}
								else {
									// Discrepancy is a duplicate
									if ($isarchived!=1) {
											//Discrepancy is not archived
											// We would display, but we are not going to because the discrepancy is a duplicate
										}
										else {
											// Discrepancy is archived
											//Do not display it
										}
								}
							if ($displaydatarow==1) {
									// Discrepancy has passed the initial screening process, we now want to load information about the discrepancy condition.
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = '".$tmpdiscrepancyid."' ORDER BY discrepancy_bounced_date, discrepancy_bounced_time";
									//echo $sql2;		
									//make connection to database
												
									$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}
										else {
											$objrs2 = mysqli_query($objconn2, $sql2);
						
											if ($objrs2) {
													$number_of_rows = mysqli_num_rows($objrs2);
													//echo "Bouced Rows ".$number_of_rows;
													while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
														$discrepancybouncedid 	= $objarray2['discrepancy_bounced_id'];
														$discrepancybounceddate = $objarray2['discrepancy_bounced_date'];
														$discrepancybouncedtime = $objarray2['discrepancy_bounced_time'];
														//echo $discrepancybouncedtime;
														?>
														<?	
														}
												}
										}
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = '".$tmpdiscrepancyid."' ORDER BY discrepancy_repaired_date, discrepancy_repaired_time";
									//make connection to database
												
									$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}
										else {
											$objrs2 = mysqli_query($objconn2, $sql2);
						
											if ($objrs2) {
													$number_of_rows = mysqli_num_rows($objrs2);
													//echo $number_of_rows;
													while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
														$discrepancyrepairid = $objarray2['discrepancy_repaired_id'];
														$discrepancyrepairdate = $objarray2['discrepancy_repaired_date'];
														$discrepancyrepairtime = $objarray2['discrepancy_repaired_time'];
														//echo $discrepancyrepairtime;
														?>
														<?	
														}
												}
										}
									//echo "discrepancyrepairid".$discrepancyrepairid;
									//echo "discrepancybouncedid".$discrepancybouncedid."<br>";
									if ($discrepancyrepairid == "") {							// There is no repair history. Without being repaired you by definition cant bounce so we give the user the workorder button
											//echo "WorkOrder";
											?>
		<div style="position:absolute; z-index:<?=$tmpzindex;?>; left:<?=$TempX-12;?>; top:<?=$TempY-10;?>; width:122; align="left" />							
			<table border="0" width="12%" cellspacing="0" cellpadding="0" id="table1" width="122">
				<tr>
					<td width="53"				align="right" 	valign="top" rowspan="4" 				background="images/part_139_327/dboxleftroller.gif"	><img border="0" 	src="images/part_139_327/dboxtarget.gif" width="53" 	height="58"></td>
					<td width="16" 	height="26"	align="left" 	valign="top"																	><img border="0" 	src="images/part_139_327/dboxid.gif" 	width="16" 	height="26"></td>
					<td width="83" 	height="26" align="left" 	valign="middle" bgcolor="#0000FF" style="border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom: 1px solid #000000">&nbsp;<font size="2" color="#FFFFFF"><?=$objarray['Discrepancy_id'];?></font></td>
					<td width="10" 	height="26" align="right" 	valign="top"																	><img border="0" 	src="images/part_139_327/dboxidright.gif" width="10" height="26"></td>
					</tr>
				<tr>
					<td width="83" 				align="left" 	valign="top" rowspan="4" colspan="2"											><img border="0" 	src="images/part_139_327/dboxidbottom.gif" width="83" height="3"><br>
						<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
							<tr>
								<td>
									<font size="1">Name:</font>
									</td>
								</tr>
							<tr>
								<td background="images/part_139_327/dboxbackground.gif">
									<font size="2"><b><?=$objarray['Discrepancy_name'];?></b></font>
									</td>
								</tr>
							<tr>
								<td>
									<font size="1">Description:</font>
									</td>
								</tr>
							<tr>
								<td background="images/part_139_327/dboxbackground.gif">
									<font size="3"><b><?=$objarray['discrepancy_remarks'];?></b></font>
									</td>
								</tr>
							<tr>
								<td>
									<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
										<tr>
											<form style="margin-bottom:0;" action="part139327_sub_d_workorder.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$objarray[$tblkeyfield];?>">
												<input type="submit" value="W.O." name="b1" class="formsubmit" onMouseover="ddrivetip('Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											</tr>
										</table>
									</td>
								</tr>
							</table>							
					<td width="8%" align="left" valign="top" background="images/part_139_327/dboxrightroller.gif" height="72"><img border="0" src="images/part_139_327/dboxrighttopcorner.gif" width="10" height="8"></td>
					</tr>
				<tr>
					<td width="8%" background="images/part_139_327/dboxrightroller.gif" height="19">&nbsp;</td>
					</tr>
				<tr>
					<td width="8%" background="images/part_139_327/dboxrightroller.gif" height="60">&nbsp;</td>
					</tr>
				<tr>
					<td rowspan="2" align="left" valign="top"><img border="0" src="images/part_139_327/dboxlefbottomcorner.gif" width="53" height="12"></td>
					<td width="8%" rowspan="2" align="left" valign="top"><img border="0" src="images/part_139_327/dboxrightbottomcorner.gif" width="10" height="12"></td>
					</tr>
				<tr>
					<td width="44%" colspan="2" align="left" valign="bottom" background="images/part_139_327/dboxbottomroller.gif"><img border="0" src="images/part_139_327/dboxbottom.gif" width="59" height="6"></td>
					</tr>
				</table>
			</div>
							
							
		<div style="position:absolute; z-index:<?=$tmpzindex;?>; left:<?=$TempX;?>; top:<?=$TempY;?>; width:100; align="left" />
			<table border="0" cellpadding="0" cellspacing="0" borderCOLOR="#000000" width="100" id="AutoNumber1" />
  				<tr>
    					<td rowspan="2" width="31" height="31" align="left" valign="top" />
    						 <a href="" target="_new" />
							<img border="0" src="images/part_139_327/discrepancywork3.gif" width="31" height="31" border="0" alt="(<?=$objarray['Discrepancy_id'];?>)&nbsp;|&nbsp;<?=$objarray['Discrepancy_name'];?>" >
							</a>
						</td>
					</tr>
				</table>
			</div>
											<?
										}
										else {													// There is a number in the repair ID
											//echo $discrepancybouncedid;
											if ($discrepancybouncedid == "") {					// There is not a number in the bounceid, do display the repaired icon
													//echo "There is no value in the bouncedID variable";
													
													// Show Nothing
												}
												else {											// There is a number in the bounced field
																								// Now we need to compare the date and time of the each record and get the most recent event
													//echo $discrepancybounceddate.">".$discrepancyrepairdate;
													if ($discrepancybounceddate > $discrepancyrepairdate) {								//Bounce is more recent then repair regardless of time, so display bounce icon
														//	echo "Bounce Date is greater than Repair Date<br>";
															?>
	<div style="position:absolute; z-index:<?=$tmpzindex;?>; left:<?=$TempX-12;?>; top:<?=$TempY-10;?>; width:122; align="left" />							
			<table border="0" width="12%" cellspacing="0" cellpadding="0" id="table1" width="122">
				<tr>
					<td width="53"				align="right" 	valign="top" rowspan="4" 				background="images/part_139_327/dboxleftroller.gif"	><img border="0" 	src="images/part_139_327/dboxtarget.gif" width="53" 	height="58"></td>
					<td width="16" 	height="26"	align="left" 	valign="top"																	><img border="0" 	src="images/part_139_327/dboxid.gif" 	width="16" 	height="26"></td>
					<td width="83" 	height="26" align="left" 	valign="middle" bgcolor="#0000FF" style="border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom: 1px solid #000000">&nbsp;<font size="2" color="#FFFFFF"><?=$objarray['Discrepancy_id'];?></font></td>
					<td width="10" 	height="26" align="right" 	valign="top"																	><img border="0" 	src="images/part_139_327/dboxidright.gif" width="10" height="26"></td>
					</tr>
				<tr>
					<td width="83" 				align="left" 	valign="top" rowspan="4" colspan="2"											><img border="0" 	src="images/part_139_327/dboxidbottom.gif" width="83" height="3"><br>
						<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
							<tr>
								<td>
									<font size="1">Name:</font>
									</td>
								</tr>
							<tr>
								<td background="images/part_139_327/dboxbackground.gif">
									<font size="2"><b><?=$objarray['Discrepancy_name'];?></b></font>
									</td>
								</tr>
							<tr>
								<td>
									<font size="1">Description:</font>
									</td>
								</tr>
							<tr>
								<td background="images/part_139_327/dboxbackground.gif">
									<font size="3"><b><?=$objarray['discrepancy_remarks'];?></b></font>
									</td>
								</tr>
							<tr>
								<td>
									<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
										<tr>
											<form style="margin-bottom:0;" action="part139327_sub_d_b_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$discrepancybouncedid;?>">
												<input type="submit" value="B" name="b1" class="formsubmit" alt="Discrepancy is Bounced" onMouseover="ddrivetip('Discrepancy is Bounced')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											<form style="margin-bottom:0;" action="part139327_sub_d_workorder.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$objarray['Discrepancy_id'];?>">
												<input type="submit" value="W.O." name="b1" class="formsubmit" alt="Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew" onMouseover="ddrivetip('Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											</tr>
										</table>
									</td>
								</tr>
							</table>							
					<td width="8%" align="left" valign="top" background="images/part_139_327/dboxrightroller.gif" height="72"><img border="0" src="images/part_139_327/dboxrighttopcorner.gif" width="10" height="8"></td>
					</tr>
				<tr>
					<td width="8%" background="images/part_139_327/dboxrightroller.gif" height="19">&nbsp;</td>
					</tr>
				<tr>
					<td width="8%" background="images/part_139_327/dboxrightroller.gif" height="60">&nbsp;</td>
					</tr>
				<tr>
					<td rowspan="2" align="left" valign="top"><img border="0" src="images/part_139_327/dboxlefbottomcorner.gif" width="53" height="12"></td>
					<td width="8%" rowspan="2" align="left" valign="top"><img border="0" src="images/part_139_327/dboxrightbottomcorner.gif" width="10" height="12"></td>
					</tr>
				<tr>
					<td width="44%" colspan="2" align="left" valign="bottom" background="images/part_139_327/dboxbottomroller.gif"><img border="0" src="images/part_139_327/dboxbottom.gif" width="59" height="6"></td>
					</tr>
				</table>
			</div>
							
							
		<div style="position:absolute; z-index:<?=$tmpzindex;?>; left:<?=$TempX;?>; top:<?=$TempY;?>; width:100; align="left" />
			<table border="0" cellpadding="0" cellspacing="0" borderCOLOR="#000000" width="100" id="AutoNumber1" />
  				<tr>
    					<td rowspan="2" width="31" height="31" align="left" valign="top" />
    						 <a href="" target="_new" />
							<img border="0" src="images/part_139_327/discrepancywork3.gif" width="31" height="31" border="0" alt="(<?=$objarray['Discrepancy_id'];?>)&nbsp;|&nbsp;<?=$objarray['Discrepancy_name'];?>" >
							</a>
						</td>
					</tr>
				</table>
			</div>
															<?
														}
														else {									// Bounce date is not greater then repaire date
															if ($discrepancybounceddate == $discrepancyrepairdate) {						// Is the bounce date the same as the repair date?
																	//echo "bounce date is equal to repair date<br>";			// next we need to see if bounce is more recent timewise then the repair time
																	//echo $discrepancybouncedtime." vs ".$discrepancyrepairtime."<br>";
																	if ($discrepancybouncedtime > $discrepancyrepairtime) {					// is the bounce time more recent then the repair time
																			//echo "Bounce time greater than repair time";			// if so, display bounce icon
																			?>
	<div style="position:absolute; z-index:<?=$tmpzindex;?>; left:<?=$TempX-12;?>; top:<?=$TempY-10;?>; width:122; align="left" />							
			<table border="0" width="12%" cellspacing="0" cellpadding="0" id="table1" width="122">
				<tr>
					<td width="53"				align="right" 	valign="top" rowspan="4" 				background="images/part_139_327/dboxleftroller.gif"	><img border="0" 	src="images/part_139_327/dboxtarget.gif" width="53" 	height="58"></td>
					<td width="16" 	height="26"	align="left" 	valign="top"																	><img border="0" 	src="images/part_139_327/dboxid.gif" 	width="16" 	height="26"></td>
					<td width="83" 	height="26" align="left" 	valign="middle" bgcolor="#0000FF" style="border-left-width: 1px; border-right-width: 1px; border-top: 1px solid #000000; border-bottom: 1px solid #000000">&nbsp;<font size="2" color="#FFFFFF"><?=$objarray['Discrepancy_id'];?></font></td>
					<td width="10" 	height="26" align="right" 	valign="top"																	><img border="0" 	src="images/part_139_327/dboxidright.gif" width="10" height="26"></td>
					</tr>
				<tr>
					<td width="83" 				align="left" 	valign="top" rowspan="4" colspan="2"											><img border="0" 	src="images/part_139_327/dboxidbottom.gif" width="83" height="3"><br>
						<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
							<tr>
								<td>
									<font size="1">Name:</font>
									</td>
								</tr>
							<tr>
								<td background="images/part_139_327/dboxbackground.gif">
									<font size="2"><b><?=$objarray['Discrepancy_name'];?></b></font>
									</td>
								</tr>
							<tr>
								<td>
									<font size="1">Description:</font>
									</td>
								</tr>
							<tr>
								<td background="images/part_139_327/dboxbackground.gif">
									<font size="3"><b><?=$objarray['discrepancy_remarks'];?></b></font>
									</td>
								</tr>
							<tr>
								<td>
									<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
										<tr>
											<form style="margin-bottom:0;" action="part139327_sub_d_b_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$discrepancybouncedid;?>">
												<input type="submit" value="B" name="b1" class="formsubmit" alt="Discrepancy is Bounced" onMouseover="ddrivetip('Discrepancy is Bounced')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											<form style="margin-bottom:0;" action="part139327_sub_d_workorder.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$objarray['Discrepancy_id'];?>">
												<input type="submit" value="W.O." name="b1" class="formsubmit" alt="Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew" onMouseover="ddrivetip('Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											</tr>
										</table>
									</td>
								</tr>
							</table>							
					<td width="8%" align="left" valign="top" background="images/part_139_327/dboxrightroller.gif" height="72"><img border="0" src="images/part_139_327/dboxrighttopcorner.gif" width="10" height="8"></td>
					</tr>
				<tr>
					<td width="8%" background="images/part_139_327/dboxrightroller.gif" height="19">&nbsp;</td>
					</tr>
				<tr>
					<td width="8%" background="images/part_139_327/dboxrightroller.gif" height="60">&nbsp;</td>
					</tr>
				<tr>
					<td rowspan="2" align="left" valign="top"><img border="0" src="images/part_139_327/dboxlefbottomcorner.gif" width="53" height="12"></td>
					<td width="8%" rowspan="2" align="left" valign="top"><img border="0" src="images/part_139_327/dboxrightbottomcorner.gif" width="10" height="12"></td>
					</tr>
				<tr>
					<td width="44%" colspan="2" align="left" valign="bottom" background="images/part_139_327/dboxbottomroller.gif"><img border="0" src="images/part_139_327/dboxbottom.gif" width="59" height="6"></td>
					</tr>
				</table>
			</div>
							
							
		<div style="position:absolute; z-index:<?=$tmpzindex;?>; left:<?=$TempX;?>; top:<?=$TempY;?>; width:100; align="left" />
			<table border="0" cellpadding="0" cellspacing="0" borderCOLOR="#000000" width="100" id="AutoNumber1" />
  				<tr>
    					<td rowspan="2" width="31" height="31" align="left" valign="top" />
    						 <a href="" target="_new" />
							<img border="0" src="images/part_139_327/discrepancywork3.gif" width="31" height="31" border="0" alt="(<?=$objarray['Discrepancy_id'];?>)&nbsp;|&nbsp;<?=$objarray['Discrepancy_name'];?>" >
							</a>
						</td>
					</tr>
				</table>
			</div>
																			<?
																		}
																		else {					// Boune time is not greater then the repair time
																			if ($discrepancybouncedtime == $discrepancyrepairtime) {		// are they equal times?
																					//echo "How the heck did that happen";
																				}
																				else {			// repair time is more recent then the bounce time
																					//echo "Repair Icon";
																					
																					// Show Nothing
																				}
																		}
																}
														}
												}
										}
										?>
											<?
		$discrepancybouncedid 	= "";
		$discrepancybounceddate = "";
		$discrepancybouncedtime = "";
		$discrepancyrepairid 	= "";
		$discrepancyrepairdate 	= "";
		$discrepancyrepairtime 	= "";
		$isduplicate			= "";
		$isarchived				= "";
												}	// end of displaydatarow test
		$isduplicate			= "";
		$isarchived				= "";
		$discrepancybouncedid 	= "";
		$discrepancybounceddate = "";
		$discrepancybouncedtime = "";
		$discrepancyrepairid 	= "";
		$discrepancyrepairdate 	= "";
		$discrepancyrepairtime 	= "";
											}	// end of looped data
									?>
									<?
		$isduplicate			= "";
		$isarchived				= "";
		$discrepancybouncedid 	= "";
		$discrepancybounceddate = "";
		$discrepancybouncedtime = "";
		$discrepancyrepairid 	= "";
		$discrepancyrepairdate 	= "";
		$discrepancyrepairtime 	= "";
									}	// end of records found statement
		$isduplicate			= "";
		$isarchived				= "";
		$discrepancybouncedid 	= "";
		$discrepancybounceddate = "";
		$discrepancybouncedtime = "";
		$discrepancyrepairid 	= "";
		$discrepancyrepairdate 	= "";
		$discrepancyrepairtime 	= "";
								}	// end of sucessfull conection and execution of sql statement
	}
