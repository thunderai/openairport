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
													WHERE 139339_cc_c_cb_int =".$tmpid."";
													
										$objcon_sub = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

									
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
													
															
															//$displayrow			= preflight_tbl_139339_sub_n_a($objfields_sub['139339_sub_n_id'],0);	
															//echo "Display Archived ".$displayrow."<br>";														
															//$display_archived	= $displayrow;
															//$displayrow			= preflight_tbl_139339_sub_n_r($objfields_sub['139339_sub_n_id'],0);
															//echo "Display Closed ".$displayrow."<br>";
															//$display_closed		= $displayrow;
															
														//	echo "<br>";
														//	echo "NOTAM ID  |".$objfields_sub['139339_sub_n_id']."|<br>";
														//	echo "Archived  |".$display_archived."|<br>";
														//	echo "Closed	|".$display_closed."|<br>";
															
															if ($display_archived==1) {
																	if ($display_closed==1) {
																			// NOTAM IS ACTIVE
																			$tmp_is_closed = 1;
																		}
																}	// End of test to determine if the notam is active
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
															?>
															<?php
												$tmpfieldname = str_replace(" ","",$objfields["139339_c_name"]);
												
												switch ($objfields['139339_cc_type']) {
														case 0:
																if ($fullorshort==0){
																		// Display Full FiCON Information
																		?>
						<td class="formresults">
							<input class="Commonfieldbox" type="text" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" style="width:30px;" size="2" maxlength="2" />
							</td>
																		<?php
																	}
																break;
														case 1:
																// This is the initial Closed Column.
														
																if ($tmp_is_closed==1) {							
																		?>
						<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
							<input class="Commonfieldbox" type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" value="1" CHECKED onMouseover="ddrivetip('Surface is <b>CLOSED</b><br>If you open it, Do the paperwork!')"; onMouseout="hideddrivetip()" style="width:20px;" size="4" />
							</td>
																		<?php
																	}
																	else {
																		?>
						<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
							<input class="Commonfieldbox" type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" value="1" onMouseover="ddrivetip('Surface is <b>OPEN</b><br>If you close it, Do the paperwork!')"; onMouseout="hideddrivetip()" style="width:20px;" size="4" />
							<!--onClick="window.open('part139339_sub_n_main_entry.php','NewNOTAM','width=600,height=600,toolbar=no, location=no,directories=no,status=no,menubar=no,scrollbars=no,copyhistory=no,resizable=yes')">-->
							</td>
																		<?php
																	}
																break;
														case 2:
																if ($fullorshort==0){
																		// Display Full FiCON Information
																		?>
						<td class="formresults">
							<input class="Commonfieldbox" type="text" id="<?php echo $tmpfieldname;?>" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" size="20" 
								<?php
								if ($tmp_is_closed==1) {
										?>
										value="CLOSED" 
										<?php
									}
								?>
								>
								
							<INPUT TYPE="button" class="formsubmit" VALUE="Help" onClick="openchild600('part139339_c_report_help_conditions.php?fieldname=<?php echo $tmpfieldname;?>&cellvalue=temp','helpmeselectacondition')" />
							<INPUT TYPE="button" class="formsubmit" VALUE="ICAO" onClick="openmapchild('part139339_c_report_help_icao.php?fieldname=<?php echo $tmpfieldname;?>&cellvalue=temp&facility=<?php echo $tmpfacility;?>','helpmebuildicao')" />
							<?php
							// INSERT ICAO FiCON Manager Here
							// Hidden DIV Include
							//
							?>
							</td>
																		<?php
																	}
																break;
														case 3:
																?>
						<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
							<input type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" value="1" style="width:20px;" size="4" />
							</td>
																<? 
																break;
														case 4:
																?>
						<td class="formresults" id="<?php echo $tmpfieldname;?>_td" name="<?php echo $tmpfieldname;?>_td">
							<input type="checkbox" name="<?php echo $tmpfieldname;?>" ID="<?php echo $tmpfieldname;?>" value="1" style="width:20px;" size="4" />
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