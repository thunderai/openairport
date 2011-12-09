<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	ajax_part139339_data_entry.php		The purpose of this page is to provide the inspection data entry page the checklist needed to complete the form.
	
								Usage:
								Dont unless you know what you want with it.
								
								
						
						
	Provide new information for each of the items below until you reach the Do not change below this line comment.
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/

	// Load Required Include Files
	
		//include("includes/header.php");																	// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		//include("includes/POSTs.php");																	// This include pulls information from the $_POST['']; variable array for use on this page
		//include("includes/NavFunctions.php");																// already included in header.php
		//include("includes/UserFunctions.php");																// already included in header.php
		include("includes/FormFunctions.php");														// already included in header.php
		
		
		// 0 Mu
		// 1 Checkbox
		// 2 Condition
		
	$aInspection		= "";
	$i				= 1;
	$current_facility	= "";
	$previous_facility	= "";
	$tmpfieldname		= "";
	$fullorshort		= 0;

	$InspCheckList 		= $_GET["InspCheckList"];
	$IntInspector 		= $_GET["Employee"];
	$fullorshort 		= $_GET["fullorshort"];
?>
			<center>
				<table cellspacing="3" cellpadding="5" width="100%">
					<?
					if ($fullorshort==0){
							// Display Full FiCON Information
							?>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Select from the list')"; onMouseout="hideddrivetip()">
							FiCON Template
							</td>
						<td align="center" valign="middle" class="formoptions">
							<?
							//part139339templatescombobox_ajax("all", "all", "InspTemplate", "show", "");
							?>
							</td>
						</tr>
						<td colspan="2" align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('This is the purpose of this template')"; onMouseout="hideddrivetip()">
							Templates are unavailable at this time. Please complete the form manual from the Gress Marker inspection paperwork you had when on the field.  Enter the condition in as much detail as applicable and ensure accurate Mu readings are entered into the appropriate boxes. If you have any questions on how to enter this information please talk with your manager.
							</td>
						</tr>
							<?
						}
					?>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
							Metar
							</td>
						<td class="formanswers">
							<?
							$tmpstring = readweathertxt("null");
							?>		
							<input type="hidden" name="frmmetar" 				value="<? readweathertxt("null");?>">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
							Date
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" type="text" name="frmdate" size="10" value="<?echo date('m/d/Y');?>" onchange="javascript:(isdate(this.form.frmstartdate.value,'mm/dd/yyyy'))">
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
							Time
							</td>
						<td class="formanswers">
							<input class="commonfieldbox" type="text" name="frmtime" size="10" value="<?echo date("H:i:s");?>">
							</td>
						</tr>
						<?
							if ($fullorshort==0){
									// Display Full FiCON Information
									?>
									<?
								}
								else {
									?>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('Please enter the date this notam will be canceled automatically. Leave blank if NOTAM will not be closed automatically.(mm/dd/yyyy)')"; onMouseout="hideddrivetip()">
							Cancel Action
							</td>
						<td class="formanswers">
							Combobox displaying a list of NOTAMs which have not been cancelled
							</td>
						</tr>
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
									<?
								}
							?>
					<tr>
						<td align="center" valign="middle" class="formoptions" onMouseover="ddrivetip('24 Hour Time')"; onMouseout="hideddrivetip()">
							Notes
							</td>
						<td class="formanswers">
							<?
							if ($fullorshort==0){
									// Display Full FiCON Information
									?>
							<textarea name="frmnotes" Rows="5" cols="60">Mu readings taken with a Vericom 3000 RFM unit<br>Check Local NOTAMs</textarea>
									<?
								}
								else {
									?>
							<textarea name="frmnotes" Rows="5" cols="60"></textarea>
									<?
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
						<?
						if ($fullorshort==0){
								// Display Full FiCON Information
								?>						
						<td rowspan="2" class="formheaders">
      							Condition
							</td>
						<td class="formheaders" colspan="9">
      							Mu(s)
							</td>
							<?
						}
						?>
						</tr>
					<?
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
						<?
					}
					?>
					<tr>
						<td colspan="4" class="header">
							<input type="hidden" id="typeofinspection" name="typeofinspection" value="<?=$InspCheckList;?>">
							<?
							// Define SQL
							$sql = "SELECT * FROM tbl_139_339_sub_c 
									INNER JOIN tbl_139_339_sub_c_f ON 139339_f_id = 139339_c_facility_cb_int					
									WHERE 139339_c_type_cb_int = '".$InspCheckList."' AND 139339_c_archived_yn = 0
									ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
							
							//echo $sql;
							
							// Establish a Conneciton with the Database
							$objcon = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
							
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
													$tmpid 			= $objfields['139339_c_id'];
													$current_facility 	= $objfields['139339_c_facility_cb_int'];
													if ($current_facility!=$previous_facility) {
															//Row data has the same facility
															?>
						</tr>	
														
					<tr>
      					<td height="28" class="formresults">
      						&nbsp;
							<? 
							$tmpfacility = $objfields["139339_c_facility_cb_int"];
							part139339facilitycombobox($tmpfacility, "all", "notused", "hide", "all");
							$tmpvalue 	= (string) $tmpid;
							$tmpa 	= $tmpvalue."za";
							$tmpd		= $tmpvalue."zd";
							?>
							</td>
															<?
															}
															?>
															<?
												$tmpfieldname = str_replace(" ","",$objfields["139339_c_name"]);
												
												switch ($objfields['139339_cc_type']) {
														case 0:
																if ($fullorshort==0){
																		// Display Full FiCON Information
																		?>
						<td class="formresults">
							<input class="Commonfieldbox" type="text" name="<?=$tmpfieldname;?>" size="5">
							</td>
																		<?
																	}
																break;
														case 1:
																?>
						<td class="formresults" id="<?=$tmpfieldname;?>_td" name="<?=$tmpfieldname;?>_td">
							<input class="Commonfieldbox" type="checkbox" name="<?=$tmpfieldname;?>" value="1">
							</td>
																<? 
																break;
														case 2:
																if ($fullorshort==0){
																		// Display Full FiCON Information
																		?>
						<td class="formresults">
							<input class="Commonfieldbox" type="text" name="<?=$tmpfieldname;?>" size="15">
							</td>
																		<?
																	}
																break;
														case 3:
																?>
						<td class="formresults" id="<?=$tmpfieldname;?>_td" name="<?=$tmpfieldname;?>_td">
							<input class="Commonfieldbox" type="checkbox" name="<?=$tmpfieldname;?>" value="1">
							</td>
																<? 
																break;
														case 4:
																?>
						<td class="formresults" id="<?=$tmpfieldname;?>_td" name="<?=$tmpfieldname;?>_td">
							<input class="Commonfieldbox" type="checkbox" name="<?=$tmpfieldname;?>" value="1">
							</td>
																<? 
																break;
													}
												$previous_facility	= $objfields['139339_c_facility_cb_int'];
												$i 				= $i + 1;
												}	// End of while loop
												mysqli_free_result($res);
												mysqli_close($objcon);
										}	// end of Res Record Object						
								}
								?>
					</table>
