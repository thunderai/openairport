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
//	Name of Document		:	part139303_c_save_new_report.php
//
//	Purpose of Page			:	Save New Part139.303 (c) Training Record
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

// Define Variables	
		
		$navigation_page 			= 37;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 16;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures	
		
// Start Procedures
	//	This will be a multi step process.
	//	1). * DONE * Main Training Record was stored in the real tables, Don't Need to Find or change
	//	2).	* DONE * Checklist items was stored in the real tables, Don't need to find or change
	//	3). * DONE * Find all temporary discrepancies that were selected to be linked
	//		a). Find Discrepancies
	//		b). Copy them to the real table
	//	4). * DONE * Delete temporary records
	//		a). Delete temporary discrepancies
	
	
		
// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);

		
// Start Procedures

	//	1). Nothing to Do
	//	2). Nothing to Do
	//	3). Per Procedures...
	
	
	//	List ALL discrepancies by THIS author in the temporary discrepancy folder for possible linking
	//	Mark all temporary discrepancies as linked by default
			
			$sql = "SELECT * FROM tbl_139_303_c_sub_d_tmp WHERE Discrepancy_by_cb_int = ".$_POST['inspector']."";
			
			//echo "Discover SQL :".$sql." <br>";
			
			$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			if (mysqli_connect_errno()) {
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				else {
					$objrs_support = mysqli_query($objconn_support, $sql);
					if ($objrs_support) {
							$number_of_rows = mysqli_num_rows($objrs_support);
							
							//echo "Number of rows :".$number_of_rows." <br>";
							while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
									
									$tmpsuppliedid 		= $objfields['Discrepancy_id'];
									$tmpsuppliedname 	= $objfields['Discrepancy_name'];
									$tmpvalue 			= (string) $tmpsuppliedid;
									$tmpa 				= $tmpvalue."za";
									$tmpd				= $tmpvalue."zd";
									
									if($_POST[$tmpd] == 1) {
											
											// User has selected to convert this Discrepancy from the temp table to the real table
											//	Place everything into a set of variables
											
											$discrepancy_id 			= $objfields['Discrepancy_id'];
											
											//echo "Discrepancy ID : ".$discrepancy_id." <br>";
											$discrepancy_checklist_id 	= $objfields['discrepancy_checklist_id'];
											//$discrepancy_inspection_id 	= $objfields['$discrepancy_inspection_id'];
											$discrepancy_inspection_id 	= $_POST['recordid'];
											$discrepancy_by				= $objfields['Discrepancy_by_cb_int'];
											$discrepancy_name			= $objfields['Discrepancy_name'];
											$discrepancy_remarks		= $objfields['discrepancy_remarks'];
										
											$sql2 = "INSERT INTO tbl_139_303_c_sub_d (discrepancy_checklist_id, discrepancy_inspection_id, discrepancy_by_cb_int, discrepancy_name, discrepancy_remarks)
													VALUES (	'".$discrepancy_checklist_id."',
																'".$discrepancy_inspection_id."',
																'".$discrepancy_by."', 
																'".$discrepancy_name."', 
																'".$discrepancy_remarks."')";
											
											//echo "INSERT SQL :".$sql2." <br>";
											
											$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
								
											if (mysqli_connect_errno()) {
													// there was an error trying to connect to the mysql database
													printf("connect failed: %s\n", mysqli_connect_error());
													exit();
												} else {
												
													//echo "[3][a][8] : Connection with _sub_d table established <BR>";
												
													$objrs2 			= mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));
													$newdiscrepancyid 	= mysqli_insert_id($objcon2);
												
												}
												
											// Delete the record now!
											
											$sql 	= "DELETE FROM tbl_139_303_c_sub_d_tmp WHERE Discrepancy_id = ".$discrepancy_id."";
											
											//echo "DELETE SQL : ".$sql." <br>";
											
											$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
																			
											if (mysqli_connect_errno()) {
													// there was an error trying to connect to the mysql database
													printf("connect failed: %s\n", mysqli_connect_error());
													exit();
												} else {
												
													$objrs3 = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
													$discrepancyrepairID = mysqli_insert_id($objcon);
													
												}
										}
								}
						}
				}
	
		
		?>
		
		<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10" class="tableheaderleft">&nbsp;</td>
				<td class="tableheadercenter">
					Enter New Part 139.303 (c) Training Session
					</td>
				<td class="tableheaderright">
					(
					Inspection Saved
					)
					</td>
				</tr>
			<tr>
				<td colspan="3" align="center" valign="middle" class="formheaders">
					Part 139.303 (c) Training Session has been sucssesfully added to the system.  You may print the report out for your own records.
					</td>
				</tr>		
			<tr>
				<form style="margin-bottom:0;" action="part139303_c_report_display_new.php" method="POST" name="printform" id="printform" target="_printerfriendlyreport">
				<td class="formoptionsavilablebottom" colspan="3">
					<input type="hidden" name="recordid" 			value="<?php echo $_POST['recordid'];?>">
					<input type="submit" name="b1" 					value="Display / Print Report >>>"			class="formsubmit">
					</td>
					</form>
				</tr>
			</table>
			<?php

// Establish Page Variables
		
		$last_main_id	= $lastid;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>