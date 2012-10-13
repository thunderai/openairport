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
//	Name of Document		:	part139337_report_display_yearend_report.php
//
//	Purpose of Page			:	View Part 139.337 Actions By Year / Yead End Report
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
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes
		include("includes/_dateandtime/dateandtime.list.php");
		include("scripts/_scripts_header_iface.inc.php");
		//include("includes/AutoEntryFunctions.php");
		include("includes/_systemusers/systemusers.list.php");
		include("includes/_modules/part139337/part139337.list.php");
		include("includes/_navigation/navigation.list.php");
		include("includes/_template/template.list.php");
		include("includes/_generalsettings/generalsettings.list.php");	
		

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 21;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 2;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions


		
// Set Variables
		$tmpspecies			= '';
		$tmpcounter			= '';
		$tmplastspecies		= '';
		
		$fullcounter		= '';
		
		$displayedrow		= '';	
		$display_spermit	= '';
		$display_fpermit	= '';

		$isarchived			= '';
		$iserror			= '';
		$displaydatarow		= '';
		
		$tmpdate			= '';
		
		$displayrow			= 1;

// Load POST Variables

		$tmpyear 		= $_POST['frmyear'];
		
		if (!isset($_POST['wlhmspermit'])) {
				// Option is not set
				$display_spermit	= 0;
			}
			else {
				// Option is set
				$display_spermit	= $_POST['wlhmspermit'];
			}
			
		if (!isset($_POST['wlhmfpermit'])) {
				// Option is not set
				$display_fpermit	= 0;
			}
			else {
				// Option is set
				$display_fpermit 	= $_POST['wlhmfpermit'];
			}
		?>
		<link href="stylesheets/reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY>
		<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13" />
			<tr>
				<td colspan="4" align="center">
					<font size="5">Wildlife Hazard Management Year End Report</font>
					</td>
				</tr>
			<tr align="left" />
				<td align="right" />
					<b>DATE</b>
					</td>
				<td align="center" />
					<?php
					$tmpdate = date('m/d/Y');
					?>
					<b><?php echo $tmpdate;?></b>	
					</td>
				<td align="right" />
					<b>YEAR</b>
					</td>
				<td align="center" />
					<?php echo $tmpyear;?>
					</td>
				</tr>
			<tr align="left" />
				<td align="right" />
					<b>TIME</b>
					</td>
				<td align="center">
					<b>
						<?php echo date('H:m:s');?>
						</b>
					</td>
				<td align="right" />
					<b>PERMITS</b>
					</td>
				<td align="center" />
					<?php
					if ($display_spermit == 1) {
							?>
							State
							<?php
							if ($display_fpermit == 1) {
									?>
									and Federal
									<?php
								}
						}
						else {		
							if ($display_fpermit == 1) {
									?>
									Federal
									<?php
								}
								else {
									?>
									Any or None
									<?php
								}
						}
					?>
					</td>
				</tr>
			</table>
		<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" height="13">
		<?	
		$displayspecies_id 	= $_POST['wlhmspecies'];
		$displayactivity_id = $_POST['wlhmactivity'];
		$displayaction_id 	= $_POST['wlhmaction'];
										
										
		if($displayspecies_id == 'all') {
				// User has selected to display all animals
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_s 		= "AND 139337_species_cb_int = '".$displayspecies_id."' ";
			}
			
		if($displayactivity_id == 'all') {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_ay 		= "AND 139337_activity_cb_int = '".$displayactivity_id."' ";
			}
			
		if($displayaction_id == 'all') {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_an 		= "AND 139337_action_cb_int = '".$displayaction_id."' ";
			}			
			
		if($display_spermit == 0) {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_sp 		= "AND tbl_139_337_sub_s.139337_sub_s_statepermit = '".$display_spermit."' ";
			}	
			
		if($display_fpermit == 0) {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_fp 		= "AND tbl_139_337_sub_s.139337_sub_s_federalpermit = '".$display_fpermit."' ";
			}		

			
		// Create SQL Statement
		$sql = "SELECT * FROM tbl_139_337_main
		INNER JOIN tbl_139_337_sub_s 	ON tbl_139_337_main.139337_species_cb_int = tbl_139_337_sub_s.139337_sub_s_id 
		INNER JOIN tbl_139_337_sub_an	ON tbl_139_337_sub_an.139337_sub_an_id = tbl_139_337_main.139337_action_cb_int 
		INNER JOIN tbl_139_337_sub_ay	ON tbl_139_337_sub_ay.139337_sub_ay_id = tbl_139_337_main.139337_activity_cb_int 
		WHERE YEAR(139337_date) = '".$tmpyear."' ".$msql_s." ".$msql_ay." ".$msql_an." ".$msql_sp." ".$msql_fp." ORDER BY 139337_sub_s_category, 139337_sub_s_name";

		//echo "The SQL Statement is ".$sql." <BR>";

		// Create Connection Object to Database
		$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				// There is a good connection to the database
				$objrs = mysqli_query($objconn, $sql);
		
				if ($objrs) {
						// There is a successfull connection to the object record set
						
						$numberofrows = mysqli_num_rows($objrs);
						
						//echo "There are ".$numberofrows." in this recordset. <br>";
						
						while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								$tmpid			= $objarray['139337_sub_s_id'];
								$tmpspecies		= $objarray['139337_sub_s_id'];
								$tmpactivity	= $objarray['139337_sub_ay_id'];
								$tmpaction		= $objarray['139337_sub_an_id'];
								$tmpspermit		= $objarray['139337_sub_s_statepermit'];
								$tmpfpermit		= $objarray['139337_sub_s_federalpermit'];
								
								// Before we use this row for information, is it archieved?
								$status = preflights_tbl_139_337_main_a_yn($tmpid,0);
								
								if ($status == 0) {
										// Report is archieved, do not display it
										$displayrow = 0;
									}
									else {
										// Display Row, but wait for other settings...
										// Has the user selected to limit the species to one or all													
								
										if($displayrow == 1) {
										
												$totaldisplayed = $totaldisplayed + 1;
										
												if ($tmplastspecies <> $tmpspecies) {
														// The last species displayed and the current one are the NOT same.
														// Display the species title bar
														if($total_all == 0) {
																// Do not display the total bar
															}
															else {
																?>
			<tr>
				<td colspan="4" align="right">
					Total Species &nbsp;&nbsp;&nbsp;
					</td>
				<td colspan="1" align="center">
					<?php echo $total_species;?>
					</td>		
				<td colspan="1">
					&nbsp;
					</td>					
				</tr>
																<?php
															}
														?>
			<tr>
				<td colspan="6" bgcolor="#000000">
					<font color="#FFFFFF" size="3"><?php echo $objarray['139337_sub_s_name'];?></font>
					<?php 
					// Reset Species Total
					$total_species = 0;
					?>
					</td>
				</tr>
			<tr>
				<td align="center" valign="middle" >
					<b><font size="2">Date</font></b>
					</td>
				<td align="center" valign="middle" >
					<b><font size="2">Activity</font></b>
					</td>
				<td align="center" valign="middle" >
					<b><font size="2">Action</font></b>
					</td>					
				<td align="center" valign="middle" >
					<b><font size="2">Results</font></b>
					</td>						
				<td align="center" valign="middle" >
					<b><font size="2"># of Species</font></b>
					</td>
				<td align="center" valign="middle" >
					<b><font size="2">Permits</font></b>
					</td>					
				</tr>
														<?php
													}
												?>
			<tr>
				<td align="center" valign="middle" >
					<?php echo $objarray['139337_date'];?>
					</td>
				<td align="center" valign="middle" >
					<?php echo $objarray['139337_sub_ay_name'];?>
					</td>
				<td align="center" valign="middle" >
					<?php echo $objarray['139337_sub_an_name'];?>
					</td>					
				<td align="center" valign="middle" >
					<?php echo $objarray['139337_resultsofaction'];?>
					</td>						
				<td align="center" valign="middle" >
					<?php echo $objarray['139337_numberofspecies'];?>
					<?php
					$total_all		= $total_all + $objarray['139337_numberofspecies'];
					$total_species 	= $total_species + $objarray['139337_numberofspecies'];
					//echo $total_all." / ".$total_species;
					?>
					</td>
				<td align="center" valign="middle" >
					S: <?php echo $objarray['139337_sub_s_statepermit'];?> / 
					F: <?php echo $objarray['139337_sub_s_federalpermit'];?>
					</td>					
				</tr>								
												<?php
											}
										$tmplastspecies = $objarray['139337_species_cb_int'];
									}	// End of DisplayRow
							} // End of While Loop
					if($total_all == 0){
							// Display Nothing
						}
						else {
							?>
			<tr>
				<td colspan="4" align="right">
					Total Species &nbsp;&nbsp;&nbsp;
					</td>
				<td colspan="1" align="center">
					<?php echo $total_species;?>
					</td>		
				<td colspan="1">
					&nbsp;
					</td>					
				</tr>
			<tr>
				<td colspan="6" bgcolor="#000000">
					<font color="#FFFFFF" size="3">Summary</font>
					</td>
				</tr>				
			<tr>
				<td colspan="4" >
					&nbsp;
					</td>
				<td align="center">
					Total
					</td>					
				<td align="center">
					Average (kps)
					</td>						
				</tr>	
			<tr>
				<td colspan="4" align="right">
					Number of Species &nbsp;
					</td>
				<td align="center">
					<?php echo $total_all;?>
					</td>					
				<td align="center">
					<?php
					$average = ($total_all / $totaldisplayed);
					$average = round($average,2);
					?>
					<?php echo $average;?>
					</td>						
				</tr>
						<?php
					}
				?>

			
			<tr>
				<td colspan="6">
					End of Report
					</td>
				</tr>
						<?php
			}	// End of Object Recordset
	}	// End of Connection

// Define Variables...
//						for Auto Entry Function {End of Page}

		$last_main_id	= "-";	// No Valid ID to use
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>