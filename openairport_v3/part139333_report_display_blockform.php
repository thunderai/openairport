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
//	Name of Document		:	part139333_report_enter_new.php
//
//	Purpose of Page			:	Enter New Part139.333 Protection of Navaid Inspection
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// PURPOSE:  ha...
?>
<table border="0" style="border-collapse:collapse;">
<?php
//	$numberofboxes - Number to Cycle				

for ($j=0; $j<$numberofboxes; $j=$j+1) {

		$number = $j+1;
		$name = $arunwayheading[0]." ".$arunwayheading[1]."b".$number ."";

		$sql3 = "SELECT * FROM tbl_139_333_sub_c
				INNER JOIN tbl_139_333_sub_c_f	ON tbl_139_333_sub_c_f.facility_id = tbl_139_333_sub_c.condition_facility_cb_int 
				INNER JOIN tbl_inventory_sub_e	ON tbl_inventory_sub_e.equipment_id = tbl_139_333_sub_c.condition_tied_id 
				INNER JOIN tbl_139_333_sub_t	ON tbl_139_333_sub_t.inspection_type_id = tbl_139_333_sub_c.condition_type_cb_int 
				WHERE tbl_inventory_sub_e.equipment_name = '".$name."' AND condition_archived_yn = 0
				ORDER BY tbl_inventory_sub_e.equipment_name, tbl_139_333_sub_c_f.facility_name, condition_name"; 
				
		$objcon3 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		if (mysqli_connect_errno()) {
		
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
			
				$res3 = mysqli_query($objcon3, $sql3);
				if ($res3) {
						$number_of_rows = mysqli_num_rows($res3);
						
						//echo "[6]. There are | ".$number_of_rows." | rows in this recordset <br>";	

						$counter 				= 0;
						$previousequipmentid	= 0;
						?>
		<td align="left" valign="top">
			<table border="1" style="border-collapse:collapse;" width="100%">
						<?php
						
						while ($objfields3 = mysqli_fetch_array($res3, MYSQLI_ASSOC)) {
						
								$tmpid2 		= $objfields3['conditions_id'];
								$tmpcname2		= $objfields3['condition_name'];
								
								//$aspecs			= part139333_get_specifications($tmpid2);
								
								//echo 	$aspecs[0];
								
								
								$tmpequiid2		= $objfields3['condition_tied_id'];
								$tmpequiln2		= $objfields3['equipment_name'];
								$tmpequil_lat	= $objfields3['equipment_lat'];
								$tmpequil_long	= $objfields3['equipment_long'];
								
								//echo 	"Condition ID ".$tmpid2." / Equipment ID :".$tmpequiid2." <br>";
								
								// Convert GPS into Screen Coordinates
								
								//echo "Location X: ".$tmpequilx.", Location Y: ".$tmpequily." <br>";
								
								if($tmpequil_lat == '' OR $tmpequil_long == '') {
										$screenx		= 0;
										$screeny		= 0;
									}
									else {
										$screenx		= round( ( (-$tmpequil_long - $long0) / $delta_x),0);
										$screeny		= round( ( ($tmpequil_lat - $lat0) / $delta_y), 0);
										
										//echo "Location X: ".$screenx.", Location Y: ".$screeny." <br>";
									}
							
								//echo 	"Equipment ID ".$tmpequiid2." <br>";
								
								// Such a Flipping Ugly Mess
								
															
								// Get Runwayway Heading from Equipment ID
								// Format of Equipment name is 'PAPI xxby'
								// Where xx is the runway heading and y is the box number.
								$runwayheading2 = substr($tmpequiln,5, 2);
								
								//echo "[8b]. Runway Heading is | ".$runwayheading." | <br>";	
								
								$tmpfacid2		= $objfields3['condition_facility_cb_int'];
								$tmpfacname2 	= $objfields3['facility_name'];
								
								$tmptypeid2		= $objfields3['condition_type_cb_int'];
								$tmptypeln2		= $objfields3['inspection_type'];
								$tmptypesn2		= $objfields3['inspection_type_short_name'];					
						
								//echo "[20]. Looping within the Sub Blockform <br>";
								//echo "[21]. All Equipment Names will be the same here, What seperatesis the condiction checklist <br>";
							
								// Create Field Names
								
								$fieldname = $tmpid2."_";
								
								$basicvalue = getccvalue($tmpid2,$inspection_id);
								
								//echo "Basic Value is ".$basicvalue." <br>";
													
								if($objfields3['facility_id'] == 1 OR $objfields3['facility_id'] == 5) {
										// This is a complex result that needs to be split into parts
										$resultstring = explode('/',$basicvalue);
										//echo "here I am";
										//echo $display = "Inital Angle :".$resultstring[0]." Specification was :".$resultstring[1]." Tollerance is :".$resultstring[2]." Corrected Angle was: ".$resultstring[3]."";
									}
									else {
										//$display = gs_conditions($basicvalue, "no", $fieldname.'cb', 'hide', $basicvalue,1);
										//echo "display ".$display;
									}
							
							
							
								if($previousequipmentid == $tmpequiid2) {
										// Nothing Displayed
										$displayrow = 1;
									}
									else {
										// Not equal to, end and begin a nbew table
										?>
					<tr>
						<td align="center" valign="middle" colspan="5" width="180" bgcolor="#CoCoCo">
							<?php echo $tmpequiln2;?>
							</td>
						</tr>
					<tr>
						<td align="center" valign="middle" bgcolor="#e9e7e7">
							Fac
							</td>
						<td align="center" valign="middle" bgcolor="#e1dfdf" width="33" height="25">
							I:
							</td>	
						<td align="center" valign="middle" bgcolor="#e1dfdf" width="33" height="25">
							S:
							</td>
						<td align="center" valign="middle" bgcolor="#e1dfdf" width="33" height="25">
							E:
							</td>
						<td align="center" valign="middle" bgcolor="#e1dfdf" width="33" height="25">
							C:
							</td>							
						</tr>						
										<?php
										$displayrow = 1;
									}								
								
								if($displayrow == 1) {
										?>
					<tr>
						<td bgcolor="#e9e7e7">
							<?php echo $tmpfacname2;?>
							</td>
										<?php
										if($tmpfacid2 == 1 OR $tmpfacid2 == 5) {
												
												// Need to get any proper specifications for this condition/facility mix.
												// to do
												
												?>					
						<td align="right">
							<?php echo $resultstring[0];?>
							</td>
						<td align="right">
							<?php echo $resultstring[1];?>
							</td>
						<td align="right">
							<?php echo $resultstring[2];?>
							</td>
						<td align="right">
							<?php echo $resultstring[3];?>
							</td>
												<?php
											}
											else {
											?>
						<td colspan="4">
											<?php
												gs_conditions_js($basicvalue, "no", $fieldname.'cb', "hide", $basicvalue,1,$fieldname.'cb');
											}
	// Add Discrepancy button to push this discrepancy into the discrepancy monitor system.
	// There are two ways to do this.  1). a special discrepancy system jut for NAVAid inspections, or
	//	2). the 327 discrepancy tables.  The perfered method would be to inject it into the Part327 tables.
	//	Doing this can be done two ways. Injection right into the main tables or placing it into the temporary tables to be grabed by an inspection latter.
	//	The best way probably is to place it into temporary tables, but this means the discrepancy will not be grabbed until the next inspection which could be a day away.
	//	The better approach is to get it out as soon as possible which means injection right into the main table. The problem there is that without
	//	an inspection ID the discrepancy will not inject wityh a failed forign reference key.  Falsing the key will place the discrepancy with some unknown inspection.
	//	It is overkill to make a special discrepancy monitor for NAVAids and probably not ideal either. The discrepancy monitor could be tought to find
	//	special navaid inspection discrepancies and list them with the other discrepancies. all forms would need to know that the ID isn't an inspection but a navaid inspection...
	//	that could be tricky and CPU costs. Not to mention a rewrite of many discrepancy functions. the impact can't be fully known and how do you tell the system where the discrepancy came from?
	//	toggels in the DB?  a combobx int field slaved to a DB link?  cross linking like that would make indexing discrepancies impossible. The entire discreancy system assumes they only come from Part 327 inspections.
	//	For all of the reasons above, it is much cleaner to place the discrepancy in the temporary table to be grabbed by the next inspection that comes along. 
	//	OR!  We automatically inject an inspection by a given type (Periodic Condition Evaluation Checklist).  That will not be easy programmingly wise, but it is much cleaner and professional.
	//	The steps would be very much like how Part 327 inspections are entered now.  But in this case, we lie to the discrepancy maker on what condition and facility we are talking about.
	//	Facility ID: 5 is NavAids
	//	Would need to make condition lists for the Periodic Condition Evaluations Checklist.
	//	Will also need to know which discrepancies where created by this form to link to the Perodic inspection.
	// 	if they get grabed before we grab them no loss I suppose.  WE will just flag the discrepancy as NAVAID in 'discrepancy_madebynavaid' to 1.
	//	Discrepancy will default to Facility 5:NavAids, Condition 46: REIL/PAPI on Periodic Inspections				
	// 	It will be moved into proper position when this form is submitted
	
	//  Create Discrepancy Name...								Equipment Name Facility Name
											$discrepancyname = $tmpequiln2." ".$tmpfacname2." Requires Action";
											$discrepancycomm = "Unit has been checked and found to be out of specification and requires maintenance";
											?>
							</td>						
						</tr>
											<?php
									}
									
								$previousequipmentid	= $tmpequiid2;
							}

							?>
							</table>
							</td>
							<?php
							
							
					}
			}
			?>
	<?php
			
	}
	?>
		</tr>
	</table>