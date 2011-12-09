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
//	Name of Document		:	part139327_ajax_getchecklist.php
//
//	Purpose of Page			:	Load Part 139.327 Inspection Checklist (AJAX)
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_globals.inc.php");												// Need Global Variable Information
		
// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");
	
// Define Variables	
	
		$aInspection	= "";
		$i				= 1;
		$InspCheckList 	= $_GET["InspCheckList"];
		$IntInspector 	= $_GET["Employee"];
		
// Start Procedures		
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
      					<td class="formheaders" onMouseover="ddrivetip('Category of Inspection')"; onMouseout="hideddrivetip()">
      							Facilities
							</td>
      					<td class="formheaders" onMouseover="ddrivetip('Detail to Inspect')"; onMouseout="hideddrivetip()">
      							Conditions
							</td>
      					<td class="formheaders" onMouseover="ddrivetip('Is this area clear of discrepancies?')"; onMouseout="hideddrivetip()">
      							Acceptable
							</td>
      					<td class="formheaders" onMouseover="ddrivetip('Click each area where a discrepancy exists')"; onMouseout="hideddrivetip()">
      							Discrepancy
							</td>
						
						</tr>
					<tr>
						<td colspan="4" class="header">
							<input type="hidden" id="typeofinspection" name="typeofinspection" value="<?php echo $InspCheckList;?>">
							<?php
							// Define SQL
							$sql = "SELECT * FROM tbl_139_327_sub_c 
							INNER JOIN tbl_139_327_sub_c_f ON tbl_139_327_sub_c_f.facility_id = tbl_139_327_sub_c.condition_facility_cb_int 							
							WHERE condition_type_cb_int = '".$InspCheckList."' AND condition_archived_yn = 0
							ORDER BY tbl_139_327_sub_c_f.facility_name, tbl_139_327_sub_c.condition_name";
							
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
											if($number_of_rows == 0) {
													// There are no records in this dataset
													?>
					<tr>
						<td height="28" class="formresults" colspan="4">
						Checklist is empty.
						</tr>
													<?php
												}
												else {					
													while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
															$tmpid = $objfields['conditions_id'];
															?>
					<tr>
      					<td height="28" class="formresults" onMouseover="ddrivetip('<?php echo $objfields["facility_description"];?>','yellow',300)"; onMouseout="hideddrivetip()">
      						&nbsp;
							<?php
							$tmpfacility = $objfields["condition_facility_cb_int"];
							part139327facilitycombobox($tmpfacility, "all", "notused", "hide", "all");
							$tmpvalue 	= (string) $tmpid;
							$tmpa 		= $tmpvalue."za";
							$tmpd		= $tmpvalue."zd";
							?>
							</td>
      					<td class="formresults" onMouseover="ddrivetip('<?php echo $objfields["condition_description"];?>','yellow',450)"; onMouseout="hideddrivetip()">
      						&nbsp;
							<?php echo $objfields["condition_name"];?>
							</td>
      					<td class="formresults" align="center" valign="middle" onMouseover="ddrivetip('Mark category as acceptable')"; onMouseout="hideddrivetip()">
      						<input class="commonfieldbox" type="checkbox" name="<?php echo $tmpa;?>" value="1">
							</td>
      					<td class="formresults" align="center" valign="middle" onMouseover="ddrivetip('Issue New Discrepancy')"; onMouseout="hideddrivetip()">
      						<input class="commonfieldbox" type="checkbox" name="<?php echo $tmpd;?>" value="1">
							<?php
							?>
							<INPUT class="formsubmit" TYPE="button" VALUE="ADD" onClick="openchild600('part139327_discrepancy_report_new.php?facility=<?php echo $tmpfacility;?>&condition=<?php echo $tmpid;?>&checklist=<?php echo $InspCheckList;?>','EnterNewDiscrepancy')">
							</td>
						</tr>
												<?php
														$i = $i + 1;
														}	// End of while loop
												}
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