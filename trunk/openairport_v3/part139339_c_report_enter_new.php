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
//	Name of Document		:	part139339_c_report_enter_new.php
//
//	Purpose of Page			:	Enter New Part139.339 (c) Inspection
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/_template/template.list.php");

// Load Page Specific Includes

		include("includes/_modules/part139339/part139339.list.php");
		
// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		// Navigation Page ID
		//		Enter the ID of the Navigation Module this page belongs to.
		//		Check the AutoEntry function for more details...
		$navigation_page 			= 40;
		// Page Type ID
		//		Enter the ID of the Event type for this page.
		//		Check the AutoEntry function for more details...
		$type_page 					= 16;							// Page is Type ID, see function for notes!
		// Other Settings for AutoEntry
		//		You should not need to change these values.
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions

if (!isset($_POST["formsubmit"])) {
		// there is nothing in the post querystring, so this must be the first time this form is being shown
		// display form doing all our trickery!
		
		?>

						<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" name="entryform">
							<input type="hidden" name="formsubmit"		id="formsubmit"			value="1">
							<input type="hidden" name="menuitemid" 		ID="menuitemid"			value="<?php echo $_POST['menuitemid'];?>">
							<input type="hidden" name="inspector" 		id="inspector"		 	value="<?php echo $_SESSION['user_id'];?>">
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									<?php 
									getnameofmenuitemid($strmenuitemid, "long", 4, "#FFFFFF",$_SESSION['user_id']);
									?>
									</td>
								<td class="tableheaderright">
									(
									<?php 
									getpurposeofmenuitemid($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
									?>
									)
									</td>
								</tr>
							<tr>
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
										<tr>
											<td colspan="3" class="formoptionsavilabletop">
												Please complete the form below in as much detail as possible, and please pay close attention to syntax.
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Select from the list')"; onMouseout="hideddrivetip()">
												Type of Inspection
												</td>
											<td align="center" valign="middle" class="formoptions">
												<?php 
												part139339typescombobox("all", "all", "InspCheckList", "show", "");
												?>
												</td>
											<td class="formoptions" align="center">
												<input class="formsubmit" type="button" name="button" value="Get Checklist" onClick="call_server_ficon(<?php echo $_SESSION['user_id'];?>,'report');"><input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.entryform.submit()">&nbsp;
												</td>
											</tr>
										<tr>
											<td colspan="3" id="CheckListData" class="formoptionsavilablebottom">
												<center>After clicking the 'Get Checklist' button, please wait a moment while the checklist loads</center>
												<?php 
												for ($i=0; $i<150; $i=$i+1) {
														?>
														<br>
														<?php 
													}
												?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
												Save FiCON to Templates
												</td>
											<td class="formanswers" colspan="2">
												<SELECT name="frmtemplatesave" id="frmtemplatesave" onchange="call_server_ficon_template(<?php echo $_SESSION['user_id'];?>);">
													<option value="NO" SELECTED>NO</option>
													<option value="YES">YES</option>
													</select>
												</td>
											</tr>
										<tr>
											<td colspan="3" id="TemplateSaveData" class="formoptionsavilablebottom">
												<center></center>
												<?php
												for ($i=0; $i<10; $i=$i+1) {
														?>
														<br>
														<?php
													}
												?>
												</td>
											</tr>
										<tr>
											<td colspan="4" height="8" align="right">
												<font size="1">&nbsp;</font>
												</td>
											</tr>
										<tr>
											<td height="32" colspan="12" class="formoptionsavilablebottom" valign="middle">
												<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.entryform.submit()">&nbsp;
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							</form>
		<?php
	}
	else {
		?>
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									<?php
									getnameofmenuitemid($strmenuitemid, "long", 4, "#FFFFFF",$_SESSION['user_id']);
									?>
									</td>
								<td class="tableheaderright">
									(
									<?php
									getpurposeofmenuitemid($strmenuitemid, 1, "#FFFFFF",$_SESSION['user_id']);
									?>
									)
									</td>
								</tr>
							<tr>
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
										<tr>
											<td colspan="3" class="formoptionsavilabletop">
												<?php
												if ($_POST['frmtemplatesave']=="YES") {
														//User has choosen to save their FiCON as a template
														?>
														FiCON Template has been saved
														<?php
													}
												?>					
												</td>
											</tr>
										<tr>
											<td colspan="3" class="formoptionsavilabletop">
												<p>
													The Field Condition Report has been successfully added 
													to the database.<br>
													<br>
													If you want to add any graphic anomalies to the report, 
													please click the 'Add Anomalies' button below.  Each 
													anomaly will automatically be associated with this Field 
													Condition Report and displayed on the report.<br>
													<br>
													If you do not wish to add a surface anomaly to this 
													report or once you have completed adding any anomalies 
													you wish click the 'Print Report' button. The Field 
													Condition Report is not officially filled until you 
													press the 'Print Report' button.
													</p>
												</td>
											</tr>
		<?										
		// Form has been submitted
		// There are two things that must be done initialy before we go off to the discrepancy page.
		// Step 1). Add the Inspection Header information to the database
		// Step 2). Add each checklist item to the database for that inspection.
		
		$tmpdate = AmerDate2SqlDateTime($_POST['frmdate']);
		
		$sql = "INSERT INTO tbl_139_339_main (139339_type_cb_int, 139339_by_cb_int, 139339_date, 139339_time, 139339_metar, 139339_notes ) VALUES ( '".$_POST['InspCheckList']."', '".$_POST['inspector']."', '".$tmpdate."', '".$_POST['frmtime']."', '".$_POST['frmmetar']."', '".$_POST['frmnotes']."' )";
				
		//echo $sql;

		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs 			= mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid 		= mysqli_insert_id($mysqli);
						$last_main_id 	= $lastid;
						//echo $tmp;
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}							

		
		
// SAVE RECORDS		
		
		$increment = 10;
		
		//$sql = "SELECT * FROM tbl_139_339_sub_c WHERE 139339_c_type_cb_int = '".$_POST['InspCheckList']."' AND 139339_c_archived_yn = 0";
		
		$sql = "SELECT * FROM tbl_139_339_sub_c 
				INNER JOIN tbl_139_339_sub_c_f ON 139339_f_id = 139339_c_facility_cb_int					
				WHERE 139339_c_type_cb_int = '".$_POST['InspCheckList']."' AND 139339_c_archived_yn = 0
				ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";

		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
						//mysql_insert_id();
						$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
						
						while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
							
							
								$tmpid 					= $objfields['139339_c_id'];
								$current_facility 		= $objfields['139339_c_facility_cb_int'];
								$current_facility_rwy	= $objfields['139339_f_rwy_yn'];
								$tmpcondname			= $objfields['139339_c_name'];
								$tmp_xlox				= $objfields['139339_cc_xloc'];
								
								$facility_id			= $objfields['139339_f_id'];				// The ID of the facility row
								$facility_name			= $objfields['139339_f_name'];				// The Name of this facility. Typically english readable
								$facility_is_runway		= $objfields['139339_f_rwy_yn'];			// Toggle for dynamic control. 0: Nothing special, 1: Is a runway, 2: is a holder for runway orintation, 3: Checkbox not applicable to a surface
								
								$condition_id			= $objfields['139339_c_id'];				// The ID of the condition row
								$condition_name			= $objfields['139339_c_name'];				// The Programming name of this condition.  Typically not something readable
								$condition_type			= $objfields['139339_c_type_cb_int'];		// The type of FiCON this condition is part of.  Timeline....
								$condition_field_type	= $objfields['139339_cc_type'];				// Describes the type of input box this is:  0:Mu Value, 1: checkbox, 2: text
								$condition_xlocation	= $objfields['139339_cc_xloc'];				// Describes the order to sort this condition

								$condition_location_x	= $objfields['139339_cc_location_x'];
								$condition_location_y	= $objfields['139339_cc_location_y'];
								
								
								$checklist_item_id		= $objfields['139339_cc_id'];				// ID of the checklist item
								$checklist_item_disc	= $objfields['139339_cc_d_yn'];				// Value of the discrepancy (could be Mu value, a surface description, or a checkbox toggle).
								
		
							// We now are inside each record of each type of condition that is part of the selected checklist, now we need to add a new record to another table for each of these records.
							// That means establishing a new connection to the database while this one is still open.
							$tmpid 			= $objfields['139339_c_id'];
							$tmpfacilityid	= $objfields['139339_c_facility_cb_int'];
							$tmpcondname	= $objfields['139339_c_name'];
							$tmpcondnamestr	= str_replace(" ","",$tmpcondname);
							//$facility_namestr = str_replace(" ","",$facility_name);
							$facility_namestr = str_replace("/","",$facility_namestr);
						
							//echo "Condition String :".$tmpcondnamestr." ==> ";
							//echo "Condition Value from POST :".$_POST[$tmpcondnamestr]." <br>";
							
							$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

							//mysql_insert_id();
				
							// Somehow we need to detect if this is a Mu value from a runway.
							//		determine which runway it is
							//		determine which direction the toggle is set
							//		change the value of the post variable so the save procedure can save it
							//		this can be hard coded to an extent, lets just try it
							
							//	1 - Which runway
							
							$sql = "INSERT INTO tbl_139_339_sub_c_c (139339_cc_c_cb_int,139339_cc_ficon_cb_int,139339_cc_d_yn) VALUES ( '".$tmpid."', '".$lastid."', '".$_POST[$tmpcondnamestr]."')";
		
									//echo $sql."<br><br>";
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}		
										else {
											//mysql_insert_id();
											$objrs2 = mysqli_query($objcon2, $sql) or die(mysqli_error($objcon2));
											$lastchkid = mysqli_insert_id($objcon2);
											?>
											
											<?
										}
							}

		tools_tbl_139_339_c_main_changedirection($last_main_id);				
							
		if ($_POST['frmtemplatesave']=="YES") {
				// Save the Template that the User Entered
				
				$sql = "INSERT INTO tbl_139_339_main_t (139339_main_t_name, 139339_main_t_purpose, 139339_main_t_type_cb_int, 139339_main_t_notes) VALUES ( '".$_POST['frmtemplatename']."', '".$_POST['frmtemplatepurpose']."', '".$_POST['InspCheckList']."', '".$_POST['frmnotes']."' )";
				
				//echo $sql;

				$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

				//mysql_insert_id();
						
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}		
							else {
							//mysql_insert_id();
								$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
								$lastid_template = mysqli_insert_id($mysqli);
								//echo $tmp;
								//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
								//echo mysql_insert_id($mysqli);
								}
								
				$sql 	= "SELECT * FROM tbl_139_339_sub_c WHERE 139339_c_type_cb_int = '".$_POST['InspCheckList']."' AND 139339_c_archived_yn = 0";
				
				$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

				//mysql_insert_id();
						
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}		
							else {
								//mysql_insert_id();
								$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
								while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
									// We now are inside each record of each type of condition that is part of the selected checklist, now we need to add a new record to another table for each of these records.
									// That means establishing a new connection to the database while this one is still open.
									$tmpid 			= $objfields['139339_c_id'];
									$tmpfacilityid	= $objfields['139339_c_facility_cb_int'];
									$tmpcondname	= $objfields['139339_c_name'];
									$tmpcondnamestr	= str_replace(" ","",$tmpcondname);
									
									$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									
									//mysql_insert_id();
						
									$sql = "INSERT INTO tbl_139_339_main_t_cc (139339_t_cc_c_cb_int,139339_t_cc_ficon_cb_int,139339_t_cc_d_yn) VALUES ( '".$tmpid."', '".$lastid_template."', '".$_POST[$tmpcondnamestr]."')";
				
											//echo $sql."<br><br>";
											if (mysqli_connect_errno()) {
													// there was an error trying to connect to the mysql database
													printf("connect failed: %s\n", mysqli_connect_error());
													exit();
												}		
												else {
													//mysql_insert_id();
													$objrs2 = mysqli_query($objcon2, $sql) or die(mysqli_error($objcon2));
													$lastchkid = mysqli_insert_id($objcon2);
													?>
													
													<?php
												}
									}
			}
			}
			?>			
									<tr>
											<form style="margin-bottom:0;" action="part139339_c_discrepancy_report_new.php" method="POST" name="dform" id="dform" target="AddDiscrepancy" onsubmit="openchild600('', 'AddDiscrepancy');" >
											<td class="formresults" align="center" valign="middle">
												<?php
												// What does the Anomaly care about?
												// discrepancy checklist id			-- Not terribly relevent to anything actually.
												//										Anomalies are not associated with a checklist.
												//										Skip this....
												// discrepancy inspection id		-- This we know from above	
												// discrepancy type id				-- This we know from above
												// discrepancy by id				-- Wouldn't be known yet....
												
												
												?>
												<input type="hidden" name="recordid" 			value="<?php echo $lastid;?>">
												<input type="hidden" name="inspectiontypeid" 	value="<?php echo $_POST['InspCheckList'];?>">
												<input type="hidden" name="golive" 				value="1">
												<input type="submit" name="b1" 					value="Add Anomalie"			class="formsubmit">
												</td>
											</form>								
											</tr>
									<tr class="formresults">
										<td colspan="3" name="addeddis" id="addeddis">
											<center>New Anomalies will be added here as you add new ones from the "Add Anomalie' button above</center>
											<?php 
											for ($i=0; $i<20; $i=$i+1) {
													?>
													<br>
													<?php 
												}
											?>
											</td>
										</tr>											
										<tr>
											<form style="margin-bottom:0;" action="part139339_c_report_display_new.php" method="POST" name="printform" id="printform" target="PrinterFriendlyReport" onsubmit="window.open('', 'PrinterFriendlyReport', 'width=800,height=962,status=no,resizable=no,scrollbars=yes')">
											<td class="formoptionsavilablebottom" colspan="3">
												<input type="hidden" name="conditionid" 		value="<?php echo $tmpid;?>">
												<input type="hidden" name="recordid" 			value="<?php echo $lastid;?>">
												<input type="hidden" name="checklistid" 		value="<?php echo $lastchkid;?>">
												<input type="hidden" name="facilityid" 			value="<?php echo $tmpfacilityid;?>">
												<input type="submit" name="b1" 					value="Print Report"			class="formsubmit">
												</td>
											</form>
										</table>
									</td>
								</tr>
							</table>
							<?
						}		
	}

// Define Variables...
//						for Auto Entry Function {End of Page}

		// Last Main ID
		//		This is the ID of the main record of this page, not a sub routine.
		//		If no ID is used or possible to obtain such a browse page or a form loader enter '-'
		//$last_main_id	= "-";
		
		//	AutoEntry Function Array
		//		This array controls the values sent to the auto entry function.
		//		No changes should be needed to it.
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>		