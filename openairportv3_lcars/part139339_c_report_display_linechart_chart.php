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
//	Name of Document		:	part139339_c_report_display_linechart_chart.php
//
//	Purpose of Page			:	View Part 139.339 (c) Friction Linechart
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	
?>
<HTML>
	<HEAD>
		<TITLE>
			Open Airport - Airport Safety Self-Inspection Report (Printer Friendly)
			</TITLE>
<?php
// Load global include files
	
		//include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes
		include("includes/_dateandtime/dateandtime.list.php");
		include("scripts/_scripts_header_iface.inc.php");
		//include("includes/AutoEntryFunctions.php");
		include("includes/_systemusers/systemusers.list.php");
		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_navigation/navigation.list.php");
		include("includes/_generalsettings/generalsettings.list.php");					// Load GIS Functions
		include("includes/_template/template.list.php");
		//include("includes/_generalsettings/generalsettings.list.php");					// Load GIS Functions
		
		?>
		<link href="stylesheets/reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY>
	

		
<?php

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		// Navigation Page ID
		//		Enter the ID of the Navigation Module this page belongs to.
		//		Check the AutoEntry function for more details...
		$navigation_page 			= 40;
		// Page Type ID
		//		Enter the ID of the Event type for this page.
		//		Check the AutoEntry function for more details...
		$type_page 					= 12;							// Page is Type ID, see function for notes!
		// Other Settings for AutoEntry
		//		You should not need to change these values.
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions

