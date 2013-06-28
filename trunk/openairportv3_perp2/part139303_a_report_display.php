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
//	Name of Document		:	part139303_a_report_display.php
//
//	Purpose of Page			:	Display Part 139.303 (a) Personnel Report
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
		include("includes/_modules/part139301/part139301.list.php");
		include("includes/_modules/part139327/part139327.list.php");
		//include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Collect POST Information
		//$inspection_id			= $_POST['recordid'];
		//$menuitemid 				= $_POST['menuitemid'];													
		//$tblname					= $_POST['tblname'];													
		//$tblsubname				= $_POST['tblsubname'];	
		
		$totalrecords	= 0;
	
if (!isset($_POST["recordid"])) {
		// No Record ID defined in POST, use GET record id
		$inspection_id			= $_GET['recordid'];
		$from_get				= 1;
	}
	else {
		$inspection_id			= $_POST['recordid'];
		$from_get				= 0;
	}		
	
// Define Variables	
		
		$navigation_page 			= 36;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 3;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures
			
		$sql =" SELECT * FROM tbl_systemusers 
				INNER JOIN tbl_organization_main 	ON tbl_organization_main.Organizations_id = tbl_systemusers.emp_organiation_cb_int 
				WHERE emp_record_id = ".$inspection_id."";
	
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
								?>
					<tr>
						<td colspan="3" align="center" valign="middle" height="42" width="60%">
							<font size="4"><b>
								Part 139.303 (a) Personnel Record for 
								<?php echo $objarray['emp_firstname'];?>&nbsp;<?php echo $objarray['emp_lastname'];?>&nbsp;(<?php echo $objarray['emp_initials'];?>)
								</font></b>
							</td>
						</tr>								
					<tr>
						<td align="left" valign="middle">
							&nbsp;&nbsp;<b>First Name: </b>
							<?php echo $objarray['emp_firstname'];?>
							</td>
						<td align="left" valign="middle">
							&nbsp;&nbsp;<b>Last Name: </b>
							<?php echo $objarray['emp_lastname'];?>
							</td>
						<td align="left" valign="middle">
							&nbsp;&nbsp;<b>Initials: </b>
							<?php echo $objarray['emp_initials'];?>
							</td>
						</tr>
					<tr>
						<td align="left" valign="middle">
							&nbsp;&nbsp;<b>Added on (Date): </b>
							<?php 
							
							echo $objarray['emp_addedon_date'];
							
							$tmp_addedondate = $objarray['emp_addedon_date'];
							
							?>
							</td>
						<td align="left" valign="middle">
							&nbsp;&nbsp;<b>Added on (Time):  </b>
							<?php echo $objarray['emp_addon_time'];?>
							</td>
						<td align="left" valign="middle">
							&nbsp;&nbsp;<b>Added on (By): </b>
							<?php
							echo $addedby = systemusertextfield($objarray['emp_added_by_int'], "all", "any", "hide", $objarray['emp_added_by_int']);
							?>
							</td>
						</tr>						
					<tr>
						<td align="left" valign="middle">
							&nbsp;&nbsp;<b>User Name: </b>
							<?php echo $objarray['emp_username'];?>
							</td>
						<td align="left" valign="middle">
							&nbsp;&nbsp;<b>Password: </b>
							<?php echo $objarray['emp_password'];?>
							</td>
						<td colspan="2" align="left" valign="middle">
							&nbsp;&nbsp;<b>Access Level: </b>
							<?php echo _nav_getbysuid_navigationalgrouptext($inspection_id);?>
							</td>
						</tr>						
					<tr>
						<td colspan="3" align="center" valign="middle" bgcolor="#000000">
							<font color="#FFFFFF">Summary of Module Activity</font>
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle">
							&nbsp;&nbsp;Module Name
							</td>
						<td align="center" valign="middle">
							&nbsp;&nbsp;# of Records
							</td>
						<td align="center" valign="middle">
							&nbsp;&nbsp;Date of Recent Entry
							</td>
						</tr>							
								<?php
							}	// End of While Loop	
					}
			}
			
		// The Goal now is to loop through all of the defined modules and display information according to the summary function...
		// The summary function should return two pices of information: 1). The total number of reports issued, and; 2). the date of the latest one
			
		$sql = "SELECT * FROM tbl_139_301_main WHERE 139301_active_yn = 1 AND 139301_hidden_yn = 0 
		ORDER BY 139301_name";
	
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
						while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {	
								
								$modulename 		= $objarray['139301_name'];
								$modulefunction 	= $objarray['139301_summaryfunction'];
								
								$resultarray		= $modulefunction($inspection_id);
								?>
					<tr>
						<td align="left" valign="middle">
							&nbsp;&nbsp;<?php echo $modulename;?>
							</td>
						<td align="left" valign="middle">
							&nbsp;&nbsp;<?php echo $resultarray[0];?>
							</td>
						<td colspan="2" align="left" valign="middle">
							&nbsp;&nbsp;<?php echo $resultarray[1];?> / <?php echo $resultarray[2];?>
							</td>
						</tr>
								<?php
								$totalrecords = $totalrecords + $resultarray[0];
							}
					}
			}
			?>
					<tr>
						<td align="left" valign="middle" bgcolor="#COCOCO">
							Total Records Added
							</td>
						<td align="left" valign="middle" bgcolor="#COCOCO">
							&nbsp;&nbsp;<?php echo $totalrecords;?>
							</td>
						<td align="left" valign="middle" bgcolor="#COCOCO">
							&nbsp;&nbsp;
							<?php
							// System user was 'born' on $tmp_addedondate
							// Today's date is:
							$tmp_todaysdate = date('Y-m-d');
							
							//echo $tmp_todaysdate;
							
							$totaldaysalive = datediff($tmp_addedondate,$tmp_todaysdate,"D");
							
							$averageperday	= round(($totalrecords/$totaldaysalive),2);
							?>
							(<?php echo $averageperday;?> records per day)
							</td>
						</tr>
					</table>
					
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