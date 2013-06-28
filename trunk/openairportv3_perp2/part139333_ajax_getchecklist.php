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
//	Name of Document		:	part139333_ajax_getchecklist.php
//
//	Purpose of Page			:	Load Part 139.333 Inspection Checklist (AJAX)
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_globals.inc.php");												// Need Global Variable Information
		
// Load Page Specific Includes

		include("includes/_modules/part139333/part139333.list.php");
		include("includes/_template/template.list.php");
		include("includes/_template_enter.php");
	
		include("scripts/_scripts_header_iface.inc.php");
		
// Define Variables	
	
		$aInspection	= "";
		$i				= 1;
		$InspCheckList 	= $_GET["InspCheckList"];
		$IntInspector 	= $_GET["Employee"];
		$formname		= $_GET["Formname"];
		
// Start Procedures		

	// Notes:  Display Form to Enter new Part 139.333 NavAid Inspection Report.  In Part 139.327 I worked on a window you would use to add a 
	//			discrepancy before the inspection was even completed. Although this helps speed the process of adding discrepancies it adds
	//			allot of support code to detect orphaned discrepancies and I would like to avoid that. Eventually in Part 13.339 I will need
	//			a way to add parts to the whole with windows and a nice bridge to that will be Part 139.333 (this one).  The same technology 
	//			will allow the use of 'windows' that are not real windows, but just hidden divs.  Javascript will be used to hide and unhide
	//			the windows as needed. This will also clean up the interface of the main form so it is not so long and convoluted. 
	
	// Display Date and Time Fields
	?>	
<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<input type="hidden" id="typeofinspection" name="typeofinspection" value="<?=$InspCheckList;?>">
	</table>
	<?php
	// Display Topic headings
		?>
