<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	Part 139.327 Main Entry.php			The purpose of this page is to enter new Part 139.327 Airport Safety Self Inspections
	
								Usage:
								This is a complete custom form for the purposes of entering Part 139.327 inspections and should not be used as a template for another form
								unless that other form functions just like this one.
								
								
								
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/	
	// Load Required Include Files
	
		Session_Start();
		Session_Register("user_id");
		
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
<?
		$discrepancybouncedid 	= "";
		$discrepancybounceddate 	= "";
		$discrepancybouncedtime 	= "";
		$discrepancyrepairid 		= "";
		$discrepancyrepairdate 	= "";
		$discrepancyrepairtime 	= "";
		$isduplicate			= "";
		$isarchived			= "";
		$displaydatarow			= "";
		$displaydiscrepancy 		= "";
		
		$tmpid = $_POST['recordid'];
		
		//$_POST['reco//rdid'];
		
	$sql = "SELECT * FROM tbl_139_327_main 
	INNER JOIN tbl_139_327_sub_t ON inspection_type_id = type_of_inspection_cb_int
	INNER JOIN tbl_139_327_sub_t_i ON 139327_sub_t_id_int = inspection_type_id	
	ORDER BY 139327_date DESC, 139327_time DESC LIMIT 1";

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
					$number_of_rows = mysqli_num_rows($objrs);
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {	

							$name_of_image_background = $objarray['139327_sub_t_image'];
							//echo "image name".$name_of_image_background;
							?>
	<div style="position:absolute; z-index:1; left:3; top:74; width:711; align="left" />
		<img src="images/part_139_327/<?=($name_of_image_background);?>" width="711" height="849" />
		</div>
	<div style="position:absolute; z-index:2; left:0; top:30; width:717; align="left" />
		<img src="images/part_139_327/139_327_overlaygrid.gif" width="718" height="962" />
		</div>
	<div style="position:absolute; z-index:3; left:690; top:0; width:30; align="center" />
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width"30" id="AutoNumber1" />
			<tr align="center" />
				<td align="right" />
					<font size="1" /><?=$objarray['inspection_system_id'];?></font>
					<?
					$tmpid = $objarray['inspection_system_id'];
					?>
					</td>
				</tr>
			</table>
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
		<div style="position:absolute; z-index:4; left:0; top:0; width:713; align="center" />
			<center>
				<font size="5">
					<?
					part139327typescombobox($objarray['type_of_inspection_cb_int'], "all", "hide", "hide", "");
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
						<?
						$tmpsqldate = $objarray['139327_date'];
						$tmpsqltime = $objarray['139327_time'];
						$tmpdate 	= sqldate2amerdate($objarray['139327_date']);
						?>
						<b><?=$tmpdate;?></b>	
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
						<?
						$tmpstartdate 	= strtotime($tmpdate);
						$astartdate 	= getdate($tmpstartdate);
						$intstartday	= $astartdate ["weekday"];
						?>
						<B><?=$intstartday;?></B>
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
						<b>
							<?=$objarray['139327_time'];?>
							<?
							$tmptime = $objarray['139327_time'];
							?>
							</b>
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
			<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="185" id="AutoNumber1" height="13" />
				<tr align="center" />
					<td align="center" />
						<B>
						<?
						systemusercombobox($objarray['inspection_completed_by_cb_int'], "all", "all", "hide", "all")
						?>
							</B>
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
	$sql = "SELECT * FROM tbl_139_327_sub_c_c WHERE conditions_checklists_inspection_cb_int = '".$tmpid."' ";

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
							$tmpconditionid = $objarray2['conditions_checklists_condition_cb_int'];
							$tmpdiscrepancy = $objarray2['conditions_checklist_discrepancy_yn'];
							
							$sql = "SELECT * FROM tbl_139_327_sub_c WHERE conditions_id = '".$tmpconditionid."' ";
							
							//make connection to database
							$objconn3 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
							if (mysqli_connect_errno()) {
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else {
									$objrs3 = mysqli_query($objconn3, $sql);
									if ($objrs3) {
											$number_of_rows = mysqli_num_rows($objrs);
											while ($objarray3 = mysqli_fetch_array($objrs3, MYSQLI_ASSOC)) {							
												?>
					<tr>
      					<td width="*" align="center" bgCOLOR="#FFFFFF" height="15" />
      						<font size="1" COLOR="#000000" />
							<?
								part139327facilitycombobox($objarray3['condition_facility_cb_int'], "all", "all", "hide", "all")
								?>								
							</font>
						</td>
      					<td width="*" align="center" bgCOLOR="#FFFFFF" height="15" />
      						<font size="1" COLOR="#000000" />
							<?=$objarray3['condition_name'];?>
							</font>
						</td>
					<td align="center" bgCOLOR="#FFFFFF" height="15" />
      					<font size="1" COLOR="#000000" />
							<?
								if($tmpdiscrepancy==0) {
										?>
								<img src="images/part_139_327/greenx.gif">
										<?
									}
								?>
							</font>
						</td>
      					<td align="center" bgCOLOR="#FFFFFF" height="15" />
      						<font size="1" COLOR="#000000" />
							<?
								if($tmpdiscrepancy!=0) {
										?>
								<img src="images/part_139_327/redx.gif">
										<?
									}
								?>
							</font>
						</td>
    				</tr>
						<?
												}	// End of Conditions While Loop
										}
									}	// End of Condiitons Object Loop
							}	// End of Checklist item while loop
						}
					}	// End of Checklist object loop
					?>					
				</table>
			</div>
			<?
			}
			}
			}
			?>
