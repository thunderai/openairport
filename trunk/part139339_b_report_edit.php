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
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes

		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Define Variables	
		
		$tblname				= "Edit NOTAM Report";									// Name of form
		$tblsubname				= "Please complete the form";							// Subtitle of form
		
		$i 						= "";
		$tmpvalue				= "";

// Collect POST Information
		
		$inspection_id			= $_POST['recordid'];
		$menuitemid 			= $_POST['menuitemid'];													
		$tblname				= $_POST['tblname'];													
		$tblsubname				= $_POST['tblsubname'];
	
// Start Procedures
	if (!isset($inspection_id)) {
			// No Record ID Supplied, Crash Out
		}
		else {
			if (!isset($_POST["formsubmit"])) {
					
					
				//echo "The form has not been submitted before, this is the first time displaying the form. <br>";				
				$sql =" SELECT * FROM tbl_139_339_sub_n WHERE 139339_sub_n_id = ".$inspection_id."";
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
						<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10" class="tableheaderleft">&nbsp;</td>
								<td class="tableheadercenter">
									<?php echo $tblname;?>
									</td>
								<td class="tableheaderright">
									(<?php echo $tblsubname;?>)
									</td>
								</tr>
							<tr>
								<td colspan="3" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
						<?php
								while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										?>
							<tr>
								<td colspan="2">
									<table cellspacing="0" width="100%">
										<tr>
											<td class="formoptionsavilabletop">
												The following options are avilable to you
												</td>
											</tr>
										<tr>
											<td class="formoptionsavilablebottom">
												<table>
													<tr>
														<?php
														// Hijack Template Functions for our own purposes
														$settingsarray 	= array("SELECT * FROM tbl_139_339_sub_a WHERE 139339_a_inspection_id = "	,	"139339",	"part139339_c_report_display_archived.php");
														$functionpage	= "part139339_c_report_archieved.php";														
														_tp_control_archived($inspection_id, $settingsarray, $functionpage);
														
														$settingsarray 	= array("SELECT * FROM tbl_139_339_sub_e WHERE 139339_eoo_i_id = "			,	"139339",	"part139339_c_report_display_error.php");
														$functionpage	= "part139339_c_report_error.php";														
														_tp_control_error($inspection_id, $settingsarray, $functionpage);	
														
														$settingsarray 	= array("SELECT * FROM tbl_139_339_sub_n_r WHERE 139339_sub_n_r_cancelled_id_int = ",	"139339_sub_n",	"part139339_n_report_display_closed.php");
														$functionpage	= "part139339_b_report_closed.php";														
														_tp_control_closed($objarray['139339_sub_n_id'], $settingsarray, $functionpage);															
														
														?>														
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							<tr>
								<td colspan="2" class="tablesubcontent">
									<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
										<tr>
											<td colspan="2" class="formoptionsavilabletop">
												Please complete the form below in as much detail as possible, and please pay close attention to syntax.
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Select from the list')"; onMouseout="hideddrivetip()">
												Type of Inspection
												</td>
											<td align="center" valign="middle" class="formoptions">
												<?php 
												$InspCheckList = $objarray['139339_sub_n_type_cb_int'];
												part139339typescombobox($objarray['139339_sub_n_type_cb_int'], "all", "InspCheckList", "show", $objarray['139339_sub_n_type_cb_int']);
												?>
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
												Metar
												</td>
											<td class="formanswers">
												<input class="commonfieldbox"	type="text"		name="frmmetar"	ID="frmmetar"	size="90" 	value="<?php echo $objarray['139339_sub_n_metar'];?>" disabled="disabled">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
												Date
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" 	type="text" 	name="frmdate" ID="frmdate" 	size="10"	value="<?php echo $objarray['139339_sub_n_date'];?>" onchange="javascript:(isdate(this.form.frmstartdate.value,'mm/dd/yyyy'))">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
												Time
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" 	type="text" 	name="frmtime"	ID="frmtime"	size="10" 	value="<?php echo $objarray['139339_sub_n_time'];?>">
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
												Date to Close
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" type="text" 	id="frmdateclosed" 	name="frmdateclosed" 	size="10" value="<?php echo $objarray['139339_sub_n_date_closed'];?>" /> <input class="commonfieldbox" type="checkbox" value="1" onclick="clearcellvalue('frmdateclosed','<?echo date('m/d/Y');?>');">
												<input class="commonfieldbox" type="hidden" id="frmdateclosedo" name="frmdateclosedo" 	size="10" value="<?php echo $objarray['139339_sub_n_date_closed'];?>" />
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the time this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.')"; onMouseout="hideddrivetip()">
												Time to Close
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" type="text" 	id="frmtimeclosed" 	name="frmtimeclosed" 	size="10" value="<?php echo $objarray['139339_sub_n_time_closed'];?>" /> <input class="commonfieldbox" type="checkbox" value="1" onclick="clearcellvalue('frmtimeclosed','<?echo date("H:i:s");?>');">
												<input class="commonfieldbox" type="hidden" id="frmtimeclosedo" name="frmtimeclosedo" 	size="10" value="<?php echo $objarray['139339_sub_n_time_closed'];?>" />
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
												Wx Initials (issue)
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" type="text" id="139339_sub_n_wx_out" name="139339_sub_n_wx_out" size="10" value="<?php echo $objarray['139339_sub_n_wx_in'];?>" />
												</td>
											</tr>									
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
												FBO Initials (issue)
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" type="text" id="139339_sub_n_fbo_out" name="139339_sub_n_fbo_out" size="10" value="<?php echo $objarray['139339_sub_n_fbo_in'];?>" />
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
												Airline Initials (issue)
												</td>
											<td class="formanswers">
												<input class="commonfieldbox" type="text" id="139339_sub_n_airline_out" name="139339_sub_n_airline_out" size="10" value="<?php echo $objarray['139339_sub_n_airline_in'];?>" />
												</td>
											</tr>
										<tr>
											<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
												Notes
												</td>
											<td class="formanswers">
												<textarea name="frmnotes" ID="frmnotes" Rows="5" cols="60"><?php echo $objarray['139339_sub_n_notes'];?></textarea>
												</td>
											</tr>
												<table cellspacing="0" cellpadding="0" width="100%">
													<tr>
														<td rowspan="2" class="formheaders">
																Surface
															</td>
														<td rowspan="2" class="formheaders">
																Closed ?<br>Yes?
															</td>
														</tr>
													<tr>
														<td colspan="4" class="header">
															<input type="hidden" id="typeofinspection" name="typeofinspection" value="<?php echo $InspCheckList;?>">
															<?php
															// Define SQL
															$sql = "SELECT * FROM tbl_139_339_sub_c 
																	INNER JOIN tbl_139_339_sub_c_f ON 139339_f_id = 139339_c_facility_cb_int					
																	WHERE 139339_c_type_cb_int = '".$InspCheckList."' AND 139339_c_archived_yn = 0 AND 139339_f_rwy_yn = 0 OR 139339_f_rwy_yn = 1 OR 139339_f_rwy_yn = 8 
																	ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
															
															//echo $sql;
															
															// Establish a Conneciton with the Database
															$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

															if (mysqli_connect_errno()) {
																	printf("connect failed: %s\n", mysqli_connect_error());
																	exit();
																}
																else {
																	$res = mysqli_query($objcon, $sql);
																	if ($res) {
																			$number_of_rows = mysqli_num_rows($res);
																			//printf("result set has %d rows. \n", $number_of_rows);
													
																			while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
																					$tmpid 				= $objfields['139339_c_id'];
																					//echo "The Temp ID is ".$tmpid."<br>";
																					$current_facility 	= $objfields['139339_c_facility_cb_int'];
																					if ($current_facility!=$previous_facility) {
																							//Row data has a different facility
																							?>
														</tr>						
													<tr>
														<td height="28" class="formresults">
																							&nbsp;
																							<?php
																							$tmpfacility = $objfields["139339_c_facility_cb_int"];
																							part139339_c_facilitycombobox($tmpfacility, "all", "notused", "hide", "all");
																							$tmpvalue 	= (string) $tmpid;
																							$tmpa 		= $tmpvalue."za";
																							$tmpd		= $tmpvalue."zd";
															
																							// Check to see if this record condition has a currently active NOTAM saying it is closed
																							$sql_sub 	= "SELECT * FROM tbl_139_339_sub_n_cc 
																											INNER JOIN tbl_139_339_sub_n ON tbl_139_339_sub_n.139339_sub_n_id = tbl_139_339_sub_n_cc.139339_cc_ficon_cb_int 
																											WHERE 139339_cc_c_cb_int = '".$tmpid."' ";
																							
																							//echo $sql_sub;
																							
																							$objcon_sub = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

																							$display_total = array();
																							$display_totals = 0;
																							$alterclosed = 0;
																	
																							if (mysqli_connect_errno()) {
																									printf("connect failed: %s\n", mysqli_connect_error());
																									exit();
																								}
																								else {
																									$res_sub = mysqli_query($objcon_sub, $sql_sub);
																									if ($res_sub) {
																											$number_of_rows = mysqli_num_rows($res_sub);
																											//printf("result set has %d rows. \n", $number_of_rows);					
																											while ($objfields_sub = mysqli_fetch_array($res_sub, MYSQLI_ASSOC)) {
																											
																													$displayrow 		= 1;
																													$tmp_is_closed 		= 0;
																					
																													if($objfields_sub['139339_cc_d_yn'] == 1) {
																															// Does the surface have a closed surface noration?
																															// It must otherwise we wouldn't even be in here
																															// We need to know two things:
																															//	is the NOTAM that caused this notation closed?
																															//	is it archived?
																															// 		if it is either of those things we dont need to condier it.
																													
																															// Test for archived. If 1 not archived, 0 is archived?
																															$display_archived		= preflights_tbl_139_339_sub_n_a_yn($objfields_sub['139339_sub_n_id'],0);	
																															//echo "Display Archived = ".$display_archived."<br>";
																															$display_closed			= preflights_tbl_139_339_sub_n_r_yn($objfields_sub['139339_sub_n_id'],0);
																															//echo "Display Closed = ".$display_closed."<br>";
																															
																															if($display_archived == 0) {
																																	// Surface is archived, skipp the rest
																																	$skipping = 1;
																															} else {														
																																	
																																	if($display_closed == 1) {
																																			// Surface NOTAM has no closed records
																																			$alterclosed = 1;
																																		} else {
																																			// Surface currently has closed notams on file
																																			$alterclosed = 0;
																																		}
																															}
																									
																													//echo "<br>";
																													//echo "NOTAM ID  |".$objfields_sub['139339_sub_n_id']."|<br>";
																													//echo "Archived  |".$display_archived."|<br>";
																													//echo "Closed	|".$display_closed."|<br>";
																														
																													//$display_totals = $display_totals + $displayrow;
																													}	
																													//$i = $i + 1;
																												}	// End of Sub While Loop

																												//echo "i: ".$displayrows."<br>";
																												
																										}	// End of Sub Object
																										else {
																											//echo "There are no records for this condition";
																										}
																								}
																						// END OF CHECK...
																						?>
															</td>
																						<?php
																						}
																						?>
																						<?php
																						$tmpfieldname = str_replace(" ","",$objfields["139339_c_name"]);
																						// This is the initial Closed Column.
																						$rootname = str_replace("Closed","",$tmpfieldname);
																						$rootname = str_replace("closed","",$rootname);
																						//echo $rootname;
												
																						switch ($objfields['139339_cc_type']) {
																								case 0:

																										break;
																								case 1:
																										if($alterclosed == 1) {
																											 // Dont even show it here
																											 ?>
																											 <td class="formresults">
																												Surface is already closed
																												</td>
																												<?php
																											 
																										} else {
																										?>
																	<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
																		<input class="Commonfieldbox" type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" style="width:20px;" size="4" 
																										<?php

																												if($objfields['139339_cc_d_yn'] == 1) {
																														?>
																	value="1" CHECKED onMouseover="ddrivetip('Surface is <b>CLOSED</b><br>If you open it, Do the paperwork!')"; onMouseout="hideddrivetip()" />
																														<?php
																												
																													}
																													else {
																											
																														?>																	
																	value="1" onMouseover="ddrivetip('Surface is <b>OPEN</b><br>If you close it, Do the paperwork!')"; onMouseout="hideddrivetip()" />
																														<?php
																												
																													}
																											}
																										break;
																								case 2:

																										break;

																							}
																						$previous_facility	= $objfields['139339_c_facility_cb_int'];
																						$i 					= $i + 1;
																						//$tmp_is_closed		= 0;
																						$displayrow			= 0;
																						}	// End of while loop
																						mysqli_free_result($res);
																						mysqli_close($objcon);
																				}	// end of Res Record Object						
																		}
																		?>
													</table>											
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
							}
					}
			} else {
						
				// Form has been submitted
				// There are two things that must be done initialy before we go off to the discrepancy page.
				// Step 1). Add the Inspection Header information to the database
		
				$tmpdate 		= AmerDate2SqlDateTime($_POST['frmdate']);
				$tmpdateclosed 	= AmerDate2SqlDateTime($_POST['frmdateclosed']);
		
		$sql = "INSERT INTO tbl_139_339_sub_n (139339_sub_n_type_cb_int, 139339_sub_n_by_cb_int, 139339_sub_n_date, 139339_sub_n_time, 139339_sub_n_metar, 139339_sub_n_notes, 139339_sub_n_wx_in, 139339_sub_n_fbo_in, 139339_sub_n_airline_in";
		
		if ($tmpdateclosed == "") {
				//echo "Nothing of value";
			}
			else {
				$sql =  $sql.", 139339_sub_n_date_closed, 139339_sub_n_time_closed ";
			}
		
		$sql = $sql.") VALUES ( '".$_POST['InspCheckList']."', '".$_POST['inspector']."', '".$tmpdate."', '".$_POST['frmtime']."', '".$_POST['frmmetar']."', '".$_POST['frmnotes']."', '".$_POST['139339_sub_n_wx_out']."', '".$_POST['139339_sub_n_fbo_out']."', '".$_POST['139339_sub_n_airline_out']."'  ";
		
		if ($tmpdateclosed == "") {
				//echo "Nothing of value";
			}
			else {
				$sql =  $sql.", '".$tmpdateclosed."', '".$_POST['frmtimeclosed']."' ";
			}		
		
		$sql 	= $sql.")";
		
		// If it is closed should issue a repair statemtn as well...........
		
		
		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid = mysqli_insert_id($mysqli);
						//echo $tmp;2
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						//echo mysql_insert_id($mysqli);
						}
		
		// Step 2). Add each checklist item to the database for that inspection.
		
		$sql = "SELECT * FROM tbl_139_339_sub_c WHERE 139339_c_type_cb_int = '".$_POST['InspCheckList']."' AND 139339_c_archived_yn = 0";		
		//echo $sql;
		
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
							
							// IF the value of $_POST[$tmpcondnamestr] = 1 then we do not want to save that checklist item, as its not relevent to our NOTAM.
							
							if ($_POST[$tmpcondnamestr]=="1") {
											
									$sql = "INSERT INTO tbl_139_339_sub_n_cc (139339_cc_c_cb_int,139339_cc_ficon_cb_int,139339_cc_d_yn) VALUES ( '".$tmpid."', '".$lastid."', '".$_POST[$tmpcondnamestr]."')";
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

												}
								}
								else {
									// Do nothing, we dont want to save the record to the DB
								}
							}
							
		$tblname		= "NOTAM Summary Report";
		$tblsubname		= "(summary of information)";
		
							?>
		<form style="margin-top:-3px;" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" name="edittable" id="edittable">
			<input type="hidden" name="formsubmit" 		ID="formsubmit"		value="1">
			<input type="hidden" NAME="recordid" 		ID="recordid" 		value="<?=$_POST['recordid'];?>">
		<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10" class="tableheaderleft">&nbsp;</td>
				<td class="tableheadercenter">
					<?php echo $tblname;?>
					</td>
				<td class="tableheaderright">
					(<?php echo $tblsubname;?>)
					</td>
				</tr>
			<tr>
				<td colspan="3" class="tablesubcontent">
					<table border="0" width="100%" cellspacing="3" cellpadding="5" id="table2" height="10">
						<tr>
							<td colspan="3">
								<?php
								_339_b_display_report_summary($lastid,2,0);
								?>
								</td>
							</tr>		
						</table>
					</td>
				</tr>
			</table>
							<?php
						}		
		$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
		$tmpsqltime		= date("H:i:s");
		$tmpsqlauthor		= $_SESSION["user_id"];
		$dutylogevent		= "Added New NOTAM";
		
		autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
		
	}
		}

// Load End of page includes

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>	