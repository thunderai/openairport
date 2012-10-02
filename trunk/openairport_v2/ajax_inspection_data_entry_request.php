<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	ajax_inspection_data_entry.php		The purpose of this page is to provide the inspection data entry page the checklist needed to complete the form.
	
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
		
		
	$aInspection	= "";
	$i				= 1;

	$InspCheckList 	= $_GET["InspCheckList"];
	$IntInspector 	= $_GET["Employee"];
?>
			<center>
				<table cellspacing="3" cellpadding="5" width="100%">
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
					</table>
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
      					<td class="formheaders">
      							Facilities
							</td>
      					<td class="formheaders">
      							Conditions
							</td>
      					<td class="formheaders">
      							Acceptable
							</td>
      					<td class="formheaders">
      							Discrepancy
							</td>
						</tr>
					<tr>
						<td colspan="4" class="header">
							<input type="hidden" id="typeofinspection" name="typeofinspection" value="<?=$InspCheckList;?>">
							<?
							// Define SQL
							$sql = "SELECT * FROM tbl_139_327_sub_c WHERE condition_type_cb_int = '".$InspCheckList."' AND condition_archived_yn = 0";
							
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
													$tmpid = $objfields['conditions_id'];
													?>
					<tr>
      					<td height="28" class="formresults">
      						&nbsp;
							<? 
							$tmpfacility = $objfields["condition_facility_cb_int"];
							part139327facilitycombobox($tmpfacility, "all", "notused", "hide", "all");
							$tmpvalue 	= (string) $tmpid;
							$tmpa 		= $tmpvalue."za";
							$tmpd		= $tmpvalue."zd";
							?>
							</td>
      					<td class="formresults">
      						&nbsp;
							<?=$objfields["condition_name"];?>
							</td>
      					<td class="formresults" align="center" valign="middle">
      						<input class="commonfieldbox" type="checkbox" name="<?=$tmpa;?>" value="1">
							</td>
      					<td class="formresults" align="center" valign="middle">
      						<input class="commonfieldbox" type="checkbox" name="<?=$tmpd;?>" value="1">
							</td>
						</tr>
												<?
												$i = $i + 1;
												}	// End of while loop
												mysqli_free_result($res);
												mysqli_close($objcon);
										}	// end of Res Record Object						
								}
								?>
					<tr>
						<td colspan="4" align="right">
							&nbsp;
							</td>
						</tr>
					<tr>
						<td height="32" colspan="4" class="formoptionsavilablebottom" valign="middle">
							<input class="formsubmit" type="button" name="button" value="submit" onclick="javascript:document.entryform.submit()">&nbsp;
							</td>
						</tr>
					</table>