<table cellspacing="0" cellpadding="0" border="0" width="100%">		
	<tr>
		<td class="item_space_active">
				Equipment
			</td>					
		<td class="item_space_active">
		<?php
		// This is where our management DIV will be located (in the lower rows of this column).
		?>
				Manage Checklist Items
				</td>
			</tr>	
		<?php
		// Construct the SQL Statement
		$sql = "SELECT * FROM tbl_139_333_sub_c
				INNER JOIN tbl_139_333_sub_c_f	ON tbl_139_333_sub_c_f.facility_id = tbl_139_333_sub_c.condition_facility_cb_int 
				INNER JOIN tbl_inventory_sub_e	ON tbl_inventory_sub_e.equipment_id = tbl_139_333_sub_c.condition_tied_id 
				INNER JOIN tbl_139_333_sub_t	ON tbl_139_333_sub_t.inspection_type_id = tbl_139_333_sub_c.condition_type_cb_int 
				WHERE tbl_139_333_sub_t.inspection_type_id = '".$InspCheckList."' AND condition_archived_yn = 0
				ORDER BY tbl_inventory_sub_e.equipment_name, tbl_139_333_sub_c_f.facility_name, condition_name"; 
				
		//echo "[1]. The SQL Statement is :".$sql." <br>";
		//echo "[2]. Create Connection Object <br>";
		
		$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		//echo "[3]. Attempt Connection to Database <br>";		
							
		if (mysqli_connect_errno()) {
		
				//echo "[4]. Connection to Database Rejected/Unsuccessful <br>";				
		
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
			
				//echo "[5]. Connection to Database Successful <br>";		
			
				$res = mysqli_query($objcon, $sql);
				if ($res) {
						$number_of_rows = mysqli_num_rows($res);
						
						//echo "[6]. There are | ".$number_of_rows." | rows in this recordset <br>";	

						$counter 				= 0;
						$previousrunwayheading	= 0;
						$previousequipmentid	= 0;
						$equipmentarray			= array();

						while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
						
								//echo "[7]. Within the While Loop, Iteration | ".$counter." | <br>";	
								//echo "[8]. Collect some information from the Database to temporary variables <br>";	

								$tmpid 		= $objfields['conditions_id'];
								$tmpcname	= $objfields['condition_name'];
								
								$tmpequiid	= $objfields['condition_tied_id'];
								$tmpequiln	= $objfields['equipment_name'];
								$tmpequity	= $objfields['equipment_type_cb_int'];
								
								// Get Runwayway Heading from Equipment ID
								// Format of Equipment name is 	'PAPI xxby'
								// Format or 					'REIL xxby'
								// Where xx is the runway heading and y is the box number.
								
								// The MALSR does not follow this format at all, and an alternate way to sort the MALSR will need to be found
								$runwayheading = substr($tmpequiln, -4, 2);
								$equipmenttype = substr($tmpequiln, 0, 5);
								$equipmenttype = trim($equipmenttype);
								
								
								//echo " |||||".$equipmenttype."||||| <br>";
								//echo "[8b]. Runway Heading is |".$runwayheading."| <br>";	
								
								$tmpfacid	= $objfields['condition_facility_cb_int'];
								$tmpfacname = $objfields['facility_name'];
								
								$tmptypeid	= $objfields['condition_type_cb_int'];
								$tmptypeln	= $objfields['inspection_type'];
								$tmptypesn	= $objfields['inspection_type_short_name'];
								
								//echo "[9]. Checking Active Equipment Information to consulidate fields <br>";	
								
								if($previousequipmentid == 0) {
										// Nothing Displayed.
										// Display Header Line
										//echo "Equipment ID : ".$tmpequiid." <br>";
										
										$check = 2;
									}
									else {
										// Something has been displayed
										// what was it?
										if($previousequipmentid == $tmpequiid) {
												// Same equipment, Display Nothing
												$check = 1;
												
												//echo "Equipment ID : ".$tmpequiid." <br>";
											}
											else {
												// Not the same equipment
												// is it the same runway heading
												if($previousrunwayheading == $runwayheading) {
														// Same, display nothing
														$check = 1;
														//echo "Equipment ID : ".$tmpequiid." <br>";
													}
													else {
														$check = 2;
														//echo "Equipment ID : ".$tmpequiid." <br>";
													}
											}
									}
										
								if($check == 2) {
								
										//echo "[17]. Check is equal to 2, Display Management Line <br>";
										?>
		<tr>
			<td name="col_1_r<?php echo $tmpid;?>"
				id="col_1_r<?php echo $tmpid;?>"
				onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',2);" 
				onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',2);" 
				class="item_name_small_inactive"
				/>
				Runway Heading <?php echo $runwayheading;?>
				</td>		
			<td name="col_2_r<?php echo $tmpid;?>"
				id="col_2_r<?php echo $tmpid;?>"
				onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',2);" 
				onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',2);" 
				class="item_name_small_inactive"
				/>
				<?php
				// Display Open DIV button
				_tp_control_function_button_div('divform_'.$runwayheading,$en_managechecklist,'icon_window','divform_'.$runwayheading,'toggle_new','200','200');
				?>
				</td>
			</tr>
										<?php
										//echo "[18]. Now for some horribly inefficent stuff <br>";
										//echo "[19]. Locate only records for this equipment <br>";										
										//echo "[20]. Assemble the Array <br>";
										?>
		<tr>
			<td colspan="2">
				<div style="display: none;z-index:999;"; name="divform_<?php echo $runwayheading ;?>_win" id="divform_<?php echo $runwayheading ;?>_win" >
				

										<?php
										if($InspCheckList == 1) {
												// Hard Code Count!!! - EVIL
												$numberofboxes = 4;
												$helperimage 	= 'images/Part_139_333/papihelper.png';
												$arunwayheading	= array($equipmenttype,$runwayheading,$numberofboxes);
											}
										
										if($InspCheckList == 2) {
												// Hard Code Count!!! - EVIL
												$numberofboxes 	= 3;
												$helperimage	= 'images/Part_139_333/malsrhelper.gif';
												$arunwayheading	= array($equipmenttype,$runwayheading,$numberofboxes);
											}	
											
										if($InspCheckList == 3) {
												// Hard Code Count!!! - EVIL
												$numberofboxes 	= 2;
												$helperimage	= 'images/Part_139_333/reilhelper.png';
												$arunwayheading	= array($equipmenttype,$runwayheading,$numberofboxes);
											}	
											
										include("part139333_report_enter_new_blockform.php");
										?>
					</div>
				</td>
			</tr>
										<?php
											}										
											
											
											
																		

									$i 						= $i + 1;
									
									$check					= 0;
									$counter 				= $counter + 1;
									$previousrunwayheading	= $runwayheading;
									$previousequipmentid	= $tmpequiid;
												
							}	// End of while loop
							mysqli_free_result($res);
							mysqli_close($objcon);
					}	// end of Res Record Object						
			}
		?>
		</table>