<?
// GET INFORMATION FROM THE DISCREPANCY DATABASE ////

	$sql = "SELECT * FROM tbl_139_327_sub_d WHERE discrepancy_inspection_id = '".$tmpid."' ";

	$OffSetX 	= -4;
	$OffSetY 	= 66;
	$tmpzindex 	= 14;

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
					$number_of_rows = mysqli_num_rows($objrs);
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {	
							$discrepancybouncedid 	= "";
							$discrepancybounceddate = "";
							$discrepancybouncedtime = "";
							$discrepancyrepairid 	= "";
							$discrepancyrepairdate 	= "";
							$discrepancyrepairtime 	= "";
							$isduplicate			= "";
							$isarchived				= "";
							$display				= 1;
							
							// Before we display anything let us run a test on this discrepancy and see if we need to display it			
							
							//echo "Checking Discrepancy Archvied Status <br>";							
							
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = '".$objarray['Discrepancy_id']."' ";
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
														$tmpid = $objarray2['discrepancy_archeived_id'];
															}
													}
											}
										
									if ($number_of_rows==0) {
											//echo "There is no archived history for this discrepancy <br>";
											$isarchived	= 0;
											}
										else {
											//echo "This discrepancy has been archived, DO NOT DISPLAY <br>";
											$isarchived	= 1;
										}

							//echo "Checking Discrepancy Duplication Status <br>";	

									$sql2 = "SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = '".$objarray['Discrepancy_id']."' ";
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
															}
													}
											}

									if ($number_of_rows==0) {
										//echo "There is no duplication history for this discrepancy <br>";
										$isduplicate = 0;
										}
									else {
										//echo "This discrepancy has been marked a duplicate, DO NOT DISPLAY <br>";
										$isduplicate = 1;
									}						
					
							//echo "doing test to see if discrepancy should be displayed <br>";
							
									if ($isarchived==1) {
											// Is archived
											$display = 0;
										}
									if ($isduplicate==1) {
											// is duplicate
											$display = 0;
										}
					
							//echo "Start to display Discrepancy Information window <br>";
							
									if ($display==1) {
											// Load initial Information
											$TempX = ($objarray['Discrepancy_location_x'] + $OffSetX );
											$TempY = ($objarray['Discrepancy_location_y'] + $OffSetY );
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
								<?
							
									//test 3). Determine if the Discrepancy is currently outstanding or has been fixed. This involves checking both the repaired and bounced tables for information about the
									//current discrepancy ID. This will be done in three phases. 
									//Phase 1 will be to check the bounced table to see if there is any records about this discrepancy ID there. if so get the date of the latest record and put the ID of the record in a variable
									//phase two will be to check the repaired table and see if there is any information about this discrepancy there. if so get the date of the latest record and put the ID of the record in a variable
									//phase three will be to compare the two dates provided and see which event is most recent.
								
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = '".$objarray['Discrepancy_id']."' ORDER BY discrepancy_bounced_date, discrepancy_bounced_time";
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
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = '".$objarray['Discrepancy_id']."' ORDER BY discrepancy_repaired_date, discrepancy_repaired_time";
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
									
									if ($discrepancyrepairid == "") {							// There is no repair history. Without being repaired you by definition cant bounce so we give the user the workorder button
											//echo "WorkOrder";
											?>
											<form style="margin-bottom:0;" action="part139327_sub_d_workorder.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$objarray['Discrepancy_id'];?>">
												<input type="submit" value="W.O." name="b1" class="formsubmit" onMouseover="ddrivetip('Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											<?
										}
										else {													// There is a number in the repair ID
											if ($discrepancybouncedid == "") {					// There is not a number in the bounceid, do display the repaired icon
													//echo "There is no value in the bouncedID variable";
													?>
											<form style="margin-bottom:0;" action="part139327_sub_d_r_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$discrepancyrepairid;?>">
												<input type="submit" value="R" name="b1" class="formsubmit" alt="Discrepancy is Repaired" onMouseover="ddrivetip('Discrepancy is Repaired')"; onMouseout="hideddrivetip()">
												</td>
											</form>
													<?
												}
												else {											// There is a number in the bounced field
																								// Now we need to compare the date and time of the each record and get the most recent event
													if ($discrepancybounceddate > $discrepancyrepairdate) {								//Bounce is more recent then repair regardless of time, so display bounce icon
															//echo "Bounce Date is greater than Repair Date<br>";
															?>
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
															<?
														}
														else {									// Bounce date is not greater then repaire date
															if ($discrepancybounceddate == $discrepancyrepairdate) {						// Is the bounce date the same as the repair date?
																	//echo "bounce date is equal to repair date<br>";			// next we need to see if bounce is more recent timewise then the repair time
																	//echo $discrepancybouncedtime." vs ".$discrepancyrepairtime."<br>";
																	if ($discrepancybouncedtime > $discrepancyrepairtime) {					// is the bounce time more recent then the repair time
																			//echo "Bounce time greater than repair time";			// if so, display bounce icon
																			?>
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
																			<?
																		}
																		else {					// Boune time is not greater then the repair time
																			if ($discrepancybouncedtime == $discrepancyrepairtime) {		// are they equal times?
																					//echo "How the heck did that happen";
																				}
																				else {			// repair time is more recent then the bounce time
																					//echo "Repair Icon";
																					?>
											<form style="margin-bottom:0;" action="part139327_sub_d_r_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$discrepancyrepairid;?>">
												<input type="submit" value="R" name="b1" class="formsubmit" alt="Discrepancy is Repaired" onMouseover="ddrivetip('Discrepancy is Repaired')"; onMouseout="hideddrivetip()">
												</td>
											</form>
																					<?
																				}
																		}
																}
														}
												}
										}
								?>	
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
		$tmpzindex = $tmpzindex + 1;
								}
						}
				}
		}