// Define Variables	

		/* 					<input type="hidden" NAME="getsd" 			ID="getsd" 			value="<?php echo $start_date;?>">
							<input type="hidden" NAME="geted" 			ID="geted" 			value="<?php echo $end_date;?>"> */
	//form_new_control("frmstartdate"		,"Date"						, "Enter the the date to start from","The current date has automatically been provided!"	,"(mm/dd/yyyy)"		,1			,10				,0				,"current"				,0);
	//form_new_control("frmenddate"		,"Date"						, "Enter the the date to end at"	,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"		,1			,10				,0				,"current"				,0);
	//form_new_control("wlhmspecies"		,"TimePeriod"				, "Select a Time Period"			,"Select a time period from the list provided!"			,""					,3			,50				,0				,"all"					,"part139339typescomboboxwall");
	//form_new_control("wlhmactivity"		,"Surface"					, "Select a Surface"				,"Select a surface from the list provided!"				,""					,3			,35				,4				,"all"					,"part139339_c_facilitycomboboxwall");
	//form_new_control("wlhmaction"		,"Action"					, "Select an Action"				,"Select an action from the list provided!"				,""					,3			,35				,4				,"all"					,"part139337_combobox_actiontakenwall");
	//form_new_control("disusebrowser"	,"Use Above Settings"		, "Use Browser Settings or override"	,"Checking this box will use the dates above, unchecked will use the dates from the browser form"		,""				,5						,50				,0				,"all"					,0);


	//Get Information from the FORM
		$tmpstartdate 	= $_POST['frmstartdate'];
		$tmpenddate 	= $_POST['frmenddate'];
		$tmpstartdate2 	= $_POST['frmstartdateo'];
		$tmpenddate2	= $_POST['frmenddateo'];		
		$tmpspecies 	= $_POST['wlhmspecies'];
		$tmpactivity 	= $_POST['wlhmactivity'];
		$tmpaction		= $_POST['wlhmaction'];
		
		$displayspecies_id 	= $_POST['wlhmspecies'];
		$displayactivity_id = $_POST['wlhmactivity'];
		$displayaction_id 	= $_POST['wlhmaction'];

		
	// Convert start date and end date into sql format
	
		$tmpsqlstartdate	= amerdate2sqldatetime($tmpstartdate );
		$tmpsqlenddate		= amerdate2sqldatetime($tmpenddate );
		$tmpsqlstartdate2	= amerdate2sqldatetime($tmpstartdate2 );
		$tmpsqlenddate2		= amerdate2sqldatetime($tmpenddate2 );

		$notlimited_p1 = 0;
		$notlimited_p1 = 0;
		$notlimited_p1 = 0;
		
		
		
		$OffSetX 		= -20;
		$OffSetY 		= 70;
		$tmpzindex		= 14;
		
		$isarchived			= "";
		$isduplicate		= "";
		$displaydatarow		= "";
		$displaydiscrepancy = "";
		
		$i					= "";
		
		$discrepancybouncedid 		= "";
		$discrepancybounceddate 	= "";
		$discrepancybouncedtime 	= "";
		$discrepancyrepairid 		= "";
		$discrepancyrepairdate 		= "";
		$discrepancyrepairtime 		= "";
		$isduplicate				= "";
		$isarchived					= "";
		$displaydatarow				= "";
		$displaydiscrepancy 		= "";
		$rwy_loop_count				= 0;
		$tmp_rwy_mu					= 0;
		$previous_rwy_loop			= "";
		$current_rwy_loop			= "";
		$inner_rwy_loop				= 0;
		
		$tmp_runwayort_12			= -1;
		$tmp_runwayort_17			= -1;
		
		// Placement Maps
		$offset_x						= 1;
		$offset_y						= 90;						

	// Build Datatables and Location Arrays
		$brakingactiongood		= 40;
		$brakingactiongoodcolor 	= "#00FF00";
		$brakingactiongoodtxtcolor	= "#000000";

		$brakingactionfair		= 30;
		$brakingactionfaircolor 	= "#FFFF00";
		$brakingactionfairtxtcolor	= "#000000";
		
		$brakingactionpoor		= 21;
		$brakingactionpoorcolor 	= "#FF0000";
		$brakingactionpoortxtcolor	= "#FFFFFF";
		
		$brakingactionnill		= 20;
		$brakingactionnillcolor 	= "#000000";
		$brakingactionnilltxtcolor	= "#FFFFFF";
		
		$abrakingaction	= array($brakingactiongood,$brakingactiongoodcolor,$brakingactiongoodtxtcolor,$brakingactionfair,$brakingactionfaircolor,$brakingactionfairtxtcolor,$brakingactionpoor,$brakingactionpoorcolor,$brakingactionpoortxtcolor,$brakingactionnill,$brakingactionnillcolor,$brakingactionnilltxtcolor);
	
	// Build Surface X,Y Cords....
	$a17_x	= array(460,462,463,465,467,469,471,473,475);
	$a17_y	= array(260,313,366,419,472,525,578,631,684);									
	$a12_x	= array(160,205,250,295,340,385,430,474,519);
	$a12_y	= array(255,283,312,340,367,395,423,450,478);	
		
	// Determine which Date Grouping we are using
		
		$tmptime = date('H:m:s');
		$tmpdate = date('Y/m/d');
		
		if($_POST['disusebrowser'] == '1') {
				$use_start_date = $tmpsqlstartdate;
				$use_end_date 	= $tmpsqlenddate;
			}
			else {
				$use_start_date = $tmpsqlstartdate2;
				$use_end_date 	= $tmpsqlenddate2;			
			}
		if($_POST['ficon_40'] == '1') {
				$include_40		= 1;
			}
			else {
				$include_40		= 0;			
			}
		if($_POST['ficon_none'] == '1') {
				$include_0		= 1;
			}
			else {
				$include_0		= 0;			
			}			

			
		//					Filed Name / Variable				b	f	h	j		w		x		y	z
		//displaytxtonreport($objarray['Discrepancy_id'], 		1, 1, 30, "right", 	30, 	690, 	0, 	3); <-- Don't need this
		//displaytxtonreport("Wildlife Report Locations", 		1, 5, 30, "center", 713, 	0, 		0, 	4);	
		///displaytxtonreport("DATE", 								1, 3, 13, "left", 	190, 	5, 		32, 5);	
		//displaytxtonreport($tmpdate, 							1, 3, 13, "left", 	190, 	95, 	32, 6);	
		//displaytxtonreport("START DATE",	 					1, 3, 13, "left", 	190, 	290, 	32, 7);		
		//displaytxtonreport($use_start_date,						1, 3, 13, "left", 	190, 	395, 	32, 8);		
		//displaytxtonreport("TIME",								1, 3, 13, "left", 	190, 	5, 		52, 9);		
		//displaytxtonreport($tmptime,							1, 3, 13, "left", 	30, 	95, 	52, 10);	
		//displaytxtonreport("END DATE",							1, 3, 13, "left", 	190, 	290, 	52, 11);
		//displaytxtonreport($use_end_date,						1, 3, 13, "left", 	190, 	395, 	52, 8);		
		
		$displayspecies_id 	= $_POST['wlhmspecies'];
		$displayactivity_id = $_POST['wlhmactivity'];
		$displayaction_id 	= $_POST['wlhmaction'];
										
										
		if($displayspecies_id == 'all') {
				// User has selected to display all animals
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_s 		= "AND tbl_139_339_sub_t.139339_type_id = '".$displayspecies_id."' ";
			}
	
		// Create SQL Statement
		// Define SQL
		$tmp_runwayort_12			= -1;
		$tmp_runwayort_17			= -1;

		if($displayactivity_id == 'all') {
				// The user wants all of these reports.
				// Give them all of them, but lets loop through them, cause the other way isnt working
				
				$sql2 = "SELECT * FROM tbl_139_339_sub_c_f	
						WHERE 139339_f_rwy_yn = 1 OR 139339_f_rwy_yn = 0 
				
						ORDER BY 139339_f_name";
				
				$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

				if (mysqli_connect_errno()) {
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
				}
				else {
						$res2 = mysqli_query($objcon2, $sql2);
						if ($res2) {
								$number_of_rows2 = mysqli_num_rows($res2);
								//echo $number_of_rows2;
								//printf("result set has %d rows. \n", $number_of_rows2);
								
								//echo "<br>-----------------------------<br>";

								while ($objfields2 = mysqli_fetch_array($res2, MYSQLI_ASSOC)) {
				
										$facility_id			= $objfields2['139339_f_id'];
		
		
										include("part139339_c_report_display_linechart_chart_shameful.php");
										
								}
						}
				}
		}
		else {
			
			$facility_id = $displayactivity_id;
			
			include("part139339_c_report_display_linechart_chart_shameful.php");
		}

		function drawarunway($array_of_mu,$array_of_settings,$array_of_addedinfo,$array_of_dates,$array_of_times,$array_of_mains) {
			
			$emptyshell 	= empty($array_of_mu);
			
			if($emptyshell == 1) {
					// Thre is nothing here to show anyone
					echo "<br> There is NO Runway Data to Display that meets your search criteria <br>";

			}
			else {
			
					// External Loop is 0 - 8
					// Internal Loop is 0 - whatever it is
			
					//$muarray_s[0]								= $facility_id;
					//$muarray_d[$external_loop][$interal_loop]	= $objfields['139339_date'];
					//$muarray_t[$external_loop][$interal_loop]	= $objfields['139339_time'];
					//$muarray_i[$external_loop][$interal_loop]	= $objfields['139339_main_id'];
					
					//$isrunway[$external_loop][$interal_loop] 	= $checklist_item_disc;
					
					//echo "Begin Draw Runway Image Function <br>";
					//echo "Establish Array Looping Procedure <br>";
					
					//echo "Run through array loop building math stuff <br>";
					
					$facility_id		= $array_of_addedinfo[0];
					$chart_height		= ( 60 * $array_of_settings[2] );
					$chart_width		= ( 9 + 2 );	

					$internal_counter	= 0;
					$external_counter 	= 0;		
					
					?>
				<table width="757" class="formheaders" />
					<tr>
						<td colspan="<?php echo $chart_width;?>" align="left" class="formoptions">
							<?php
							$facility_name = part139339_c_facilitycombobox($facility_id, "all", "notused", "hide", "all");
							?>
							Cross Section Bar Chart
							</td>
						</tr>
					<tr>
						<td colspan="<?php echo $chart_width;?>" align="left" class="formanswers">
							The chart below is a cross-section display of the runway 
							</td>
						</tr>	
				<tr>
					<td colspan="2" class="formheaders">
						Controls
						</td>
					<td colspan="3" class="formheaders">
						Touchdown
						</td>
					<td colspan="3" class="formheaders">
						MidPoint
						</td>
					<td colspan="3" class="formheaders">
						Rollout
						</td>
					</tr>
				<tr>
					<td colspan="2" align="right" valign="bottom">
						<table border="0" cellpadding="0" cellspacing="0" />
							<tr>
								<td class="formanswers" />
									Color Code: <br><br>
									Green: Max to Average. <br><br>
									Organge: Average to Min. <br><br>
									Black: Min to 0. <br><br>
									</td>
								</tr>						
							<tr>
								<td class="formresults" />
									Max
									</td>
								</tr>					
							<tr>
								<td class="formresults" />
									Average
									</td>
								</tr>	
							<tr>
								<td class="formresults" />
									Min
									</td>
								</tr>
							</table>
						</td>

					
				
				<?php
					
					
					for ($j=0; $j<9; $j=$j+1) {
						

						?>
					<td align="left" valign="bottom" />
						<?php
						
							$max	= 0;
							$min	= 0;
							$total	= 0;
							// External Loop
							// This is actually the Condition not the mu
							//echo "<br> First Loop ".$j." <br>";
							
							$second_level = count($array_of_mu[$j]);
							
							$max		= max($array_of_mu[$j]);
							$min		= min($array_of_mu[$j]);
							$total		= array_sum($array_of_mu[$j]);	
							$average	= round(($total/$second_level),2);

							
							$image_t1	= ($max - $average) * $array_of_settings[3];
							$imahe_t2	= ($average - $min) * $array_of_settings[3]; 
							$image_t3	= ($min - 0) * $array_of_settings[3];
							
							
							
							?>
					<table border="0" cellpadding="0" cellspacing="0" />
						<tr>
							<td>
								<?php
								$max_tip = "Max Point: ".$max." ";
								?>
								<img src="images/part_139_339/barchart_06.png" height="<?php echo $image_t1;?>" width="55" onMouseover="ddrivetip('<?php echo $max_tip;?>')"; onMouseout="hideddrivetip()"/>
								</td>
							</tr>
						<tr>
							<td>
								<?php
								$average_tip = "Average Point: ".$average." ";
								?>
								<img src="images/part_139_339/barchart_05.png" height="<?php echo $image_t2;?>" width="55" onMouseover="ddrivetip('<?php echo $average_tip;?>')"; onMouseout="hideddrivetip()"/>
								</td>
							</tr>
						<tr>
							<td>
								<?php
								$min_tip = "Min Point: ".$min." ";
								?>					
								<img src="images/part_139_339/barchart_04.png" height="<?php echo $image_t3;?>" width="55" onMouseover="ddrivetip('<?php echo $min_tip;?>')"; onMouseout="hideddrivetip()"/>
								</td>
							</tr>
						<tr>
							<td class="formresults" />
								<?php echo $max;?>
								</td>
							</tr>					
						<tr>
							<td class="formresults" />
								<?php echo $average;?>
								</td>
							</tr>	
						<tr>
							<td class="formresults" />
								<?php 
								if($min == 0 OR $min == "") {
										$tmp_min = "NR/Null";
									}
									else {
										$tmp_min = $min;
									}
									?>
								<?php echo $tmp_min;?>
								</td>
							</tr>						
						</table>
							<?php
							
							
							//echo "Max: ".$max." Min: ".$min." Average: ".$average." <br>";
							
							
							//for ($k=0; $k<($second_level); $k=$k+1) {
							//		// Internal Loop
							//		// This is the Mu Value;
							//		echo "Mu Value is ".$array_of_mu[$j][$k]."<br>";
							//}
							?>
						</td>
						
							<?php
							$internal_counter = $internal_counter + 1;
							$external_counter = $external_counter + 1;
					}
					?>
					</tr>
				</table>
				<?php

					
			}
		}
		
	function drawnotarunway($array_of_mu,$array_of_settings,$array_of_addedinfo,$array_of_dates, $array_of_times,$array_of_mains) {
			// Loads $array_of_mu and draws a barchart.
			
			// Get basic data about this dataset!
			// 0		$array_of_settings = array($use_start_date,
			// 1									$use_end_date,
			// 2									$lineheightrate,
			// 3									$linemultiplyer);	
			$emptyshell 	= empty($array_of_mu);
			
			if($emptyshell == 1) {
					// Thre is nothing here to show anyone
					echo "<br> There is NO Taxiway Data to Display that meets your search criteria <br>";
			}
			else {
			
					$array_count 	= count($array_of_mu);
					$min			= min($array_of_mu);
					$max			= max($array_of_mu);
					$total_values	= array_sum($array_of_mu);
					$average		= round(($total_values/$array_count),2);
					$facility_id	= $array_of_addedinfo[0];
					
					$chart_height	= ( $max * $array_of_settings[2] );
					$chart_width	= ( $array_count + 2 );
				
				// Function will need the array of values.....
				?>
				<table width="640" class="formheaders" />
					<tr>
						<td colspan="<?php echo $chart_width;?>" align="left" class="formoptions">
							<?php
							$facility_name = part139339_c_facilitycombobox($facility_id, "all", "notused", "hide", "all");
							?>
							Progressive Bar Chart
							</td>
						</tr>
					<tr>
						<td colspan="<?php echo $chart_width;?>" align="left" class="formanswers">
							The chart below is a chronological display 
							</td>
						</tr>
					<tr>
						<td colspan="2" class="formresults" />
							Data
							</td>
						<td class="formresults" />
							Chart
							</td>
						</tr>
					<tr>
						<td class="formresults" />
							Start Date:
							</td>
						<td class="formresults" />
							<?php echo $array_of_settings[0];?>
							</td>				
						<td rowspan="6">
							<DIV STYLE="overflow-x: scroll; width:640; border:0 #000000 solid; text-align: left;  padding: 2px">
							<table width="100%">
								<tr>
									<td align="left" valign="bottom" /><img src="images/part_139_339/barchart_setup.gif" height="<?php echo $chart_height;?>" width="15" /></td>
									
				<?php
				$fieldstring 	= "";
				
				for ($j=0; $j<count($array_of_mu); $j=$j+1) {
						
						$height			= $array_of_mu[$j];
						$tmp_barheight 	= ( $array_of_settings[3] * $height );
						
						// Set Colum Color			
						if($array_of_mu[$j] >= 0 AND $array_of_mu[$j] <=20 ) {
								$bar = "01";
						}
						if($array_of_mu[$j] >= 21 AND $array_of_mu[$j] <= 25 ) {
								$bar = "02";
						}
						if($array_of_mu[$j] >= 26 AND $array_of_mu[$j] <= 29 ) {
								$bar = "03";
						}				
						if($array_of_mu[$j] >= 30 AND $array_of_mu[$j] <= 35 ) {
								$bar = "04";
						}
						if($array_of_mu[$j] >= 36 AND $array_of_mu[$j] <= 39 ) {
								$bar = "05";
						}			
						if($array_of_mu[$j] >= 40 ) {
								$bar = "06";
						}	
						
						if($array_of_mu[$j] == 0 OR $array_of_mu[$j] == "" ) {
								$bar 				= "blank";
								//$array_of_mu[$j] 	= "";
								$height 		= 45;
								$tmp_barheight 	= ( $array_of_settings[3] * $height );
						}					
						
						$fieldstring	= "Test of <b>".$facility_name."</b> was conducted on <b>".$array_of_dates[$j]."</b> at ".$array_of_times[$j]." with a Mu value of ".$array_of_mu[$j]."";
						
						?>
									<td align="left" valign="bottom" onClick="openchild600('part139339_c_report_display_new.php?recordid=<?php echo $array_of_mains[$j];?>&cellvalue=temp','FICONFROMBARCHART')"/><img src="images/part_139_339/barchart_<?php echo $bar;?>.png" height="<?php echo $tmp_barheight;?>" width="15" onMouseover="ddrivetip('<?php echo $fieldstring;?>')"; onMouseout="hideddrivetip()"/></td>
						<?php
				}
				?>		
									</tr>
								<tr>
									<td align="left" valign="bottom" />Mu</td>
									
				<?php
				for ($j=0; $j<count($array_of_mu); $j=$j+1) {
						?>
									<td align="left" valign="bottom" /><font size="1"><i><?php echo $array_of_mu[$j];?></i></font></td>
						<?php
				}
				?>		
									</tr>
				
								</table>
							</div>
						</td>
					<tr>
						<td class="formresults" />
							End Date:
							</td>
						<td class="formresults" />
							<?php echo $array_of_settings[1];?>
							</td>
						</tr>
					<tr>
						<td class="formresults" />
							Total Records Displayed
							</td>
						<td class="formresults" />
							<?php echo $array_count;?>
							</td>
						</tr>
					<tr>
						<td class="formresults" />
							Average
							</td>
						<td class="formresults" />
							<?php echo $average;?>
							</td>
						</tr>
					<tr>
						<td class="formresults" />
							Minimum
							</td>
						<td class="formresults" />
							<?php echo $min;?>
							</td>
						</tr>			
					<tr>
						<td class="formresults" />
							Maximum
							</td>
						<td class="formresults" />
							<?php echo $max;?>
							</td>
						</tr>
				</table>
					<?php
			}
	}

// Define Variables...
//						for Auto Entry Function {End of Page}

		// Last Main ID
		//		This is the ID of the main record of this page, not a sub routine.
		//		If no ID is used or possible to obtain such a browse page or a form loader enter '-'
		$last_main_id	= "-";
		
		//	AutoEntry Function Array
		//		This array controls the values sent to the auto entry function.
		//		No changes should be needed to it.
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>		