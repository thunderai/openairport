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
//	Name of Document		:	part139339_b_ajax_getchecklist.php
//
//	Purpose of Page			:	Load Part 139.339 (c) Inspection Checklist (AJAX)
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_globals.inc.php");												// Need Global Variable Information
		
// Load Page Specific Includes

		include("includes/_template/template.list.php");
		include("includes/_modules/part139339/part139339.list.php");
		
	
// Define Variables	
	
		$aInspection	= "";
		$i				= 1;
		$fullorshort	= 0;
		$InspCheckList 	= $_GET["InspCheckList"];
		$IntInspector 	= $_GET["Employee"];
?>

		<center>
				<table cellspacing="3" cellpadding="5" width="100%">
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
							Metar
							</td>
						<td class="formanswers">
							<?php
							$tmpstring = readweathertxt("null");
							?>		
							<input class="commonfieldbox"	type="text"		name="frmmetar"	ID="frmmetar"	size="90" 	value="<?php echo $tmpstring;?>" disabled="disabled">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
							Date
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" 	type="text" 	name="frmdate" ID="frmdate" 	size="10"	value="<?echo date('m/d/Y');?>" onchange="javascript:(isdate(this.form.frmstartdate.value,'mm/dd/yyyy'))">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
							Time
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" 	type="text" 	name="frmtime"	ID="frmtime"	size="10" 	value="<?echo date("H:i:s");?>">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
							Date to Close
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" type="text" 	id="frmdateclosed" 	name="frmdateclosed" 	size="10" value="<?echo date('m/d/Y');?>" /> <input class="commonfieldbox" type="checkbox" value="1" onclick="clearcellvalue('frmdateclosed','<?echo date('m/d/Y');?>');">
							<input class="commonfieldbox" type="hidden" id="frmdateclosedo" name="frmdateclosedo" 	size="10" value="<?echo date('m/d/Y');?>" />
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the time this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.')"; onMouseout="hideddrivetip()">
							Time to Close
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" type="text" 	id="frmtimeclosed" 	name="frmtimeclosed" 	size="10" value="<?echo date("H:i:s");?>" /> <input class="commonfieldbox" type="checkbox" value="1" onclick="clearcellvalue('frmtimeclosed','<?echo date("H:i:s");?>');">
							<input class="commonfieldbox" type="hidden" id="frmtimeclosedo" name="frmtimeclosedo" 	size="10" value="<?echo date("H:i:s");?>" />
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
							Wx Initials (issue)
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" type="text" id="139339_sub_n_wx_out" name="139339_sub_n_wx_out" size="10">
							</td>
						</tr>									
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
							FBO Initials (issue)
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" type="text" id="139339_sub_n_fbo_out" name="139339_sub_n_fbo_out" size="10">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
							Airline Initials (issue)
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" type="text" id="139339_sub_n_airline_out" name="139339_sub_n_airline_out" size="10">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
							Notes
							</td>
						<td class="formanswers">
							<textarea name="frmnotes" ID="frmnotes" Rows="5" cols="60"></textarea>
							</td>
						</tr>
					</table>
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
									WHERE 139339_c_type_cb_int = '".$InspCheckList."' AND 139339_c_archived_yn = 0 AND 139339_f_rwy_yn = 0 OR 139339_f_rwy_yn = 1 
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