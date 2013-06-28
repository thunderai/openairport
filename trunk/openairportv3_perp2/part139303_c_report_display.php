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
//	Name of Document		:	part139303_c_report_display.php
//
//	Purpose of Page			:	Display Part 139.303 (c) Personnel Report
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page

// Load Page Specific Includes

		include("includes/_modules/part139303/part139303.list.php");
		//include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Collect POST Information
		
if (!isset($_POST["recordid"])) {
		// No Record ID defined in POST, use GET record id
		$inspection_id			= $_GET['recordid'];
		$from_get				= 1;
	}
	else {
		$inspection_id			= $_POST['recordid'];
		$from_get				= 0;
	}		
		
		//$inspection_id			= $_POST['recordid'];
		$menuitemid 			= $_POST['menuitemid'];													
		$tblname				= $_POST['tblname'];													
		$tblsubname				= $_POST['tblsubname'];	

		
// Define Variables	
		
		$navigation_page 			= 36;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 3;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures
		
		$sql = "SELECT * FROM tbl_139_303_c_main 
				INNER JOIN tbl_systemusers		ON tbl_systemusers.emp_record_id			= tbl_139_303_c_main.139_303_by_cb_int 
				INNER JOIN tbl_139_303_c_sub_t	ON tbl_139_303_c_sub_t.inspection_type_id 	= tbl_139_303_c_main.139_303_type_cb_int 
				WHERE tbl_139_303_c_main.139_303_id = '".$inspection_id."' ";

	
		//echo "Connect to database usining this SQL statement ".$sql." <br>";				
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
						?>
				<table border="1" style="border-collapse:collapse;" width="750" bgcolor="#FFFFFF" align="left" valign="top">
						<?php
						while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
								
								$training_record_id = $objarray['139_303_id'];
								
								?>
					<tr>
						<td colspan="4" align="center" valign="middle" height="42" width="60%">
							<font size="4"><b>
								Part 139.303 (c) Training Record
								</font></b>
							</td>
						</tr>								
					<tr>
						<td align="left" valign="middle">
							&nbsp;&nbsp;<b>Date: </b>
							</td>
						<td align="left" valign="middle">
							<?php echo $objarray['139_303_date'];?>
							</td>
						<td align="left" valign="middle">
							Type
							</td>
						<td align="left" valign="middle">
							<?php echo $objarray['inspection_type'];?>
							</td>							
						</tr>
					<tr>
						<td align="left" valign="middle">
							Time:
							</td>
						<td align="left" valign="middle">
							<?php echo $objarray['139_303_time'];?>
							</td>
						<td align="left" valign="middle">
							Instructor:
							</td>
						<td align="left" valign="middle">
							<?php
							echo $addedby = systemusertextfield($objarray['139_303_by_cb_int'], "all", "any", "hide", $objarray['139_303_by_cb_int']);
							?>							
							</td>							
						</tr>						
					<tr>
						<td colspan="4" align="center" valign="middle" bgcolor="#000000">
							<font color="#FFFFFF">Documents</font>
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							&nbsp;&nbsp;Attendance Roster:
							</td>
						<td colspan="3" align="center" valign="middle">
							<?php echo $objarray['139_303_attendance'];?>
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							&nbsp;&nbsp;Sylabus:
							</td>
						<td colspan="3" align="center" valign="middle">
							<?php echo $objarray['139_303_sylabus'];?>
							</td>
						</tr>							
								<?php
							}	// End of While Loop	
					}
			}
			?>
			<tr>
				<td colspan="4" align="center" valign="middle" bgcolor="#000000">
					<font color="#FFFFFF">Students</font>
					</td>
				</tr>
			<tr>
			<?php
			$students_across 	= 4;
			$counter			= 0;
			
			$sql = "SELECT * FROM tbl_139_303_c_sub_sa 
					INNER JOIN tbl_systemusers		ON tbl_systemusers.emp_record_id			= tbl_139_303_c_sub_sa.discrepancy_student_cb_int 
					WHERE tbl_139_303_c_sub_sa.Discrepancy_inspection_id = '".$training_record_id."' AND tbl_139_303_c_sub_sa.discrepancy_hidden_yn = 0";
						
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
								
								if($counter == $students_across) {
										?>
				</tr>
			<tr>
										<?php
										$counter = 0;
									} else {
										$counter = $counter + 1;
									}
									?>
				<td align="left">
					<?php
					echo $addedby = systemusertextfield($objarray['discrepancy_student_cb_int'], "all", "any", "hide", $objarray['discrepancy_student_cb_int']);
					?>	
					</td>		
									<?php
								
								
								}
						}
				
				}
		?>
			<tr>
				<td colspan="4" align="center" valign="middle" bgcolor="#000000">
					<font color="#FFFFFF">Topics Covered</font>
					</td>
				</tr>
			<tr>
				<td align="left" valign="middle">
					&nbsp;&nbsp;<b>Facility </b>
					</td>
				<td colspan="2" align="left" valign="middle">
					&nbsp;&nbsp;<b>Condition </b>
					</td>
				<td align="left" valign="middle">
					&nbsp;&nbsp;<b>Time Taken </b>
					</td>							
				</tr>
		<?php

		$total_time_taken = 0;
		
		$sql = "SELECT * FROM tbl_139_303_c_sub_c_c 
				INNER JOIN tbl_139_303_c_sub_c		ON tbl_139_303_c_sub_c.conditions_id = tbl_139_303_c_sub_c_c.conditions_checklists_condition_cb_int 
				INNER JOIN tbl_139_303_c_sub_c_f	ON tbl_139_303_c_sub_c_f.facility_id = tbl_139_303_c_sub_c.condition_facility_cb_int 
				WHERE tbl_139_303_c_sub_c_c.conditions_checklists_inspection_cb_int	= '".$training_record_id."' AND conditions_checklist_archived_yn = 0
				ORDER BY tbl_139_303_c_sub_c_f.facility_name, tbl_139_303_c_sub_c.condition_type_order_int, tbl_139_303_c_sub_c.condition_name";
		
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
		
								$condition_c_id 	= $objarray['conditions_id'];
								//$condition_c_rid	= $objarray['Discrepancy_inspection_id'];
								
								?>
			<tr>
				<td align="left" valign="middle">
					<?php echo $objarray['facility_name'];?>
					</td>
				<td colspan="2" align="left" valign="middle">
					<?php echo $objarray['condition_name'];?>
					</td>
				<td align="left" valign="middle">
					<?php echo $objarray['conditions_checklist_hours'];?>
					<?php
					$total_time_taken = $total_time_taken + $objarray['conditions_checklist_hours'];
					?>
					</td>							
				</tr>
								<?php
								
								$sql2 = "SELECT * FROM tbl_139_303_c_sub_d  
											WHERE discrepancy_checklist_id = '".$condition_c_id."' AND Discrepancy_inspection_id = '".$training_record_id."' 
											ORDER BY Discrepancy_name";
											
								//echo $sql2;
								
								$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

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
				<td colspan="1" align="right" valign="middle">
					Conversations
					</td>
				<td colspan="1" align="left" valign="middle">
					<?php echo $objarray2['Discrepancy_name'];?>
					</td>
				<td colspan="2" align="left" valign="middle">
					<?php echo $objarray2['discrepancy_remarks'];?>
					</td>							
				</tr>									
														<?php
													}
											}
									}
									
									
							}
					}
			}
			?>
			<tr>
				<td colspan="3" align="left" valign="middle">
					Total Class Time
					</td>
				<td align="left" valign="middle">
					<?php 
					echo $total_time_taken."m / ";

					$time_taken_hours = round(($total_time_taken/60),2);
					echo $time_taken_hours."h";
					?>
					</td>							
				</tr>	
			<?php	
		
// Establish Page Variables

		if (!isset($inspection_id)) {
				// Not defined, set to zero
				$last_main_id = 0;
			} else {
				$last_main_id = $inspection_id;
			}		
		if (!isset($_POST["formsubmit"])) {
				// Not defined, set to zero
				$submit = 0;
			} else {
				$submit = $_POST["formsubmit"];
			}

		$auto_array		= array($navigation_page, $_SESSION["user_id"], $submit, $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 
		ae_completepackage($auto_array);		
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>