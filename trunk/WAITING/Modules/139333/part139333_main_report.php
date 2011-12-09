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
	<BODY>
<?
	// GET Record ID and get data
	

		$sql = "SELECT * FROM tbl_139_303_main 
				INNER JOIN tbl_139_303_sub_t ON tbl_139_303_sub_t.inspection_type_id = tbl_139_303_main.139_303_type_cb_int 
				INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_303_main.139_303_by_cb_int 
				WHERE 139_303_id = '".$_POST['recordid']."' ";
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
									?>
		<div style="position:absolute; z-index:3; left:0; top:0; width:710; align="center" />
					<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" />
						<tr align="center" />
							<td align="CENTER" />
								<font size="5" /><?=$objarray['inspection_type'];?></font>
								</td>
							</tr>
						</table>
					</div>									
		<div style="position:absolute; z-index:3; left:0; top:40; width:710; align="center" />
					<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" />
						<tr align="center" />
							<td align="right" />
								<font size="1" />Teacher</font>
							<td align="right" />
								<font size="1" /><?=$objarray['emp_firstname'];?>&nbsp;<?=$objarray['emp_lastname'];?>&nbsp;(<?=$objarray['emp_initials'];?>)</font>
								</td>
							</tr>
						<tr align="center" />
							<td align="right" />
								<font size="1" />Date</font>
							<td align="right" />
								<font size="1" /><?=$objarray['139_303_date'];?></font>
								</td>
							</tr>
						<tr align="center" />
							<td align="right" />
								<font size="1" />Time</font>
							<td align="right" />
								<font size="1" /><?=$objarray['139_303_time'];?></font>
								</td>
							</tr>
						<tr align="center" />
							<td align="right" />
								<font size="1" />Sylabus</font>
							<td align="right" />
								<font size="1" /><?=$objarray['139_303_sylabus'];?></font>
								</td>
							</tr>
						<tr align="center" />
							<td align="right" />
								<font size="1" />Attendance</font>
							<td align="right" />
								<font size="1" /><?=$objarray['139_303_attendance'];?></font>
								</td>
							</tr>							
						</table>
					</div>			
		<div style="position:absolute; z-index:3; left:10; top:160; width:350; align="center" />
					<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" />
						<tr>
							<td>
								TOPICS
								</td>
							</tr>
							
						<?
						// GET Items Taught for this training Session
						$sql2 = "SELECT * FROM tbl_139_303_sub_c_c 
								INNER JOIN tbl_139_303_sub_c ON tbl_139_303_sub_c.conditions_id = tbl_139_303_sub_c_c.conditions_checklists_condition_cb_int 
								INNER JOIN tbl_139_303_sub_c_f ON tbl_139_303_sub_c_f.facility_id = tbl_139_303_sub_c.condition_facility_cb_int 
								WHERE conditions_checklists_inspection_cb_int = '".$objarray['139_303_id']."' ";
								$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
												
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}
										else {
											$objrs2 = mysqli_query($objconn2, $sql2);
														
											if ($objrs2) {
													$number_of_rows2 = mysqli_num_rows($objrs2);
													while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {				
															?>
						<tr>
							<td>
								&nbsp;&nbsp;- <?=$objarray2['condition_name'];?>
								</td>
							</tr>
															<?
													
														}
												}
										}
															?>
						</table>
					</div>			
			<div style="position:absolute; z-index:3; left:360; top:160; width:350; align="center" />
					<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" />
						<tr>
							<td>
								STUDENTS
								</td>
							</tr>
						<?
						// GET Items Taught for this training Session
						$sql2 = "SELECT * FROM tbl_139_303_sub_sa 
								INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_303_sub_sa.discrepancy_student_cb_int
								INNER JOIN tbl_139_303_main ON tbl_139_303_main.139_303_id = tbl_139_303_sub_sa.Discrepancy_inspection_id 
								WHERE Discrepancy_inspection_id = '".$objarray['139_303_id']."' ";
								$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
												
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}
										else {
											$objrs2 = mysqli_query($objconn2, $sql2);
														
											if ($objrs2) {
													$number_of_rows2 = mysqli_num_rows($objrs2);
													while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {				
															?>
						<tr>
							<td>
								<?=$objarray2['emp_firstname'];?>&nbsp;<?=$objarray2['emp_lastname'];?>&nbsp;(<?=$objarray2['emp_initials'];?>)
								</td>
							</tr>
															<?
													
														}
												}
										}
															?>
						</table>
					</div>
															<?
								}
						}
				}
		?>
