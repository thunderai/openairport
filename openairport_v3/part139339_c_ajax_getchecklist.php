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
//	Name of Document		:	part139339_c_ajax_getchecklist.php
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
					<?php
					if ($fullorshort==0){
							// Display Full FiCON Information
							?>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Select from the list')"; onMouseout="hideddrivetip()">
							FiCON Template
							</td>
						<td align="center" valign="middle" class="formoptions">
							<?php
							part139339_c_templatescombobox_ajax("all", "no", "InspTemplate", "show", "");
							?>
							</td>
						</tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('This is the purpose of this template')"; onMouseout="hideddrivetip()">
							Template Purpose
							</td>
						<td align="center" valign="middle" class="formoptions" id="templatepurpose" name="templatepurpose">
							</td>
						</tr>
							<?php
						}
					?>
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
						<?php
							if ($fullorshort==0){
									// Display Full FiCON Information
									?>
									<?
								}
								else {
									?>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
							Date to Close
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" type="text" id="frmdateclosed" name="frmdateclosed" size="10" value="<?echo date('m/d/Y');?>" onchange="javascript:(isdate(this.form.frmstartdate.value,'mm/dd/yyyy'))">&nbsp;<input class="commonfieldbox" type="checkbox" value="1" onclick="clearcellvalue('frmdateclosed');">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the time this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.')"; onMouseout="hideddrivetip()">
							Time to Close
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" type="text" id="frmtimeclosed" name="frmtimeclosed" size="10" value="<?echo date("H:i:s");?>">&nbsp;<input class="commonfieldbox" type="checkbox" value="1" onclick="clearcellvalue('frmtimeclosed');">
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
									<?php
								}
							?>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
							Notes
							</td>
						<td class="formanswers">
							<?php
							if ($fullorshort==0){
									// Display Full FiCON Information
									?>
							<textarea name="frmnotes" ID="frmnotes" Rows="5" cols="60">Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs</textarea>
									<?php
								}
								else {
									?>
							<textarea name="frmnotes" ID="frmnotes" Rows="5" cols="60"></textarea>
									<?php
								}
							?>
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
						<?php
						if ($fullorshort==0){
								// Display Full FiCON Information
								?>						
						<td rowspan="2" class="formheaders">
      							Condition
							</td>
						<td class="formheaders" colspan="9">
      							Mu(s)
							</td>
							<?php
						}
						?>
						</tr>
					<?php
					if ($fullorshort==0){
							// Display Full FiCON Information
							?>
					<tr>
						<td class="formheaders">
							Mu - T(1)
							</td>
						<td class="formheaders">
							Mu - T(2)
							</td>
						<td class="formheaders">
							Mu - T(3)
							</td>							
						<td class="formheaders">
							Mu - M(1)
							</td>
						<td class="formheaders">
							Mu - M(2)
							</td>
						<td class="formheaders">
							Mu - M(3)
							</td>								
						<td class="formheaders">
							Mu - R(1)
							</td>
						<td class="formheaders">
							Mu - R(2)
							</td>
						<td class="formheaders">
							Mu - R(3)
							</td>
						</tr>
						<?php
					}
					?>
					<tr>
						<td colspan="4" class="header">
							<input type="hidden" id="typeofinspection" name="typeofinspection" value="<?php echo $InspCheckList;?>">
							<?php
							// Define SQL
							$sql = "SELECT * FROM tbl_139_339_sub_c 
									INNER JOIN tbl_139_339_sub_c_f ON 139339_f_id = 139339_c_facility_cb_int					
									WHERE 139339_c_type_cb_int = '".$InspCheckList."' AND 139339_c_archived_yn = 0
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
													WHERE 139339_cc_c_cb_int =".$tmpid." AND 139339_cc_d_yn = 1 AND 139339_cc_a_yn = 0";
													
										$objcon_sub = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									
									$display_total 		= array();
									$display_totals 	= 0;
									$alterclosed 		= 0;
									$mesasge			= "";
									$checked			= "";
									$display_archived 	= "";
									$display_closed 	= "";
									$skipping			= "";
													
									
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
													
															//if($objfields_sub['139339_cc_d_yn'] == 1) {
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
																				
																			//echo "Alter Closed: ".$alterclosed."<br>";
																	}
																	
															//echo "<br>";
															//echo "NOTAM ID  |".$objfields_sub['139339_sub_n_id']."|<br>";
															//echo "Archived  |".$display_archived."|<br>";
															//echo "Closed	|".$display_closed."|<br>";
																
															//$display_totals = $display_totals + $displayrow;
															//}	
														}	// End of Sub While Loop	
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

															
												$tmpfieldname = str_replace(" ","",$objfields["139339_c_name"]);
												// This is the initial Closed Column.
												$rootname = str_replace("Closed","",$tmpfieldname);
												$rootname = str_replace("closed","",$rootname);
												//echo $rootname;
												
												switch ($objfields['139339_cc_type']) {
														case 0:
																?>
						<td class="formresults">
							<input class="Commonfieldbox" type="text" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" style="width:30px;" size="2" maxlength="2" />
							</td>
																<?php
																break;
														case 1:
																?>
							<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
								<input class="Commonfieldbox" type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" style="width:20px;" size="4" value="1"
																<?php
																
																if($objfields["139339_f_rwy_yn"] == 1) {
																		$function = "closesurface_rwy";
																	}
																	elseif($objfields["139339_f_rwy_yn"] == 3) {
																		$function = "closesurface_junk";
																	}
																	else {
																		$function = "closesurface";
																	}
																
																//echo "Alter Closed: ".$alterclosed."<br>";
																
																$runwaytype 	= $objfields['139339_f_rwy_yn'];
																//echo "Runway Type : ".$runwaytype." <br>";
																
																switch ($runwaytype) {
																		case 2:
																				// Runway Direction Test
																				$message = "<b>Runway Condtion Direction</b> This check box controls which runway direction you tested the runway from. <u>Check the box</u> for tests conducted from a runway heading <u>less than and including 18</u>. If you conducted the measurements from a runway heading <u>greater than 18</u> leave the check box <u>unchecked</u>.";
																			break;
																		case 3:
																				// Operational Notices
																				$message ="<b>Snow Removal Operations</b> If there are currently snow removal operations in effect, check this box. Leave unchecked if there are no snow operations in effect.";
																			break;
																		default:
																				// If all other tests fail
																				if($alterclosed == 1) {
																						// SURFACE IS ALREADY CLOSED, DEFAULT TO CLOSED SURFACE
																						$message = "Surface is <u><b>Closed</b></u>. If you open the surface be sure to issue a NOTAM.";
																						$checked = "CHECKED";
																					} else {
																						// SURFACE IS OPEN, DEFAULT TO OPEN SURFACE
																						$message = "Surface is <b>Open</b>. If you close it make sure you issue a NOTAM";
																						$checked = "";
																					}
																			break;
																	}
																	?>
							 <?php echo $checked;?> onclick="javascript:<?php echo $function;?>('<?php echo $rootname;?>','<?php echo $tmpfieldname;?>');" onMouseover="ddrivetip('<?php echo $message;?>')"; onMouseout="hideddrivetip()" />
																	<?php
																break;
														case 2:
																		?>
						<td class="formresults">
							<input class="Commonfieldbox" type="text" id="<?php echo $tmpfieldname;?>" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" size="20" 
								<?php
								if ($alterclosed == 1) {
										?>
										value="CLOSED" 
										<?php
									}
								?>
								 onMouseover="ddrivetip('<?php echo $message;?>')"; onMouseout="hideddrivetip()" >
								
							<INPUT TYPE="button" class="formsubmit" VALUE="Help" onClick="openchild600('part139339_c_report_help_conditions.php?fieldname=<?php echo $tmpfieldname;?>&cellvalue=temp','helpmeselectacondition')" />
							<INPUT TYPE="button" class="formsubmit" VALUE="ICAO" onClick="openmapchild('part139339_c_report_help_icao.php?fieldname=<?php echo $tmpfieldname;?>&cellvalue=temp&facility=<?php echo $tmpfacility;?>','helpmebuildicao')" />
							<?php
							// INSERT ICAO FiCON Manager Here
							// Hidden DIV Include
							//
							?>
							</td>
																<?php
																break;
														case 3:
																$message = "<b>Runway Condtion Direction</b> This check box controls which runway direction you tested the runway from. <u>Check the box</u> for tests conducted from a runway heading <u>less than and including 18</u>. If you conducted the measurements from a runway heading <u>greater than 18</u> leave the check box <u>unchecked</u>.";
																
															?>
						<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
							<input type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" value="1" style="width:20px;" size="4" onMouseover="ddrivetip('<?php echo $message;?>')"; onMouseout="hideddrivetip()" />
							</td>
																<? 
																break;
														case 4:
																$message = "<b>Runway Condtion Direction</b> This check box controls which runway direction you tested the runway from. <u>Check the box</u> for tests conducted from a runway heading <u>less than and including 18</u>. If you conducted the measurements from a runway heading <u>greater than 18</u> leave the check box <u>unchecked</u>.";
																
																?>
						<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
							<input type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" value="1" style="width:20px;" size="4" onMouseover="ddrivetip('<?php echo $message;?>')"; onMouseout="hideddrivetip()" />
							</td>
																<? 
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