// Make sql Statement   Discrepancy_time
	$sql = "SELECT * FROM tbl_139_327_sub_d WHERE Discrepancy_date <='".$tmpsqldate."' AND Discrepancy_time <= '".$tmpsqldate."'";
	$OffSetX 	= -4;
	$OffSetY 	= 66;
	$tmpzindex 	= 14;

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
					$number_of_rows = mysqli_num_rows($objrs);
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {	
							$discrepancybouncedid 	= "";
							$discrepancybounceddate = "";
							$discrepancybouncedtime = "";
							$discrepancyrepairid 	= "";
							$discrepancyrepairdate 	= "";
							$discrepancyrepairtime 	= "";
							$isrepaired				= "";
							$isduplicate			= "";
							$isarchived				= "";
							$display				= 1;
							
							// Before we display anything let us run a test on this discrepancy and see if we need to display it			
							
							//echo "Checking Discrepancy Archvied Status <br>";							
							
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = '".$objarray['Discrepancy_id']."' ";
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
														$tmpid = $objarray2['discrepancy_archeived_id'];
															}
													}
											}
										
									if ($number_of_rows==0) {
											//echo "There is no archived history for this discrepancy <br>";
											$isarchived	= 0;
											}
										else {
											//echo "This discrepancy has been archived, DO NOT DISPLAY <br>";
											$isarchived	= 1;
										}

							//echo "Checking Discrepancy Duplication Status <br>";	

									$sql2 = "SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = '".$objarray['Discrepancy_id']."' ";
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
															}
													}
											}

									if ($number_of_rows==0) {
										//echo "There is no duplication history for this discrepancy <br>";
										$isduplicate = 0;
										}
									else {
										//echo "This discrepancy has been marked a duplicate, DO NOT DISPLAY <br>";
										$isduplicate = 1;
									}						
					
					
							//echo "Checking to see if this disrepancy has already been fixed and does not need to be displayed <br>";
					
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = '".$objarray['Discrepancy_id']."' ORDER BY discrepancy_bounced_date, discrepancy_bounced_time";
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
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = '".$objarray['Discrepancy_id']."' ORDER BY discrepancy_repaired_date, discrepancy_repaired_time";
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
									
																				
										
									
									if ($discrepancyrepairid == "") {							// There is no repair history. Without being repaired you by definition cant bounce so we give the user the workorder button
											//echo "WorkOrder";
											$isrepaired = 0;
											}
										else {													// There is a number in the repair ID
											if ($discrepancybouncedid == "") {					// There is not a number in the bounceid, do display the repaired icon
													//echo "There is no value in the bouncedID variable";
													$isrepaired = 1;
													}
												else {											// There is a number in the bounced field
																								// Now we need to compare the date and time of the each record and get the most recent event
													if ($discrepancybounceddate > $discrepancyrepairdate) {								//Bounce is more recent then repair regardless of time, so display bounce icon
															//echo "Bounce Date is greater than Repair Date<br>";
															$isrepaired = 0;
															}
														else {									// Bounce date is not greater then repaire date
															if ($discrepancybounceddate == $discrepancyrepairdate) {						// Is the bounce date the same as the repair date?
																	//echo "bounce date is equal to repair date<br>";			// next we need to see if bounce is more recent timewise then the repair time
																	//echo $discrepancybouncedtime." vs ".$discrepancyrepairtime."<br>";
																	if ($discrepancybouncedtime > $discrepancyrepairtime) {					// is the bounce time more recent then the repair time
																			//echo "Bounce time greater than repair time";			// if so, display bounce icon
																			$isrepaired = 0;													
																			}
																		else {					// Boune time is not greater then the repair time
																			if ($discrepancybouncedtime == $discrepancyrepairtime) {		// are they equal times?
																					//echo "How the heck did that happen";
																				}
																				else {			// repair time is more recent then the bounce time
																					//echo "Repair Icon";
																					$isrepaired = 1;
																				}
																		}
																}
														}
												}
										}						
					
						//	echo "doing test to see if discrepancy should be displayed <br>";
							
								
									if ($isrepaired==1) {
											// Discrepancy is repaired do not display discrepancy
											$display = 0;
											
										}
									if ($isarchived==1) {
											// Is archived
											$display = 0;
										
										}
									if ($isduplicate==1) {
											// is duplicate
											$display = 0;
										}
					
							//echo "Start to display Discrepancy Information window <br>";
							
									if ($display==1) {
											// Load initial Information
											$TempX = ($objarray['Discrepancy_location_x'] + $OffSetX );
											$TempY = ($objarray['Discrepancy_location_y'] + $OffSetY );
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
								<?
							
									//test 3). Determine if the Discrepancy is currently outstanding or has been fixed. This involves checking both the repaired and bounced tables for information about the
									//current discrepancy ID. This will be done in three phases. 
									//Phase 1 will be to check the bounced table to see if there is any records about this discrepancy ID there. if so get the date of the latest record and put the ID of the record in a variable
									//phase two will be to check the repaired table and see if there is any information about this discrepancy there. if so get the date of the latest record and put the ID of the record in a variable
									//phase three will be to compare the two dates provided and see which event is most recent.
								
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = '".$objarray['Discrepancy_id']."' ORDER BY discrepancy_bounced_date, discrepancy_bounced_time";
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
									$sql2 = "SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = '".$objarray['Discrepancy_id']."' ORDER BY discrepancy_repaired_date, discrepancy_repaired_time";
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
									
									if ($discrepancyrepairid == "") {							// There is no repair history. Without being repaired you by definition cant bounce so we give the user the workorder button
											//echo "WorkOrder";
											?>
											<form style="margin-bottom:0;" action="part139327_sub_d_workorder.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$objarray['Discrepancy_id'];?>">
												<input type="submit" value="W.O." name="b1" class="formsubmit" onMouseover="ddrivetip('Discrepancy needs to be repaired click this button to generate a printer friendly workorder for distribution to maintenance crew')"; onMouseout="hideddrivetip()">
												</td>
											</form>
											<?
										}
										else {													// There is a number in the repair ID
											if ($discrepancybouncedid == "") {					// There is not a number in the bounceid, do display the repaired icon
													//echo "There is no value in the bouncedID variable";
													?>
											<form style="margin-bottom:0;" action="part139327_sub_d_r_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$discrepancyrepairid;?>">
												<input type="submit" value="R" name="b1" class="formsubmit" alt="Discrepancy is Repaired" onMouseover="ddrivetip('Discrepancy is Repaired')"; onMouseout="hideddrivetip()">
												</td>
											</form>
													<?
												}
												else {											// There is a number in the bounced field
																								// Now we need to compare the date and time of the each record and get the most recent event
													if ($discrepancybounceddate > $discrepancyrepairdate) {								//Bounce is more recent then repair regardless of time, so display bounce icon
															//echo "Bounce Date is greater than Repair Date<br>";
															?>
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
															<?
														}
														else {									// Bounce date is not greater then repaire date
															if ($discrepancybounceddate == $discrepancyrepairdate) {						// Is the bounce date the same as the repair date?
																	//echo "bounce date is equal to repair date<br>";			// next we need to see if bounce is more recent timewise then the repair time
																	//echo $discrepancybouncedtime." vs ".$discrepancyrepairtime."<br>";
																	if ($discrepancybouncedtime > $discrepancyrepairtime) {					// is the bounce time more recent then the repair time
																			//echo "Bounce time greater than repair time";			// if so, display bounce icon
																			?>
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
																			<?
																		}
																		else {					// Boune time is not greater then the repair time
																			if ($discrepancybouncedtime == $discrepancyrepairtime) {		// are they equal times?
																					//echo "How the heck did that happen";
																				}
																				else {			// repair time is more recent then the bounce time
																					//echo "Repair Icon";
																					?>
											<form style="margin-bottom:0;" action="part139327_sub_d_r_report.php" method="POST" name="reportform" id="reportform" target="PrinterFriendlyWindow" onsubmit="window.open('', 'PrinterFriendlyWindow', 'width=750,height=550,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsubmit">
												<input type="hidden" name="recordid" 			value="<?=$discrepancyrepairid;?>">
												<input type="submit" value="R" name="b1" class="formsubmit" alt="Discrepancy is Repaired" onMouseover="ddrivetip('Discrepancy is Repaired')"; onMouseout="hideddrivetip()">
												</td>
											</form>
																					<?
																				}
																		}
																}
														}
												}
										}
								?>	
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
		$tmpzindex = $tmpzindex + 1;
		}
								}
						}
						}
	
	
	
			
			$tmpsqldate			= AmerDate2SqlDateTime(date('m/d/Y'));
			$tmpsqltime			= date("H:i:s");
			$tmpsqlauthor		= 65;
			$dutylogevent		= "Printed Part 139 Self Inspection Report ID:".$tmpid.", dated ".$tmpdate." at ".$tmptime."";	
			
			autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
